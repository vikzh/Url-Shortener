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
            return Link::byCode($code)->firstOrFail();
        });
        return redirect($link->original_url);
    }

    public function create()
    {
        return view('create');
    }

    public function store(LinkRequest $request)
    {
        $link = Link::firstOrCreate([
            'original_url' => $request->input('url-to-short')
        ]);
        session()->flash('message', 'Link successfully shorted');

        return redirect(route('links.info', ['code' => $link->code]))->with('code', $link->code);
    }

    public function showInfo($code)
    {
        $link = Link::byCode($code)->firstOrFail();
        return view('show-info')->with('link', $link);
    }
}
