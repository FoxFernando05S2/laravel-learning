<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Classroom extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =[
        'name',
    ];
    
    public function block(): BelongsToMany
    {
        return $this->belongsToMany(Block::class, 'block_classrooms');
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, Block::class);
    }
}
