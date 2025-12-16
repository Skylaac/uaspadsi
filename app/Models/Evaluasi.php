<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    use HasFactory;

    protected $table = 'evaluasi';
    protected $primaryKey = 'id_evaluasi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_evaluasi',
        'id_user',
        'nama',
        'periode',
        'penilaian_kerja',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
