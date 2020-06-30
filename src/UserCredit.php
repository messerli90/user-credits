<?php

namespace Messerli90\UserCredit;

use Illuminate\Database\Eloquent\Model;

class UserCredit extends Model
{
    protected $guarded = [];

    protected $table = 'credits';

    public static function addCreditForUser($user_id, $value = 1)
    {
        return self::create([
            'user_id' => $user_id,
            'value' => $value
        ]);
    }
}
