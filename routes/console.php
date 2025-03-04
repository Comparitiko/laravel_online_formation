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

// Command to delete all expired tokens from the database when expired time is greater than 72 hours at 05:00.
Schedule::command('sanctum:prune-expired --hours=1')->dailyAt('05:00');
