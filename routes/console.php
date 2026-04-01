<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::command('filepond:clear')->everyTenMinutes();
Schedule::command('track:update')->everySixHours();