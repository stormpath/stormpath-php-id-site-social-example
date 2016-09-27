<?php
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__ . '/bootstrap.php';

$url = $application->createIdSiteUrl(['callbackUri' => 'http://stormpathsocial.dev/handleCallback.php']);

$response = Response::create('', Response::HTTP_FOUND, ['Location' => $url])->send();
