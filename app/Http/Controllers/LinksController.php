<?php

namespace App\Http\Controllers;


use App\Jobs\ProcessAnalytic;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\Link;
use App\Models\Analytic;

use Log;

class LinksController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        try {

            $link = new Link;
            $link->from = $request->url;
            $link->to = (string) Str::uuid();
            $link->save();

            return response()->json($link);

            //code...
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['status' => 'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $link = Link::where('to', $id)->first();
        if(!$link) {
            return response()->json(['status' => 'error', 'message' => 'Link no found.']);
        }

        ProcessAnalytic::dispatchAfterResponse($link, $request->ip());

        return redirect()->away($link->from);
    }
}
