<?php

namespace App\Http\Controllers;

use App\Link;
use Cache;
use App\Http\Requests\LinkRequest;

class LinkController extends Controller
{
    public function show($code)
    {
        $link = Cache::rememberForever("link.{$code}", function () use ($code) {
            return Link::byCode($code)->first();
        });
        if (is_null($link)) {
            abort(404);
        }
        return redirect($link->original_url);
    }

    public function create()
    {
        return view('create');
    }

    public function store(LinkRequest $request)
    {
        $link = Link::firstOrCreate([
            'original_url' => $request->input('url')
        ]);

        return view('show')->with('link', $link);
    }
}
