<?php

namespace Modules\Payment\Entities;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';
    const STATUS_PENDING = 'pending';

    const STATUS_ARRAY = [
        self::STATUS_ACCEPTED,
        self::STATUS_REJECTED,
        self::STATUS_PENDING
    ];

    protected $table = 'payment_transactions';

    protected $fillable = ['user_id', 'payment_method', 'transaction_type', 'transaction_amount', 'transaction_usage', 'bonus', 'current_amount', 'status', 'content_id'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function content()
    {
        return $this->belongsTo('App\Content', 'content_id');
    }

    public function acceptedBy()
    {
        return $this->belongsTo('App\User', 'accepted_by');
    }

    public function get_payment_method()
    {
        return $this->belongsTo('Modules\Payment\Entities\PaymentMethod', 'payment_method');
    }
}
