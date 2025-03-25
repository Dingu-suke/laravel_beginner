<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create()
    {
        $response = $this->get(route('login.create'));

        $response->assertViewIs('login.create');
        $response->assertStatus(200);
    }

    public function test_storeSuccess()
    {
        $password = 'password123';
        $this->createUser($password);
        $user = \App\Models\User::select('*')->orderBy('id', 'desc')->first();

        $response = $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect(route('top.index'));
    }

    public function test_storeFail()
    {
        $this->get(route('login.create'));
        $response = $this->post(route('login.store'), [
            'email' => 'invalid@example.com',
            'password' => 'invalidpassword',
        ]);

        $response->assertSessionHasErrors(['email']);
        $response->assertSessionDoesntHaveErrors(['password']);
        $response->assertRedirect(route('login.create'));
    }

    public function test_destroySuccess()
    {
        $password = 'password123';
        $this->createUser($password);
        $user = \App\Models\User::select('*')->orderBy('id', 'desc')->first();

        $response = $this->actingAs($user)->delete(route('login.destroy'));

        $response->assertRedirect(route('top.index'));
    }

    private function createUser(string $password, int $num = 1)
    {
        $count = 0;

        while($count < $num) {
            $user = new User();
            $user->name = "らんてくん{$num}";
            $user->age = 30;
            $user->address = "東京都{$num}区{$num}丁目{$num}番{$num}号";
            $user->tel = "090-1234-{$num}";
            $user->email = "example{$num}@example.com";
            $user->password = Hash::make($password);
            $user->save();

            $count += 1;
        }
    }
}
