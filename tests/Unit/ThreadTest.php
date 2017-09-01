<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;
    
    public function setUp()
    {
        parent::setup();

        $this->thread = factory('App\Thread')->create();
    }
    

    /** @test */
    public function a_thread_has_replies() {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    /** @test */
    public function it_has_a_owner() 
    {
        $this->assertInstanceOf('App\User', $this->thread->creator);
    }

    /** @test */
    public function it_can_add_a_reply() 
    {
        $this->thread->addReply([
            'body'  => 'FooBar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $this->thread->replies);
    }
}
