<?php

namespace Tests\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\TestCase;

class UrlControllerTest extends TestCase
{
    private int $id;

    protected function setUp(): void
    {
        parent::setUp();

        $generatedHostName = 'http://' . strtolower(Str::random(5)) . ".ru";
        DB::beginTransaction();
        $this->id = DB::table('urls')->insertGetId([
            'name' => $generatedHostName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }

    public function testIndex()
    {
        $response = $this->get(route('urls.index'));
        $response->assertOk();
    }

    public function testStore()
    {
        $generatedHostName = 'http://' . strtolower(Str::random(5)) . ".ru";
        $urlData = ['url' => ['name' => $generatedHostName]];
        $response = $this->post(route('urls.store'), $urlData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('urls', $urlData['url']);
    }

    public function testShow()
    {
        $response = $this->get(route('urls.index', ['id' => $this->id]));
        $response->assertOk();
    }

    protected function tearDown(): void
    {
        DB::rollBack();
        parent::tearDown();
    }
}
