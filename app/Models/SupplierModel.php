<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table = 'suppliers';  // Table name
    protected $primaryKey = 'supplier_id';  // Primary key

    // Fields that are allowed for insert/update operations
    protected $allowedFields = [
        'supplier_name', 
        'contact_name', 
        'contact_phone', 
        'address', 
        'email',
        'created_at', 
        'updated_at'
    ];

    // Automatically manage timestamps
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Method to get paginated suppliers with optional search/filtering
    public function getSuppliers($perPage = 10, $search = null)
    {
        if ($search) {
            // Search by supplier_name or contact_name
            return $this->like('supplier_name', $search)
                        ->orLike('contact_name', $search)
                        ->orLike('contact_phone', $search)
                        ->orLike('email', $search)
                        ->paginate($perPage);
        }
        // If no search, return paginated results
        return $this->paginate($perPage);
    }

    // Method to get the total count of suppliers for pagination purposes
    public function getCount($search = null)
    {
        if ($search) {
            $this->like('supplier_name', $search)
                 ->orLike('contact_name', $search)
                 ->orLike('contact_phone', $search)
                 ->orLike('email', $search);
        }
        
        return $this->countAllResults();
    }
}
