<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Type;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class User extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;
    protected $fillable = [
        'email',
        'password',
    ];

     public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function specialities()
    {
        return $this->belongsToMany(Speciality::class,'speciality_users');
    }

    public function blocks()
    {
        return $this->belongsToMany(Block::class,'block_users');
    }
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class, 'type_users');
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'images');
    }

    // public function types(): BelongsToMany
    // {
    //     return $this->belongsToMany(Type::class);
    // }

}


