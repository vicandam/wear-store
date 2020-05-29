<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DealerTest extends TestCase
{
    /**
     * @test
     *
     * ./vendor/bin/phpunit --filter=test_dealer_paginate_no_search_keyword tests/Feature/DealerTest.php
     */
    public function test_dealer_paginate_no_search_keyword()
    {

        // data
        $data = [
            'keyword' => ''
        ];

        $response = $this->json(
            'GET',
            'dealers',
            $data
        );

        $response->assertStatus(200);
    }
    /**
     * @test
     *
     * ./vendor/bin/phpunit --filter=test_dealer_paginate_with_search_keyword tests/Feature/DealerTest.php
     */
    public function test_dealer_paginate_with_search_keyword()
    {

        // data
        $data = [
            'keyword' => 'a'
        ];

        $response = $this->json(
            'GET',
            'dealers',
            $data
        );

        $response->assertStatus(200);
    }


}
