<?php
// Start the Laravel queue worker
exec('php artisan queue:work > /dev/null 2>&1 &');
