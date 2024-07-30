<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Scheduling\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

function schedule(Schedule $schedule)
{
    // delete data invoice ketika invoice tenggat
    $schedule->command('orders:delete-expired')->daily();

    // mengirim notifikasi whatsapp
    $schedule->command('app:whatsapp-notify')->daily();
}

