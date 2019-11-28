<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property int $id
 * @property string $first_name
 * @property int $phone
 * @property string $email
 * @property string $address
 * @property int $sex
 * @property int $vip_level
 * @property string $created_at
 * @property string $updated_at
 * @property string $last_name
 * @property date birthday
 */
class Customer extends Model
{
    use Sortable;

    /**
     * @var array
     */
    protected $fillable = ['first_name', 'phone_number', 'email', 'address', 'sex', 'vip_level', 'created_at', 'updated_at', 'last_name', 'birthday'];

    public $sortable = ['id', 'first_name', 'phone_number', 'email', 'address', 'sex', 'vip_level', 'created_at', 'updated_at', 'last_name', 'birthday'];

}
