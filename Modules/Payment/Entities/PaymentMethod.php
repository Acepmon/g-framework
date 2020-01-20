<?php

namespace Modules\Payment\Entities;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'name', 'data', 'enabled'];

    public function image()
    {
        switch ($this->code) {
            case 'transaction': return '/modules/payment/svg/transaction.svg';
            case 'card-khanbank': return '/modules/payment/svg/card-khanbank.svg';
            case 'card-credit': return '/modules/payment/svg/card-credit.svg';
            case 'card-debit': return '/modules/payment/svg/card-debit.svg';
            case 'card-local': return '/modules/payment/svg/card-local.svg';
            case 'socialpay': return '/modules/payment/svg/socialpay.svg';
            case 'mostmoney': return '/modules/payment/svg/mostmoney.png';
            default: return '/modules/payment/svg/card-local.svg';
        }
    }

    public function data()
    {
        return json_decode($this->data);
    }
}
