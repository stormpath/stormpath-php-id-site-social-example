<?php

/**
 * @param mixed|string $content
 * @param int $status
 * @param array $headers
 * @return \Symfony\Component\HttpFoundation\Response
 */
function response($content = '', $status = 200, $headers = []) {
	return new \Symfony\Component\HttpFoundation\Response($content, $status, $headers);
}

/**
 * @return \Symfony\Component\HttpFoundation\Request
 */
function request()
{
	return \Symfony\Component\HttpFoundation\Request::createFromGlobals();
}

/**
 * @param $message
 */
function error($message)
{
	print "<pre>ERROR: {$message}</pre>";
}

/**
 *
 */
function getFooter()
{
	require __DIR__ . '/_partials/footer.php';
}

/**
 *
 */
function getHead()
{
	require __DIR__ . '/_partials/head.php';
}

/**
 * @param $user
 */
function getNav($user)
{
	require __DIR__ . '/_partials/nav.php';
}