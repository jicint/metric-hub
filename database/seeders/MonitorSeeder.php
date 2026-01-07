<?php
use App\Models\Monitor;
use App\Models\CheckLog;

public function run(): void
{
    $monitor = Monitor::create([
        'name' => 'Google Search',
        'url' => 'https://www.google.com',
    ]);

    // Create 20 fake logs with random latency between 50ms and 500ms
    for ($i = 0; $i < 20; $i++) {
        CheckLog::create([
            'monitor_id' => $monitor->id,
            'status_code' => 200,
            'response_time' => rand(50, 500),
            'created_at' => now()->subMinutes(20 - $i),
        ]);
    }
}