<?php

namespace App\Models;

use CodeIgniter\Model;

class PurchaseModel extends Model
{
    protected $table = 'purchase';  // Table name
    protected $primaryKey = 'purchase_id';  // Primary key

    // Fields that are allowed for insert/update operations
    protected $allowedFields = [
        'supplier_id',
        'item_id',
        'category_id',
        'purchase_date',
        'total_amount',
        'status',
        'payment_status',
        'notes',
    ];

    // Automatically manage timestamps
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Method to get purchases with optional search/filtering
    public function getPurchases($perPage = 10, $search = null)
    {
        if ($search) {
            return $this->like('notes', $search) // Example search by notes
                        ->orWhere('status', $search)
                        ->paginate($perPage);
        }

        return $this->paginate($perPage);
    }
}
