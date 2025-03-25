<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class ControllerAndViewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('/users');
        $response->assertViewHas(['index_title' => 'ユーザー一覧']);
    }

    public function test_show()
    {
        $this->createUser();
        $user = \App\Models\User::select('*')->orderBy('id', 'desc')->first();
        $response = $this->get("/users/{$user->id}");

        $response->assertViewHas(['show_title' => 'ユーザー詳細']);
    }

    private function createUser(int $num = 1)
    {
        $count = 0;

        while($count < $num) {
            $user = new User();
            $user->name = "らんてくん{$num}";
            $user->age = $num;
            $user->save();

            $count += 1;
        }
    }
}
