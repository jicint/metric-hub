<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckLog extends Model
{
    protected $table = 'check_logs';

    // This array tells Laravel these columns are safe to write to
    protected $fillable = [
        'monitor_id',
        'status_code',
        'response_time',
    ];

    public function monitor()
    {
        return $this->belongsTo(Monitor::class);
    }
}