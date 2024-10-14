<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Type extends Model
{
    use HasFactory;
    use SoftDeletes;
    

    protected $fillable =[
        'name',
        'description',
    ];

    // public function users()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function users(): BelongsToMany
    // {
    //     return $this->belongsToMany(User::class, 'type_users');
    // }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'type_users');
    }

    
}
