<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\Parser;

class ParserService implements Parser
{
	public function getData(string $url): array
	{
        $load = \XmlParser::load($url);

        return $load->parse([
        	'title' => [
        		'uses' => 'channel.title'
			],
			'link' => [
				'uses' => 'channel.link'
			],
			'description' => [
				'uses' => 'channel.description'
			],
			'image' => [
				'uses' => 'channel.image.url'
			],
			'news' => [
				'uses' => 'channel.item[title,link,guid,description,pubDate]'
			]
		]);
	}

	public function saveData(string $url): void
	{
		$data = $this->getData($url);
		$e = explode("/", $url);
		$fileName = end($e);

		$response = json_encode($data);
		\Storage::append('news/' . $fileName . ".txt", $response);
	}
}