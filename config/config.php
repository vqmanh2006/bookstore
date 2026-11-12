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

// Variables
const ROW_OF_PAGE = 10;
