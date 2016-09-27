<?php
require_once __DIR__ . '/bootstrap.php';

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;

$exchangeIdSiteTokenRequest = new \Stormpath\Oauth\ExchangeIdSiteTokenRequest(request()->get('jwtResponse'));
$auth = new \Stormpath\Oauth\ExchangeIdSiteTokenAuthenticator($application);
$result = $auth->authenticate($exchangeIdSiteTokenRequest);

$accessToken = new Cookie("access_token", $result->getAccessTokenString(), time()+3600, '/', 'stormpathsocial.dev');
$refreshToken = new Cookie("refresh_token", $result->getRefreshTokenString(), time()+3600, '/', 'stormpathsocial.dev');
$response = Response::create('', Response::HTTP_FOUND, ['Location' => '/']);
$response->headers->setCookie($accessToken);
$response->headers->setCookie($refreshToken);

$response->send();