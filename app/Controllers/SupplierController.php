<?php namespace App\Controllers;

use App\Models\SupplierModel;

class SupplierController extends BaseController
{
    protected $supplierModel;

    public function __construct()
    {
        $this->supplierModel = new SupplierModel();
    }

    // Display paginated suppliers with optional search
    public function index()
    {
        $perPage = 10; // Define the number of records per page
        $search = $this->request->getGet('search'); // Get the search term from query parameters
        $currentPage = $this->request->getGet('page') ? $this->request->getGet('page') : 1; // Get the current page, default to 1

        // Fetch suppliers with optional search and pagination
        $suppliers = $this->supplierModel->getSuppliers($perPage, $search);

        // Pass data to the view
        return view('suppliers/index', [
            'title' => 'Suppliers List',
            'suppliers' => $suppliers,
            'pager' => $this->supplierModel->pager, // Use the built-in pagination
            'search' => $search,
            'currentPage' => $currentPage,
            'totalSuppliers' => $this->supplierModel->getCount($search) // Total count for pagination
        ]);
    }

    // Show form to add a new supplier
    public function create()
    {
        return view('suppliers/create', [
            'title' => 'Add Supplier'
        ]);
    }

    // Handle the form submission for adding a new supplier
    public function store()
    {
        // Validate the request
        $validation = \Config\Services::validation();
        $validation->setRules([
            'supplier_name' => 'required|min_length[3]|max_length[255]',
            'contact_name' => 'required|min_length[3]|max_length[255]',
            'contact_phone' => 'required|min_length[10]|max_length[20]',
            'address' => 'permit_empty|max_length[255]',
            'email' => 'required|valid_email|max_length[255]'
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->to('suppliers/create')->withInput()->with('errors', $this->validator->getErrors());
        }

        // Create a new supplier record
        $this->supplierModel->save([
            'supplier_name' => $this->request->getPost('supplier_name'),
            'contact_name' => $this->request->getPost('contact_name'),
            'contact_phone' => $this->request->getPost('contact_phone'),
            'address' => $this->request->getPost('address'),
            'email' => $this->request->getPost('email')
        ]);

        // Redirect to the supplier list with success message
        return redirect()->to('suppliers/index')->with('success', 'Supplier added successfully');
    }

    public function edit($id)
    {
        $supplier = $this->supplierModel->find($id);
        if (!$supplier) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Supplier not found');
        }

        return view('suppliers/edit', [
            'title' => 'Edit Supplier',
            'supplier' => $supplier,
            'validation' => \Config\Services::validation()
        ]);
    }

    // Handle the update form submission
    public function update($id)
    {
        // Validate the request
        $validation = \Config\Services::validation();
        $validation->setRules([
            'supplier_name' => 'required|min_length[3]|max_length[255]',
            'contact_name' => 'required|min_length[3]|max_length[255]',
            'contact_phone' => 'required|min_length[10]|max_length[20]',
            'address' => 'permit_empty|max_length[255]',
            'email' => 'required|valid_email|max_length[255]'
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->to("suppliers/edit/$id")->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update the supplier record
        $this->supplierModel->update($id, [
            'supplier_name' => $this->request->getPost('supplier_name'),
            'contact_name' => $this->request->getPost('contact_name'),
            'contact_phone' => $this->request->getPost('contact_phone'),
            'address' => $this->request->getPost('address'),
            'email' => $this->request->getPost('email')
        ]);

        // Redirect to the supplier list with success message
        return redirect()->to('suppliers/index')->with('success', 'Supplier updated successfully');
    }

    // Method to delete a supplier
    public function delete($supplier_id)
    {
        // Find the supplier by ID
        $supplier = $this->supplierModel->find($supplier_id);

        if (!$supplier) {
            // Supplier not found, redirect or show error
            return redirect()->to('suppliers/index')->with('error', 'Supplier not found.');
        }

        // Delete the supplier
        $this->supplierModel->delete($supplier_id);

        // Redirect with success message
        return redirect()->to('suppliers/index')->with('success', 'Supplier deleted successfully.');
    }
}
