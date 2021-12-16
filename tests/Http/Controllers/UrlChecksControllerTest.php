<?php

namespace Tests\Http\Controllers;

use App\Http\Controllers\UrlChecksController;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class UrlChecksControllerTest extends TestCase
{
    private int $urlId;
    private string $generatedHostName;

    protected function setUp(): void
    {
        parent::setUp();

        $this->generatedHostName = 'http://' . strtolower(Str::random(5)) . ".ru";
        DB::beginTransaction();
        $this->urlId = DB::table('urls')->insertGetId([
            'name' => $this->generatedHostName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }

    public function testStore()
    {
        $checkSiteId = [
            'id' => $this->urlId
        ];

        $html = file_get_contents(
            implode(
                DIRECTORY_SEPARATOR,
                [__DIR__, '..', '..', "Fixtures", 'response.html']
            )
        );

        if ($html  === false) {
            throw new \Exception("Can't read response.html");
        }

        Http::fake([
            $this->generatedHostName => Http::response($html, 200),
        ]);

        $response = $this->post(
            route('check_url', $checkSiteId),
            $checkSiteId
        );
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $record = [
            'url_id' => $this->urlId,
            'status_code' => 200,
            'h1' => 'Test H1',
            'title' => 'Test Title',
            'description' => 'test description'
        ];

        $this->assertDatabaseHas('url_checks', $record);
    }

    public function tearDown(): void
    {
        DB::rollBack();
    }
}
