<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_news_list_show_status()
    {
        $response = $this->get(route('admin.news.index'));

        $response->assertStatus(200);
    }
    public function test_admin_news_list_is_view()
	{
		$response = $this->get(route('admin.news.index'));

		$response->assertViewIs('admin.news.index');
	}

	public function test_admin_create_news_status()
	{
		$response = $this->get(route('admin.news.create'));

		$response->assertStatus(200);
	}
	public function test_admin_create_news_dont_see_news()
	{
		$response = $this->get(route('admin.news.create'));

		$response->assertDontSee('NOT FOUND');
	}

}
