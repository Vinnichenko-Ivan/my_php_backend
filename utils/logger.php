<?php
function log_in_file($status, $message): void
{
    $log = date('Y-m-d H:i:s') . ' ' . $status . ' ' . $message;
    file_put_contents(__DIR__ . '/../log.txt', $log . PHP_EOL, FILE_APPEND);
}

function log_info($message): void
{
    log_in_file('[INFO]', $message);
}

function log_warning($message): void
{
    log_in_file('[WARN]', $message);
}

function log_err($message): void
{
    log_in_file('[ERROR]', $message);
}

function drop_log()
{
    file_put_contents(__DIR__ . '/../log.txt', '');
}