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

        return redirect($link->original_url);
    }

    public function create()
    {
        return view('create');
    }

    public function store(LinkRequest $request)
    {
        $link = Link::firstOrNew([
            'original_url' => $request->input('url')
        ]);

        if (!$link->exists) {
            $link->save();
            $link->update([
                'code' => $link->getCode()
            ]);
        }

        return view('show')->with('link', $link);
    }
}
