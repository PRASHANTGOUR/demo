<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class CustomerController extends BaseController
{
    public function index()
    {
        $model = new CustomerModel();

        // Get the current page from query string or default to 1
        $page = $this->request->getGet('page') ?? 1;
        $limit = 10; // Set your limit
        $offset = ($page - 1) * $limit;

        // Get search query from GET request
        $search = $this->request->getGet('search');

        // Get customers with pagination and search
        $customers = $model->getCustomers($limit, $offset, $search);
        $totalCount = $model->getCustomerCount($search);

        // Load the pager service
        $pager = \Config\Services::pager();

        // Pass data to the view
        return view('customers/index', [
            'customers' => $customers,
            'search' => $search,
            'pager' => $pager,
            'totalCount' => $totalCount,
            'currentPage' => $page,
            'title' => 'Customer List'
        ]);
    }

    public function create()
    {
        return view('customers/create', [
            'title' => 'Category',
        ]);
    }

    public function store()
    {
        // Validate request
        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'customer_name' => 'required',
            'contact_phone' => 'required|numeric',
            'email' => 'required|valid_email',
            'status' => 'required'
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Save to database
        $customerModel = new CustomerModel();
        $customerData = [
            'customer_name'  => $this->request->getPost('customer_name'),
            'contact_phone'  => $this->request->getPost('contact_phone'),
            'email'          => $this->request->getPost('email'),
            'address'        => $this->request->getPost('address'),
            'status'         => $this->request->getPost('status'),
        ];

        $customerModel->insert($customerData);

        return redirect()->to('/customers/index')->with('success', 'Customer added successfully');
    }

    // Edit customer method
    public function edit($id)
    {
        $model = new CustomerModel();
        $customer = $model->find($id);

        if (!$customer) {
            return redirect()->to('/customers/index')->with('error', 'Customer not found');
        }

        return view('customers/edit', [
            'customer' => $customer,
            'title' => 'Edit Customer',
        ]);
    }

    // Update customer method
    public function update($id)
    {
        // Validate request
        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'customer_name' => 'required',
            'contact_phone' => 'required|numeric',
            'email' => 'required|valid_email',
            'status' => 'required'
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Update customer in database
        $customerModel = new CustomerModel();
        $customerData = [
            'customer_name'  => $this->request->getPost('customer_name'),
            'contact_phone'  => $this->request->getPost('contact_phone'),
            'email'          => $this->request->getPost('email'),
            'address'        => $this->request->getPost('address'),
            'status'         => $this->request->getPost('status'),
        ];

        $customerModel->update($id, $customerData);

        return redirect()->to('/customers/index')->with('success', 'Customer updated successfully');
    }

    public function delete($id)
{
    // Instantiate the CustomerModel
    $model = new CustomerModel();

    // Find the customer by ID to check if it exists
    $customer = $model->find($id);

    if (!$customer) {
        return redirect()->to('/customers/index')->with('error', 'Customer not found');
    }

    // Delete the customer
    if ($model->delete($id)) {
        return redirect()->to('/customers/index')->with('success', 'Customer deleted successfully');
    } else {
        return redirect()->to('/customers/index')->with('error', 'Failed to delete the customer');
    }
}

}
