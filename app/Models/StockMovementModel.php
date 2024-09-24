<?php

namespace App\Models;
use CodeIgniter\Model;

class StockMovementModel extends Model
{
    protected $table = 'stock_movements';  // Table name
    protected $primaryKey = 'id';  // Primary key

    // Fields that are allowed for insert/update operations
    protected $allowedFields = [
        'item_id', 
        'movement_type', 
        'quantity', 
        'movement_date', 
        'status',
        'created_at', 
        'updated_at'
    ];

    // Automatically manage timestamps
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Method to get paginated stock movements with optional search/filtering
    public function getStockMovements($perPage = 10, $search = null)
    {
        if ($search) {
            // Search by movement_type or status
            return $this->like('movement_type', $search)
                        ->orLike('status', $search)
                        ->paginate($perPage);
        }
        // If no search, return paginated results
        return $this->paginate($perPage);
    }
}
