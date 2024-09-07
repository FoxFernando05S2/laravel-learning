<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlockCourse extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'block_id',
        'course_id',
    ];

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
