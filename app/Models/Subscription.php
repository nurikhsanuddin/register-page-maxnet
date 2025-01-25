<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';
    protected $primaryKey = 'subscription_id';
    protected $with = ['customer', 'service', 'billingDetail'];
    protected $fillable = [
        'subscription_id',
        'subscription_password',
        'customer_id',
        'serv_id',
        'created_by',
        'installed_by',
        'subscription_address',
        'subscription_start_date',
        'subscription_billing_cycle',
        'subscription_price',
        'subscription_status',
        'subscription_maps',
        'subscription_home_photo',
        'subscription_form_scan',
        'subscription_test_result',
        'subscription_description',
        'odp_distance',
        'cpe_type',
        'cpe_serial',
        'cpe_picture',
        'cpe_site',
        'installed_at',
        'group'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'serv_id', 'serv_id');
    }

    public function billing()
    {
        return $this->hasMany(Billing::class, 'subscription_id', 'subscription_id');
    }

    public function billingDetail()
    {
        return $this->hasMany(BillingDetail::class, 'subscription_id', 'subscription_id');
    }
}
