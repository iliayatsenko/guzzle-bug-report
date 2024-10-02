<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;

require_once 'vendor/autoload.php';

$client = new Client();

$promises = [];
for ($i = 0; $i < 400; $i++) {
	$promises[] = makeRequestReturning404();
}

try {
	$results = Utils::all($promises)->wait();
	echo count($results);
} catch (RuntimeException $e) {
	echo $e->getMessage();
}

function makeRequestReturning404()
{
	global $client;

	return $client
		->getAsync('https://httpbin.org/status/404')
		->then(
			function ($response) {
				$content = (string)$response->getBody();
				$content = json_decode($content);

				return $content;
			},
			function ($exception) {
				throw new RuntimeException(
					sprintf(
						'Error connecting to the API: %s',
						$exception->getMessage()
					)
				);
			}
		);
}


