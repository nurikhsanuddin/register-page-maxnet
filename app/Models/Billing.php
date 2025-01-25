<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $table = 'billings';
    protected $primaryKey = 'invoice_no';
    public $incrementing = false;
    protected $fillable = [
        'invoice_no',
        'customer_id',
        'discount',
        'total_invoice',
        'tax',
        'date',
        'grand_total',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id', 'subscription_id');
    }

    public function billingDetails()
    {
        return $this->hasMany(BillingDetail::class, 'invoice_no', 'invoice_no');
    }
}
