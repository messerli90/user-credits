<?php

namespace Messerli90\UserCredit;

class PendingCredit
{
    public $user;
    public $value;
    public $memo;
    public $expires_at;

    public static function forUser($user): self
    {
        $pending_credit = new self;
        $pending_credit->user = $user;

        return $pending_credit;
    }

    public function value($val)
    {
        $this->value($val);

        return $this;
    }

    public function withMemo($memo)
    {
        $this->memo = $memo;

        return $this;
    }

    public function expiresAt($expiration)
    {
        $this->expires_at = $expiration;

        return $this;
    }

    public function add()
    {
        return UserCredit::create([
            'user_id' => $this->user,
            'value' => $this->value,
            'memo' => $this->memo,
            'expires_at' => $this->expires_at
        ]);
    }
}
