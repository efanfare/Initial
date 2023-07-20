<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentUser extends Model
{
    use HasFactory;
    public $table = 'payment_users';

    protected $fillable =  ['user_id', 'stripe_id', 'sub_total', 'tax', 'total', 'pay_load'];
}
