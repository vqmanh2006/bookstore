<?php
$projectRoot = realpath(__DIR__ . '/..');
$documentRoot = realpath($_SERVER['DOCUMENT_ROOT'] ?? '');
$baseUrl = '';

if ($projectRoot !== false && $documentRoot !== false && strpos($projectRoot, $documentRoot) === 0) {
    $baseUrl = rtrim(str_replace(DIRECTORY_SEPARATOR, '/', substr($projectRoot, strlen($documentRoot))), '/');
}

define('BASE_URL', $baseUrl);
define('ADMIN_URL', BASE_URL . '/admin');
define('ADMIN_TEMPLATE_URL', BASE_URL . '/assets/Admin-LTE');
define('HOME_TEMPLATE_URL', BASE_URL . '/assets/Home');

function AppUrl($path)
{
    $path = trim((string) $path);
    if ($path === '') {
        return '';
    }

    if (preg_match('/^(?:https?:)?\\/\\//i', $path)) {
        return $path;
    }

    if (BASE_URL !== '' && ($path === BASE_URL || strpos($path, BASE_URL . '/') === 0)) {
        return $path;
    }

    return BASE_URL . '/' . ltrim($path, '/');
}

// Variables
const ROW_OF_PAGE = 10;
