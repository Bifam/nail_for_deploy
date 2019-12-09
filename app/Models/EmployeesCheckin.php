<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property int $id
 * @property int $employee_id
 * @property string $checkin_date
 * @property string $in_time
 * @property string $out_time
 * @property string $created_at
 * @property string $updated_at
 */
class EmployeesCheckin extends Model
{
    use Sortable;
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'employees_checkin';

    /**
     * @var array
     */
    protected $fillable = ['employee_id', 'checkin_date', 'in_time', 'out_time', 'created_at', 'updated_at'];
    protected $sortable = ['employee_id', 'checkin_date', 'in_time', 'out_time', 'created_at', 'updated_at'];

}
