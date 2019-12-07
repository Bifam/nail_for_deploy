<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property int $id
 * @property string $name
 * @property int $price
 */
class Task extends Model
{
    use Sortable;

    /**
     * @var array
     */
    protected $fillable = ['name', 'price'];
    protected $sortable = ['name', 'price'];
}
