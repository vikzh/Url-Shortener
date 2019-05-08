<?php

namespace Tests\Feature\middleware;

use Illuminate\Http\Request;
use Tests\TestCase;
use App\Http\Middleware\ModifyUrl;


class UrlMiddlewareTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHttpPrependedToUrl()
    {
        $request = new Request();
        $request->replace([
            'url' => 'yandex.ru',
        ]);
        $middleware = new ModifyUrl();
        $middleware->handle($request, function ($req) {
            $this->assertEquals('http://yandex.ru', $req->url);
        });
    }

    public function testHttpIsNotPrependedToUrl()
    {
        $request = new Request();
        $urls = [
            'http://yandex.ru',
            'ftp://yandex.ru',
            'https://yandex.ru'
        ];
        foreach ($urls as $url) {
            $request->replace([
                'url' => $url,
            ]);
            $middleware = new ModifyUrl();
            $middleware->handle($request, function ($req) use ($url) {
                $this->assertEquals($url, $req->url);
            });
        }
    }
}
