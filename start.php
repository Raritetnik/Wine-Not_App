<?php
// Start the Laravel development server
exec('php artisan serve --host=0.0.0.0 --port=8080 > /dev/null 2>&1 &');

// Start the Laravel queue worker
exec('php artisan queue:work > /dev/null 2>&1 &');