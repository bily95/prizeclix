<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = "transactions";

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Store new transaction for user balance add or subtract
     * 
     * @var $marcos array [user, amount,from]
     * @var $charge [0, 1]
     * @var $type [+, -]
     * @var $details = 'describe the transaction
     * 
     * @return mix
     */
    public static function store($marcos, $charge = 0, $type = '+' )
    {
        return self::create([
            'user_id' => $marcos['user']->id,
                'amount' => $marcos['amount'],
                'charge' => $charge,
                'post_balance' => $marcos['user']->balance,
                'trx_type' => $type,
                'trx' => getTrx(),
                'from' => $marcos['from'],
                'source_id' => isset($marcos['source_id']) ? $marcos['source_id'] : 0,
                'details' => isset($marcos['details']) ? $marcos['details'] : ucfirst(strtolower(str_replace('_', ' ', $marcos['from']))),
        ]);
    }

}
