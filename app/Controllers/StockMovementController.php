<?php namespace App\Controllers;

use App\Models\StockMovementModel;

class StockMovementController extends BaseController
{
    protected $stockMovementModel;

    public function __construct()
    {
        $this->stockMovementModel = new StockMovementModel();
    }

    // Display paginated stock movements with optional search
    public function index()
    {
        $perPage = 10;
        $search = $this->request->getGet('search');

        // Fetch stock movements with optional search and pagination
        $stockMovements = $this->stockMovementModel->getStockMovements($perPage, $search);

        // Pass data to the view
        return view('stockmovements/index', [
            'title' => 'Stock Movements',
            'stockMovements' => $stockMovements, // Pass movements directly
            'pager' => $this->stockMovementModel->pager,
            'search' => $search
        ]);
    }


    // Display the form for adding a new stock movement
    public function create()
    {
        return view('stockmovements/create', [
            'title' => 'Add Stock Movement'
        ]);
    }

    // Handle the form submission for adding stock movement
    public function store()
    {
        // Load validation service
        $validation = \Config\Services::validation();

        // Set validation rules
        $validation->setRules([
            'item_id'        => 'required|numeric',
            'movement_type'  => 'required|in_list[in,out]',
            'quantity'       => 'required|numeric',
            'movement_date'  => 'required|valid_date',
            'status'         => 'required|in_list[active,inactive]',
        ]);

        // Check if the request is a POST request and validation passes
        if ($this->request->getMethod() === 'post' && $validation->withRequest($this->request)->run()) {
            // Save the stock movement data into the database
            $this->stockMovementModel->save([
                'item_id'        => $this->request->getPost('item_id'),
                'movement_type'  => $this->request->getPost('movement_type'),
                'quantity'       => $this->request->getPost('quantity'),
                'movement_date'  => $this->request->getPost('movement_date'),
                'status'         => $this->request->getPost('status'),
            ]);

            // Redirect to stock movement list with success message
            return redirect()->to('/stockmovements/index')->with('success', 'Stock movement added successfully.');
        } else {
            // Validation failed, return to the form with validation errors
            return view('stockmovements/create', [
                'title'      => 'Add Stock Movement',
                'validation' => $validation,
            ]);
        }
    }

    // Show the edit form
    public function edit($id)
    {
        $data['stockMovement'] = $this->stockMovementModel->find($id);
        if (!$data['stockMovement']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Stock movement with ID $id not found");
        }

        return view('stockmovements/edit', [
            'title' => 'Edit Stock Movement',
            'stockMovement' => $data['stockMovement'],
            'validation' => \Config\Services::validation()
        ]);
    }

    // Update stock movement data
    public function update($id)
    {
        if (!$this->validate([
            'item_id' => 'required|integer',
            'movement_type' => 'required|in_list[in,out]',
            'quantity' => 'required|integer',
            'movement_date' => 'required|valid_date',
            'status' => 'required|in_list[active,inactive]',
        ])) {
            return redirect()->to('/stockmovements/edit/' . $id)->withInput()->with('validation', \Config\Services::validation());
        }

        $this->stockMovementModel->update($id, [
            'item_id' => $this->request->getVar('item_id'),
            'movement_type' => $this->request->getVar('movement_type'),
            'quantity' => $this->request->getVar('quantity'),
            'movement_date' => $this->request->getVar('movement_date'),
            'status' => $this->request->getVar('status'),
        ]);

        return redirect()->to('/stockmovements/index')->with('success', 'Stock movement updated successfully');
    }

    // Delete stock movement by ID
public function delete($id)
{
    // Check if the stock movement exists
    if ($this->stockMovementModel->find($id)) {
        // Delete the stock movement
        $this->stockMovementModel->delete($id);
        return redirect()->to('/stockmovements/index')->with('success', 'Stock movement deleted successfully.');
    } else {
        return redirect()->to('/stockmovements/index')->with('error', 'Stock movement not found.');
    }
}



}
