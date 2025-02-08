<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Command to recreate the database and run seeds.
Artisan::command('db:recreate', function () {
    $this->call('migrate:fresh');
    $this->call('db:seed');
    $this->info('Database recreated and seeded!');
});
