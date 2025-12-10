<?php

return [
    'company' => [
        'default' => env('COMPANY_ID', 1),
    ],
    
    'inventory' => [
        'valuation_methods' => [
            'average_cost' => 'Average Cost',
            'fifo' => 'First-In, First-Out',
            'lifo' => 'Last-In, First-Out',
            'weighted_average' => 'Weighted Average',
        ],
        
        'default_valuation_method' => 'average_cost',
        
        'stock_status' => [
            'out_of_stock' => [
                'threshold' => 0,
                'color' => 'danger',
            ],
            'low_stock' => [
                'threshold' => 10,
                'color' => 'warning',
            ],
            'normal' => [
                'color' => 'success',
            ],
            'excess_stock' => [
                'color' => 'info',
            ],
        ],
        
        'movement_types' => [
            'receipt' => 'Receipt',
            'issue' => 'Issue',
            'adjustment' => 'Adjustment',
            'transfer' => 'Transfer',
            'return' => 'Return',
            'write_off' => 'Write-off',
            'production' => 'Production',
            'consumption' => 'Consumption',
        ],
        
        'quality_statuses' => [
            'accepted' => 'Accepted',
            'quarantine' => 'Quarantine',
            'rejected' => 'Rejected',
            'hold' => 'On Hold',
        ],
        
        'batch_tracking' => [
            'enabled' => true,
            'require_expiry' => true,
            'default_expiry_days' => 365,
        ],
    ],
    
    'security' => [
        'audit_log_enabled' => true,
        'file_upload_path' => 'private',
        'max_file_size' => 2048, // KB
        'allowed_file_types' => ['jpg', 'jpeg', 'png', 'gif', 'pdf'],
    ],
    
    'pagination' => [
        'default' => 25,
        'inventory_listing' => 50,
        'stock_movements' => 50,
        'products' => 25,
    ],
];