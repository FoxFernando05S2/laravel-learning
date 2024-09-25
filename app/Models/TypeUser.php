<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'type_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    
    protected $table = 'type_users';
    

    public function types()
    {
        return $this->belongsTo(Type::class);
    }
    
}
