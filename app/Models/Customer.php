<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;

    protected $table = 'customers';
    protected $primaryKey = 'customer_id';
    public $incrementing = false;

    protected $fillable = [
        'customer_id',
        'customer_password',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_ktp_no',
        'customer_ktp_picture',
    ];

    protected $hidden = [
        'customer_password',
        'remember_token',
    ];

    public function subscription()
    {
        return $this->hasMany(Subscription::class, 'customer_id', 'customer_id');
    }

    public function service()
    {
        return $this->hasManyThrough(Service::class, Subscription::class, 'customer_id', 'serv_id', 'customer_id', 'serv_id');
    }

    public function getAuthPassword()
    {
        return $this->customer_password;
    }

    public function getEmailForPasswordReset()
    {
        return $this->customer_email;
    }
}
