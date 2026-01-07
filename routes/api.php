<?php
use App\Models\Monitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/monitors', function () {
    // We load the monitor and its last 20 logs for the chart
    return Monitor::with(['checkLogs' => function($query) {
        $query->latest()->limit(20);
    }])->get();
});