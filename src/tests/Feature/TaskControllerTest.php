<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $this->createTask();
        $task = $this->firstTask();
        $response = $this->get('/tasks');

        $this->checkCommonDisplay($response);
        $this->checkTaskDisplay($response, $task, '一覧ページ');
    }

    public function test_show()
    {
        $this->createTask();
        $task = $this->firstTask();
        $response = $this->get("/tasks/{$task->id}");

        $this->checkCommonDisplay($response);
        $this->checkTaskDisplay($response, $task, '詳細ページ');
    }

    public function test_create()
    {
        $response = $this->get("/tasks/create");
        $this->checkCommonDisplay($response);
    }

    public function test_storeSuccess()
    {
        $attributes = [
            'title' => 'Laravelについて勉強する',
            'description' => 'Laravelの基本的な機能を学ぶ',
        ];
        $response = $this->post("/tasks", $attributes);
        $task = $this->firstTask();

        $response->assertStatus(302);
        $response->assertRedirect(route("tasks.show", $task));

        $this->assertSame($task->title, $attributes['title']);
        $this->assertSame($task->description, $attributes['description']);
    }

    public function test_storeFail()
    {
        $attributes = [
            'title' => '',
            'description' => '',
        ];

        $this->get("/tasks/create");
        $this->post("/tasks", $attributes)
             ->assertStatus(302)
             ->assertRedirect(route("tasks.create"));
    }

    public function test_edit()
    {
        $this->createTask();
        $task = $this->firstTask();
        $response = $this->get(route("tasks.edit", $task));
        $this->checkCommonDisplay($response);
    }

    public function test_updateSuccess()
    {
        $this->createTask();
        $task = $this->firstTask();
        $attributes = [
            'title' => 'Laravelについて勉強する',
            'description' => 'Laravelの基本的な機能を学ぶ',
        ];
        $this->get(route("tasks.edit", $task));
        $response = $this->patch(route("tasks.update", $task), $attributes);

        $response->assertStatus(302);
        $response->assertRedirect(route("tasks.show", $task));

        $task = $this->firstTask();
        $this->assertSame($task->title, $attributes['title']);
        $this->assertSame($task->description, $attributes['description']);
    }

    public function test_updateFail()
    {
        $this->createTask();
        $task = $this->firstTask();
        $attributes = [
            'title' => '',
            'description' => '',
        ];
        $this->get(route("tasks.edit", $task));
        $response = $this->patch(route("tasks.update", $task), $attributes);

        $response->assertStatus(302);
        $response->assertRedirect(route("tasks.edit", $task));
    }

    public function test_delete()
    {
        $this->createTask();
        $task = $this->firstTask();

        $response = $this->get(route("tasks.show", $task));

        $response = $this->delete(route("tasks.destroy", $task));


        $response->assertStatus(302);
        $response->assertRedirect(route("tasks.index"));

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }

    private function createTask(int $num = 1)
    {
        $count = 0;

        while($count < $num) {
            $task = new Task();
            $task->title = "タイトル${num}";
            $task->description = "内容${num}";
            $task->save();

            $count += 1;
        }
    }

    private function checkCommonDisplay($response)
    {
        $response->assertStatus(200);
        $attributes = ['タイトル', '内容'];
        foreach ($attributes as $attribute) {
            $response->assertSee($attribute, true, "{$attribute}という文字を表示するようにしてください");
        }
    }

    private function checkTaskDisplay($response, $task, $page_title)
    {
        $response->assertSee($task->title, true, "${page_title}にタイトルを表示してください");
        $response->assertSee($task->description, true, "${page_title}に内容を表示してください");
    }

    private function firstTask()
    {
        return \App\Models\Task::select('*')->orderBy('id', 'desc')->first();
    }
}
