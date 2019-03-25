<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Posts;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        
        
        $posts = Posts::first();
        $this->assertObjectHasAttribute('title', $posts);
    }
}
