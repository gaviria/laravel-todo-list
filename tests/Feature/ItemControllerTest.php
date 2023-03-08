<?php

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemControllerTest extends TestCase
{
    //use RefreshDatabase;

    const TASK = "Hola 123";

    public function test_index(): void
    {
        //$this->withoutExceptionHandling();

        $response = $this->get('api/items');
        //$response->dump();
        $response->assertStatus(200);
        $this->assertArrayHasKey(0, $response);
    }

    public function test_store(): void
    {
        $response = $this->post('api/items/store', [
            "item" => [
                "task" => self::TASK
            ]
        ]);

        $response->assertStatus(201);
        //$this->assertCount(2, Item::all());

        $item = Item::where("task", self::TASK)->first();

        $this->assertEquals($item->task, self::TASK);
    }

    public function test_update(): void
    {
        //$this->withoutExceptionHandling();
        $response = $this->post('api/items/store', [
            "item" => [
                "task" => self::TASK
            ]
        ]);

        //$response->dump();

        $response = $this->put('api/items/' . $response["id"], [
            "item" => [
                "completed" => true
            ]
        ]);

        $response->assertStatus(200);
        $item = Item::find($response["id"]);
        $this->assertEquals($item->completed, true);
    }

    public function test_destroy(): void
    {
        //$this->withoutExceptionHandling();
        $response = $this->post('api/items/store', [
            "item" => [
                "task" => self::TASK
            ]
        ]);

        $response = $this->delete('api/items/' . $response["id"]);
        //$response->dump();
        $response->assertStatus(200);
    }
}
