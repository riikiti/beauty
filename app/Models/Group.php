<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $fillable = [
        'date_start',
        'date_start_time',
        'date_finish_time',
        'shift',
    ];

}
