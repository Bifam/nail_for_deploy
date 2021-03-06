<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kyslik\ColumnSortable\Sortable;
use App\Models\EmployeesCheckin;

/**
 * @property int $id
 * @property string $sin_number
 * @property string $phone_number
 * @property string $address
 * @property int $worked_type
 * @property int $paid_type
 * @property int $salary
 * @property string $contract_begin_date
 * @property string $contract_end_date
 * @property int $sex
 * @property string $birthday
 * @property string $email
 * @property string $password
 * @property string $full_name
 * @property string $created_at
 * @property string $updated_at
 * @property string $remember_token
 * @property string $last_name
 */
class Employee extends Authenticatable
{
    use Notifiable;
    use Sortable;

    protected $guard = 'user';

    public function checkin()
    {
        return $this->hasOne(EmployeesCheckin::class, 'employee_id', 'id');
    }

    /**
     * @var array
     */
    protected $fillable = ['sin_number', 'phone_number', 'address', 'worked_type', 'paid_type', 'salary', 'contract_begin_date', 'contract_end_date', 'sex', 'birthday', 'email', 'first_name', 'created_at', 'updated_at', 'last_name', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $sortable = ['id',
        'first_name',
        'last_name',
        'email',
        'sin_number',
        'phone',
        'address',
        'worked_type',
        'paid_type',
    ];
}
