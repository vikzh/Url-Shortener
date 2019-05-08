<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;
use Cache;

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

    public function store(Request $request)
    {
        $this->validate($request, [
            'url' => 'required|url'
        ]);

        $link = Link::firstOrNew([
            'original_url' => $request->input('url')
        ]);
        if (!$link->exists) {
            $link->save();
            $link->update([
                'code' => $link->getCode()
            ]);
        }

        return $this->showAddedLink($link);
    }

    protected function showAddedLink($link)
    {
        return view('show')->with('link', $link);
    }
}
