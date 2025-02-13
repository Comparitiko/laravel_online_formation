<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Command to recreate the database and run seeds.
Artisan::command('db:recreate', function () {
    $this->call('migrate:fresh');
    $this->call('db:seed');
    $this->info('Database recreated and seeded!');
});

// Command to delete all expired tokens from the database when they are older than 24 hours.
Schedule::command('sanctum:prune-expired --hours=24')->everyMinute();
