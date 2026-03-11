<?php

/**
 * Vercel Entry Point
 * This file forwards requests to the Laravel index.php while 
 * ensuring the serverless environment is correctly configured.
 */

// Set the storage path to /tmp for Vercel's read-only filesystem
// Note: We also do this in bootstrap/app.php for deeper integration
if (env('VERCEL_JOB_ID')) {
    $_ENV['APP_STORAGE'] = '/tmp/storage';
}

require __DIR__ . '/../public/index.php';
