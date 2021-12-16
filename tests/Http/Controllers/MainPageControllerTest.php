<?php

namespace Tests\Http\Controllers;

use App\Http\Controllers\MainPageController;
use Tests\TestCase;

class MainPageControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get(route('main'));
        $response->assertOk();
    }
}
