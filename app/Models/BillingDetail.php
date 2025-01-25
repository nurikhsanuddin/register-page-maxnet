<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingDetail extends Model
{
    use HasFactory;

    protected $table = 'billing_details';
    protected $primaryKey = 'billing_no';
    public $incrementing = false;

    protected $fillable = [
        'billing_no',
        'invoice_no',
        'subscription_id',
        'status',
        'date',
    ];


    public function billing()
    {
        return $this->belongsTo(Billing::class, 'invoice_no', 'invoice_no');
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id', 'subscription_id');
    }
}
