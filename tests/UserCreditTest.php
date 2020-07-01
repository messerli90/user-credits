<?php

namespace Messerli90\UserCredit\Tests;

use Illuminate\Support\Facades\Date;
use Messerli90\UserCredit\UserCredit;

class UserCreditTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        //
    }

    /** @test */
    public function it_casts_used_at_to_carbon_date()
    {
        $credit = UserCredit::create([
            'user_id' => 1,
            'used_at' => now()
        ]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $credit->used_at);
    }

    /** @test */
    public function it_casts_expires_at_to_carbon_date()
    {
        $credit = UserCredit::create([
            'user_id' => 1,
            'expires_at' => now()
        ]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $credit->expires_at);
    }


    /** @test */
    public function it_creates_a_credit()
    {
        $user_id = 1;
        UserCredit::addCreditForUser($user_id);

        $this->assertDatabaseHas('credits', [
            'user_id' => $user_id,
            'value' => 1
        ]);
    }

    /** @test */
    public function it_marks_a_credit_as_used()
    {
        $credit = UserCredit::create([
            'user_id' => 1
        ]);

        $credit->use('used for something');

        $this->assertDatabaseHas('credits', [
            'id' => $credit->getKey(),
            'used_at' => now()
        ]);

        $this->assertTrue($credit->isUsed());

        $this->assertEquals('used for something', $credit->memo);
    }

    /** @test */
    public function it_checks_if_credit_is_used()
    {
        $credit = UserCredit::create([
            'user_id' => 1,
            'used_at' => now()
        ]);

        $this->assertTrue($credit->isUsed());
    }

    /** @test */
    public function it_checks_if_credit_is_expired()
    {
        $credit = UserCredit::create([
            'user_id' => 1,
            'expires_at' => now()->subDay()
        ]);

        $this->assertTrue($credit->isExpired());
    }


    /** @test */
    public function it_checks_if_credit_is_available()
    {
        $available_credit = UserCredit::create([
            'user_id' => 1
        ]);
        $expired_credit = UserCredit::create([
            'user_id' => 1,
            'expires_at' => now()->subDay()
        ]);
        $used_credit = UserCredit::create([
            'user_id' => 1,
            'used_at' => now()->subDay()
        ]);

        $this->assertTrue($available_credit->isAvailable());
        $this->assertFalse($expired_credit->isAvailable());
        $this->assertFalse($used_credit->isAvailable());
    }
}
