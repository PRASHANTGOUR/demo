<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'customer_id';
    protected $allowedFields = ['customer_name', 'contact_phone', 'email', 'address', 'status'];

    // Automatically manage timestamps
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getCustomers($limit = 10, $offset = 0, $search = null)
    {
        if ($search) {
            $this->like('customer_name', $search);
            $this->orLike('contact_phone', $search);
            $this->orLike('email', $search);
        }

        return $this->findAll($limit, $offset);
    }

    public function getCustomerCount($search = null)
    {
        if ($search) {
            $this->like('customer_name', $search);
            $this->orLike('contact_phone', $search);
            $this->orLike('email', $search);
        }
        
        return $this->countAllResults();
    }
}
