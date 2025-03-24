<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $this->createUser();
        $user = \App\Models\User::all()->first();
        $response = $this->get('/users');

        $this->checkCommonDisplay($response);
        $this->assertSame($user->name, 'らんてくん1');
        $response->assertSee("ユーザー一覧", true, "ページタイトルが「ユーザー一覧」ではありません");
        $response->assertSee($user->name, true, "一覧ページにユーザー名を表示してください");
        $response->assertSee($user->age, true, "一覧ページに年齢を表示してください");
    }

    public function test_show()
    {
        $this->createUser();
        $user = \App\Models\User::select('*')->orderBy('id', 'desc')->first();
        $response = $this->get("/users/{$user->id}");

        $this->checkCommonDisplay($response);

        $response->assertSee($user->name, true, "詳細ページにユーザー名を表示してください");
        $response->assertSee($user->age, true, "詳細ページに年齢を表示してください");
        $response->assertSee("戻る", true, "「戻る」ボタンが表示されていません");
        $response->assertSee("編集", true, "「編集」ボタンが表示されていません");
        $response->assertSee("削除", true, "「削除」ボタンが表示されていません");
    }

    public function test_create()
    {
        $response = $this->get("/users/create");
        $this->checkCommonDisplay($response);
        $response->assertSee('登録', true, "「登録」ボタンが表示されていません");
        $response->assertSee('ユーザー名', true, "「ユーザー名」ラベルが表示されていません");
        $response->assertSee('年齢', true, "「年齢」ラベルが表示されていません");
        $response->assertSee('戻る', true, "「戻る」ボタンが表示されていません");

    }

    public function test_storeSuccess()
    {
        $attributes = [
            'name' => 'らんてくん',
            'age' => 20,
        ];
        $response = $this->post("/users", $attributes);

        $user = \App\Models\User::select('*')->orderBy('id', 'desc')->first();

        $response->assertStatus(302);
        $response->assertRedirect(route("users.show", $user));

        $this->assertSame($user->name, 'らんてくん');
        $this->assertSame($user->age, 20);
        $response->assertSessionHas('success', 'ユーザーを新規登録しました');
    }

    public function test_edit()
    {
        $this->createUser();
        $user = User::latest('id')->first();
        $response = $this->get("/users/{$user->id}/edit");

        $this->checkCommonDisplay($response);
        $response->assertSee('ユーザー名', true, "「ユーザー名」ラベルが表示されていません");
        $response->assertSee('年齢', true, "「年齢」ラベルが表示されていません");
        $response->assertSee('戻る', true, "「戻る」ボタンが表示されていません");

        $response->assertSee($user->name, true, "編集ページにユーザー名が表示されていません");
        $response->assertSee('更新', true, "更新ボタンが表示されていません");
    }

    public function test_update_success()
    {
        $this->createUser();
        $user = User::latest('id')->first();

        $attributes = [
            'name' => 'Newらんてくん'
        ];
        $response = $this->post("/users", $attributes);
        $response = $this->patch("/users/{$user->id}", $attributes);

        $user->refresh();

        $response->assertStatus(302);
        $response->assertRedirect(route('users.show', $user));
        $this->assertSame($user->name, 'Newらんてくん');
        $response->assertSessionHas('success', 'ユーザー情報を更新しました');
    }

    public function test_destroy()
    {
        $this->createUser();
        $user = User::latest('id')->first();

        $response = $this->delete("/users/{$user->id}");

        $response->assertStatus(302);
        $response->assertRedirect('/users');
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
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

    private function checkCommonDisplay($response)
    {
        $response->assertStatus(200);
        $attributes = ['ユーザー名', '年齢'];
        foreach ($attributes as $attribute) {
            $response->assertSee($attribute, true, "{$attribute}という文字を表示するようにしてください");
        }
    }
}
