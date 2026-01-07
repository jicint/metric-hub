<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Monitor;
use App\Models\CheckLog;

class PingMonitors extends Command
{
    protected $signature = 'monitors:ping';
    protected $description = 'Ping all active monitors and log response times';

    public function handle()
{
    // If you have zero active monitors, this loop won't run.
    $monitors = \App\Models\Monitor::where('is_active', true)->get();
    
    if ($monitors->isEmpty()) {
        $this->warn("No active monitors found in the database.");
        return;
    }

    foreach ($monitors as $monitor) {
        $this->info("Pinging {$monitor->name}...");
        
        $start = microtime(true);
        try {
            $response = \Illuminate\Support\Facades\Http::get($monitor->url);
            $duration = round((microtime(true) - $start) * 1000);

            \App\Models\CheckLog::create([
                'monitor_id' => $monitor->id,
                'status_code' => $response->status(),
                'response_time' => $duration,
            ]);

            $this->info("Success: {$duration}ms");
        } catch (\Exception $e) {
            $this->error("Failed: " . $e->getMessage());
        }
    }
}
}