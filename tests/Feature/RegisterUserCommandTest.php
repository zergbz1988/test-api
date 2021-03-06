<?php

namespace Tests\Feature;

use Tests\TestCase;

class RegisterUserCommandTest extends TestCase
{
    /**
     *
     */
    public function testRegister(): void
    {
        $this->artisan('user:register')
            ->expectsQuestion('Enter name for new user', 'Test 123' . time())
            ->expectsQuestion('Enter email for new user', 'test123' . time() . '@email.com')
            ->expectsQuestion('Set the password for new user', 'testpassword')
            ->assertExitCode(0);
    }
}
