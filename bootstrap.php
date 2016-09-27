<?php

require_once __DIR__ . '/vendor/autoload.php';

// Load our Env file
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

// Create a Stormpath Client
/** @var \Stormpath\ClientBuilder $clientBuilder */
$clientBuilder = new \Stormpath\ClientBuilder();
$clientBuilder->setApiKeyProperties("apiKey.id=".getenv('STORMPATH_CLIENT_APIKEY_ID')."\napiKey.secret=".getenv('STORMPATH_CLIENT_APIKEY_SECRET'));
/** @var \Stormpath\Client $client */
$client = $clientBuilder->build();

// Get the Stormpath Application
/** @var \Stormpath\Resource\Application $application */
$application = $client->getDataStore()->getResource(getenv('STORMPATH_APPLICATION_HREF'), \Stormpath\Stormpath::APPLICATION);

// Get the User if found
$user = null;
if(request()->cookies->has('access_token')) {
	try {
		$decoded = JWT::decode(request()->cookies->get('access_token'), getenv('STORMPATH_CLIENT_APIKEY_SECRET'), ['HS256']);
		$user = $client->getDataStore()->getResource($decoded->sub, \Stormpath\Stormpath::ACCOUNT);
	} catch (\Stormpath\Resource\ResourceError $re) {
		error($re->getDeveloperMessage());
	}
}

