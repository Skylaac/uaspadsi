<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_user',
        'nama',
        'email',
        'password',
        'role',
    ];

    protected $hidden = ['password', 'remember_token'];

    /**
     * Memberitahu Laravel bahwa primary key untuk Auth adalah id_user
     */
    public function getAuthIdentifierName()
    {
        return 'id_user';
    }

    public function getAuthIdentifier()
    {
        return $this->id_user;
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_user');
    }


    /**
     * AUTO GENERATE ID USER & HASH PASSWORD
     */
    protected static function boot()
    {
        parent::boot();

        // generate id_user
        static::creating(function ($model) {
            if (empty($model->id_user)) {
                $model->id_user = 'USR' . Str::upper(Str::random(5));
            }

            // hash password jika belum hashed
            if (!empty($model->password) && !preg_match('/^\$2y\$/', $model->password)) {
                $model->password = Hash::make($model->password);
            }
        });

        // hash password saat update
        static::updating(function ($model) {
            if ($model->isDirty('password') && !preg_match('/^\$2y\$/', $model->password)) {
                $model->password = Hash::make($model->password);
            }
        });
    }
}
