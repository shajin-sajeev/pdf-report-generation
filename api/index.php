<?php

/**
 * Vercel Entry Point
 * This file forwards requests to the Laravel index.php while 
 * ensuring the serverless environment is correctly configured.
 */

// Use native getenv() instead of Laravel's env() since the framework isn't loaded yet
if (getenv('VERCEL_JOB_ID')) {
    $_ENV['APP_STORAGE'] = '/tmp/storage';
}

require __DIR__ . '/../public/index.php';
