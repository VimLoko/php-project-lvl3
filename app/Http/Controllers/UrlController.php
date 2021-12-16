<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUrlRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urls = DB::table(DB::raw('(
                select urls.id,
                urls.name,
                url_checks.status_code,
                url_checks.h1,
                url_checks.title,
                url_checks.description,
                url_checks.created_at,
                row_number() over (partition by urls.id order by url_checks.created_at desc) as rn
                from urls left join url_checks on urls.id = url_checks.url_id) t'))
            ->select('id', 'name', 'status_code', 'created_at')
            ->where('rn', 1)
            ->paginate();

        return view('url.pages.list', compact('urls'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUrlRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUrlRequest $request)
    {
        $validated = $request->safe()->only(['url.name']);

        $searchUrl = DB::table('urls')
            ->where('name', $validated['url'])
            ->first();

        if (is_null($searchUrl)) {
            $urlName = $validated['url']['name'];
            $parsedUrl = parse_url($urlName);
            $url = "{$parsedUrl['scheme']}://{$parsedUrl['host']}";
            $id = DB::table('urls')->insertGetId([
                'name' => $url,
                'created_at' => Carbon::now()->toString(),
                'updated_at' => Carbon::now()->toString()
            ]);
            flash(__('messages.flash.url_created'))->success();
        } else {
            $id = $searchUrl->id;
            flash(__('messages.flash.url_isset'))->success();
        }

        return redirect()->route('urls.show', ['url' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $urlRecord = DB::table('urls')->find($id);

        abort_unless($urlRecord, 404);

        $checks = DB::table('url_checks')
            ->where('url_id', $id)
            ->get();

        return view('url.pages.show', compact('urlRecord', 'checks'));
    }

}
