<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Logs extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'content',
        'id_user',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
