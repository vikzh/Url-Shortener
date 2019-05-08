<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Link;
use App\Exceptions\CodeGenerationException;

class LinkModelTest extends TestCase
{

    use RefreshDatabase;

    protected $mappings = [
        80 => '1i',
        500 => '84',
        50000 => 'd0s'
    ];

    public function testLinkCodeGeneration()
    {
        $link = new Link();

        foreach ($this->mappings as $id => $expectedCode) {
            $link->id = $id;
            $this->assertEquals($link->getCode(), $expectedCode);
        }
    }

    public function testExceptionWithNoId()
    {
        $this->expectException(CodeGenerationException::class);

        $link = new Link();
        $link->getCode();
    }

    public function testGetModelByCode()
    {
        $link = factory(Link::class)->create();
        $model = $link->byCode($link->code)->first();

        $this->assertInstanceOf(Link::class, $model);
        $this->assertEquals($model->original_url, $link->original_url);
    }

    public function testGetShortUrlFromLink()
    {
        $link = factory(Link::class)->create();

        $this->assertEquals($link->shortenedUrl(), env('APP_URL') . "/{$link->code}");
    }

    public function testGetShortUrlFromNull()
    {
        $link = new Link();

        $this->assertNull($link->shortenedUrl());
    }
}
