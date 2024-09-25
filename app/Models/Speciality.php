<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Speciality extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =[
        'name',
        'description',
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'speciality_users');
    }
}
