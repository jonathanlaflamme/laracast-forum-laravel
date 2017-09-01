<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setup()
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }
    
    /** @test */
    public function a_user_can_browse_all_threads()
    {
        $response = $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_browse_one_threads() 
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_thread() 
    {
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);

        // When we visit a thread page
        // Then we should see the replies.
        $response = $this->get($this->thread->path())
            ->assertSee($reply->body);
    }
}
