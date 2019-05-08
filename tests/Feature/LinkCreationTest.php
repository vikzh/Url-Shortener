<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Link;

class LinkCreationTest extends TestCase
{

    use RefreshDatabase;

    public function testNoUrlGiven()
    {
        $this->post(route('links.create'));
        $this->assertEquals(Link::count(), 0);
    }

    public function testInvalidUrlGiven()
    {
        $this->post(route('links.create'), ['url' => 'http://someSite!@#$%^&*(']);
        $this->assertEquals(Link::count(), 0);
    }

    public function testValidUrlGiven()
    {
        $this->post(route('links.create'), ['url' => 'http://google.com']);
        $this->assertDatabaseHas('links', ['original_url' => 'http://google.com']);
    }

    public function testValidUrlGivenTwice()
    {
        $this->post(route('links.create'), ['url' => 'http://google.com']);
        $this->post(route('links.create'), ['url' => 'http://google.com']);
        $this->assertEquals(1, Link::count());
    }
}
