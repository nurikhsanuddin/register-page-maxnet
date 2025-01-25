<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';
    protected $primaryKey = 'serv_id';
    public $incrementing = false;
    protected $fillable = [
        'serv_id',
        'service_name',
        'service_description',
        'service_speed',
        'service_price',
        'service_discount'
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'serv_id', 'serv_id');
    }
}
