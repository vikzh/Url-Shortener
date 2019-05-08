<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'url' => 'required|url'
        ]);

        $link = Link::firstOrNew([
            'original_url' => $request->get('url')
        ]);
        if(!$link->exists) {
            $link->save();
        }
    }
}
