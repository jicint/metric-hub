<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Illuminate\Foundation\Inspiring::quote());
})->purpose('Display an inspiring quote');

// By using the full path \Illuminate\Support\Facades\Schedule, 
// PHP doesn't need a "use" statement at the top.
\Illuminate\Support\Facades\Schedule::command('monitors:ping')->everyMinute();