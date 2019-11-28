<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property int $id
 * @property int $customer_id
 * @property string $employee_ids
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property int $delete_flag
 * @property int $priority
 */
class Appointment extends Model
{
    use Sortable;

    /**
     * @var array
     */
    protected $fillable = ['customer_id', 'employee_ids', 'status', 'created_at', 'updated_at', 'delete_flag', 'priority'];

    public $sortable = ['id',
        'customer_id',
        'employee_ids',
        'status',
        'created_at',
        'updated_at',
        'delete_flag',
        'priority'
    ];

}
