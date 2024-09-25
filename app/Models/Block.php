<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Block extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'schedule',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'block_users');
    }
    public function classroom(): BelongsToMany
    {
        return $this->belongsToMany(Classroom::class, 'block_classrooms');
    }
}
