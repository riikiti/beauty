<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseGroup extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $fillable = [
        'course_id',
        'group_id',
    ];

    protected $appends=[
        'info'
    ];
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function getInfoAttribute()
    {
        return 'Смена: ' . $this->group->shift . ' - Дата начала: ' . $this->group->date_start;
    }
    public function getGroup()
    {
        return $this->group;
    }

}
