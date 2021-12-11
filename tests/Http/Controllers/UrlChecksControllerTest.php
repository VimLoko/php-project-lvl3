<?php

namespace Tests\Http\Controllers;

use App\Http\Controllers\UrlChecksController;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\TestCase;

class UrlChecksControllerTest extends TestCase
{
    private $urlId;
    protected function setUp(): void
    {
        parent::setUp();

        $generatedHostName = 'http://' . strtolower(Str::random(5)) . ".ru";
        DB::beginTransaction();
        $this->urlId = DB::table('urls')->insertGetId([
            'name' => $generatedHostName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }

    public function testStore()
    {
        $checkSiteId = ['id' => $this->urlId];
        $response = $this->post(route('check_url', ['id' => $this->urlId]), $checkSiteId);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('url_checks', ['url_id' => $this->urlId]);
    }

    public function tearDown(): void
    {
        DB::rollBack();
    }
}
