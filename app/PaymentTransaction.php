<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    const STATUS_ACTIVE = 'active';
    const STATUS_DRAFT = 'draft';

    const STATUS_ARRAY = [
        self::STATUS_ACTIVE,
        self::STATUS_DRAFT
    ];

//    public function location()
//    {
//        return $this->hasOne('App\BannerLocation', 'id', 'location_id');
//    }
}
