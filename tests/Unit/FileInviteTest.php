<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class FileInviteTest extends TestCase
{
    /**
     * A basic homepage test
     *
     * @return void
     */
    public function testHomepage()
    {
        $response = $this->get('/');
        $response->assertOk();
    }

    /**
     * Get the todo list
     *
     * @return void
     */
    public function testTodoList()
    {
        $response = $this->get('/api/todos');
        $response->assertOk();
    }

    /**
     * Test the creation of the todo item
     *
     * @return void
     */
	public function testCreateTodo()
	{
	  $response = $this->withHeaders([
	      'X-Header' => 'STORE',
	  ])->json('POST', '/api/todos', ['text' => 'test123','finished' => true]);

	  $response
	      ->assertStatus(201)
	      ->assertJson([
	          'finished' => true,
	      ]);
	}

	/**
     * Test the deletion of the todo item
     *
     * @return void
     */
	public function testRemoveTodo()
	{
	  $response = $this->withHeaders([
	      'X-Header' => 'Value',
	  ])->json('POST', '/api/todos/destroy', ['text' => 'test123','finished' => true]);

	  $response
	      ->assertStatus(201)
	      ->assertJson([
	          'finished' => true,
	      ]);
	}
}
