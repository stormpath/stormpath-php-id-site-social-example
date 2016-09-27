<?php

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__ . '/bootstrap.php';

if(request()->cookies->has('access_token')) {
	$decoded = JWT::decode(request()->cookies->get('access_token'), getenv('STORMPATH_CLIENT_APIKEY_SECRET'), ['HS256']);
	$client->getDataStore()->getResource('/accessTokens/'.$decoded->jti, \Stormpath\Stormpath::ACCESS_TOKEN)->delete();

}

if(request()->cookies->has('refresh_token')) {
	$decoded = JWT::decode(request()->cookies->get('refresh_token'), getenv('STORMPATH_CLIENT_APIKEY_SECRET'), ['HS256']);
	$client->getDataStore()->getResource('/refreshTokens/'.$decoded->jti, \Stormpath\Stormpath::REFRESH_TOKEN)->delete();
}

$accessToken = new Cookie("access_token", 'expired', time()-4200, '/', 'stormpathsocial.dev');
$refreshToken = new Cookie("refresh_token", 'expired', time()-4200, '/', 'stormpathsocial.dev');
$response = Response::create('', Response::HTTP_FOUND, ['Location' => '/']);
$response->headers->setCookie($accessToken);
$response->headers->setCookie($refreshToken);

$response->send();