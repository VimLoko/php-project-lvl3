<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UrlChecksController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $id)
    {
        $urlRecord = DB::table('urls')->find($id);

        abort_unless($urlRecord, 404);

        try {
            $response = Http::get($urlRecord->name);
            $status = $response->status();

            DB::table('url_checks')->insert([
                'url_id' => $id,
                'status_code' => $status,
                'created_at' => Carbon::now()->toString(),
                'updated_at' => Carbon::now()->toString()
            ]);

            flash(__('messages.flash.url_check_created'))->success();
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
        }

        return redirect()->route('urls.show', ['url' => $id]);
    }
}
