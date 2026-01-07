<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Monitor extends Model
{
    use HasFactory;

    // Add this line:
    protected $fillable = ['name', 'url', 'is_active'];

    public function checkLogs()
    {
        return $this->hasMany(CheckLog::class);
    }
}