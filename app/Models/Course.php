<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'photo',
        'price',
        'duration',
        'in_slider'
    ];

    public function getInSliderStatus() {
        return $this->in_slider ? 'Да' : 'Нет';
    }

}
