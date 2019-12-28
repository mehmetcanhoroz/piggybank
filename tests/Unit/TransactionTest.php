<?php

namespace Tests\Unit;

use App\transaction;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testListTransactions()
    {
        $transactions = transaction::all()->count();

        $this->assertGreaterThan(-1, $transactions);
    }

    public function testCreateTransaction()
    {
        $transactionCount = transaction::all()->count();

        $user = User::where('email', 'mehmetcanhoroz@gmail.com')
            ->first();
        $this->assertNotNull($user, 'User does not exist.');
        //$this->actingAs($user)->post('/login');

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => '123456789',
        ]);
        $response->assertRedirect('/home');

        $this->assertAuthenticatedAs($user, $guard = null);

        $transaction = new transaction;
        $transaction->user_id = $user->id;
        $transaction->date = Carbon::now();
        $transaction->balance = 10;
        $transaction->hour = 5;
        $transaction->isFailed = false;
        $transaction->proof = 'http://dummyimage.com/172x184.bmp/5fa2dd/ffffff';
        $transaction->save();

        $transactionNewCount = transaction::all()->count();

        $this->assertGreaterThan($transactionCount, $transactionNewCount);
    }

    public function testCreateFailedTransaction()
    {
        $transactionCount = transaction::all()->count();

        $user = User::where('email', 'mehmetcanhoroz@gmail.com')
            ->first();
        $this->assertNotNull($user, 'User does not exist.');
        //$this->actingAs($user)->post('/login');

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => '123456789',
        ]);
        $response->assertRedirect('/home');

        $this->assertAuthenticatedAs($user, $guard = null);

        $transaction = new transaction;
        $transaction->user_id = $user->id;
        $transaction->date = Carbon::now();
        $transaction->balance = 10;
        $transaction->hour = 5;
        $transaction->isFailed = true;
        $transaction->proof = 'http://dummyimage.com/172x184.bmp/5fa2dd/ffffff';
        $transaction->save();

        $transactionNewCount = transaction::all()->count();

        $this->assertGreaterThan($transactionCount, $transactionNewCount);
    }
}
