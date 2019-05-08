<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function show($code)
    {
        $link = Link::byCode($code)->first();
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

        return view('show')->with('link', $link);
    }
}
