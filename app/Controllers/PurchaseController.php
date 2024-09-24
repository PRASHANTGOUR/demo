<?php

namespace App\Controllers;

use App\Models\PurchaseModel;

class PurchaseController extends BaseController
{
    protected $purchaseModel;

    public function __construct()
    {
        $this->purchaseModel = new PurchaseModel();
    }

    // Display paginated purchases with optional search
    public function index()
    {
        $perPage = 10;
        $search = $this->request->getGet('search');

        // Fetch purchases with optional search and pagination
        $purchases = $this->purchaseModel->getPurchases($perPage, $search);

        // Pass data to the view
        return view('purchase/index', [
            'title' => 'Purchases',
            'purchase' => $purchases,
            'pager' => $this->purchaseModel->pager,
            'search' => $search,
        ]);
    }

    // Show form to create a new purchase
    public function create()
    {
        return view('purchase/create', [
            'title' => 'Add Purchase'
        ]);
    }

    // Store new purchase
    public function store()
    {
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            $this->purchaseModel->insert($data);
            return redirect()->to('purchase/index')->with('success', 'Purchase added successfully.');
        }
    }

    // Show form to edit an existing purchase
    public function edit($id)
    {
        $purchase = $this->purchaseModel->find($id);
        return view('purchase/edit', [
            'title' => 'Edit Purchase',
            'purchase' => $purchase
        ]);
    }

    // Update existing purchase
    public function update($id)
    {
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            $this->purchaseModel->update($id, $data);
            return redirect()->to('purchase/index')->with('success', 'Purchase updated successfully.');
        }
    }

    // Delete a purchase
    public function delete($id)
    {
        $this->purchaseModel->delete($id);
        return redirect()->to('purchase/index')->with('success', 'Purchase deleted successfully.');
    }
}
