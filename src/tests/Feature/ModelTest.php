<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ModelTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    private $ages = [19, 20, 21, 50, 51];

    public function setUp(): void
    {
        parent::setUp();

        // ユーザーを各年齢で作成
        foreach ($this->ages as $age) {
            User::factory()->create([
                'name' => "ユーザー{$age}",
                'age' => $age,
                'tel' => '08000123456',
                'address' => '東京都港区芝公園４−２−８'
            ]);
        }
    }

    public function test_index()
    {
        $response = $this->get('/users');

        $users = User::where('age', '>=', 20)->where('age', '<=', 50)->orderBy('age', 'desc')->get();
        $response->assertViewHas(['users' => $users], 'indexアクションの表示順を年齢の逆順（年齢が高い方がリストの最初に表示される）にしてください');

        $this->checkCommonDisplay($response);
        $response->assertDontSee("19 才", false, "ユーザーは20才以上を表示してください");
        $response->assertDontSee("51 才", false, "ユーザーは50才以下を表示してください");
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
    }

    public function test_createFormDefaultValues()
    {
        $response = $this->get('/users/create');

        $response->assertStatus(200);

        $response->assertSee('value="らんてくん"', false, '名前入力欄の初期値が正しく表示されていません');
        $response->assertSee('value="20"', false, '年齢入力欄の初期値が正しく表示されていません');
    }

    private function createUser(int $num = 1)
    {
        $count = 0;

        while($count < $num) {
            $user = new User();
            $user->name = "らんてくん{$num}";
            $user->age = ($num + 1) * 10;
            $user->address = "東京都{$num}区{$num}丁目{$num}番{$num}号";
            $user->tel = "090-1234-{$num}";
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
