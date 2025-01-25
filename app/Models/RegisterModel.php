<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;

class RegisterModel extends Model
{
    use HasFactory;

    protected $table = 'register_customer';
    protected $primaryKey = 'register_id';
    public $timestamps = true; // Otomatis isi created_at dan updated_at

    protected $fillable = [
        'register_id',
        'name',
        'email',
        'password',
    ];

    // Mutator untuk mengenkripsi password
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'serv_id', 'serv_id');
    }

    // Contoh casting (jika ada kolom khusus)
    protected $casts = [
        'email_verified_at' => 'datetime', // Opsional, jika tabel memiliki kolom ini
    ];
}
