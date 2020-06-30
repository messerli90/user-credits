<?php

namespace Messerli90\UserCredit\Tests;

use Messerli90\UserCredit\UserCredit;

class UserCreditTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        //
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
}
