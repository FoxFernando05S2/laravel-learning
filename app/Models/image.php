<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class image extends Model
{
    use HasFactory;

    protected $fillable = [
        'images_type', 
        'images_id', 
        'uri'];

    public function image(): MorphTo
    {
        return $this->morphTo();
    }

    
}
