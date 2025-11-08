<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';   // penting
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_user',
        'nama',
        'email',
        'password',
        'role',
    ];

    protected $hidden = ['password'];
    
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id_user)) {
                $model->id_user = 'USR' . Str::upper(Str::random(5));
            }
        });
    }
    // optional: kalau mau implicit binding berdasarkan id_user juga bisa pakai ini
    // public function getRouteKeyName()
    // {
    //     return 'id_user';
    // }
}
