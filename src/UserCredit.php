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

    public function use($memo = '')
    {
        $this->update([
            'used_at' => now(),
            'memo' => $memo
        ]);
    }

    public function isUsed()
    {
        return !!$this->used_at;
    }

    public function isExpired()
    {
        return $this->expires_at && $this->expires_at->lt(now());
    }

    public function isAvailable()
    {
        return !$this->isUsed() && !$this->isExpired();
    }

    public static function forUser($user)
    {
        $pending_credit = new PendingCredit;
        $pending_credit->user = $user;

        return $pending_credit;
    }
}
