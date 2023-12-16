<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseUser extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'approved'
    ];

    protected $appends=[
        'approved_status'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function getpApprovedStatusStatus() {
        return $this->approved ? 'Подтверждено' : 'Не подтверждено';
    }

    public function getProfileInfoStatus() {
        return $this->course->title . ' со статусом ' . $this->getpApprovedStatusStatus();
    }


}
