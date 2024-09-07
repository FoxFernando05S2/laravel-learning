<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialityUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'speciality_id',
        'user_id',
    ];

    public function speciality()
    {
        return $this->belongsTo(Speciality::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
