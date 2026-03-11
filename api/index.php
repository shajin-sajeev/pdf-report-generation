<?php

// Forward Vercel requests to the Laravel index.php
// This handles the serverless environment pathing correctly
require __DIR__ . '/../public/index.php';
