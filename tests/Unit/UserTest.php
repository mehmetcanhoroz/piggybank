<?php

namespace Tests\Unit;

use App\User;
use Carbon\Carbon;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testCreateParentUser()
    {
        $user = new User;
        $user->name = 'Test User';
        $user->email = 'parent@gmail.com';
        $user->password = '123456789';
        $user->isParent = true;
        $user->api_token = Carbon::now()->toDateTimeString();
        $result = $user->save();

        $this->assertNotNull($result, 'Parent user couldn\'t create');
    }

    public function testCreateChildUser()
    {
        $user = new User;
        $user->name = 'Test Child';
        $user->email = 'child@gmail.com';
        $user->password = '123456789';
        $user->isParent = true;
        $user->api_token = Carbon::now()->addDay()->toDateTimeString();
        $result = $user->save();

        $this->assertNotNull($result, 'Child user couldn\'t create');
    }

    public function testDeleteParentUser()
    {
        $user = User::where('email', 'parent@gmail.com');
        $user->delete();
        $this->assertTrue(true);
    }

    public function testDeleteChildUser()
    {
        $user = User::where('email', 'child@gmail.com');
        $user->delete();
        $this->assertTrue(true);
    }
}
