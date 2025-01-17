<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// https://www.metizsoft.com/blog/whats-new-in-laravel-11#:~:text=Kernel%20Consol%20No%20Longer%20Available,of%20console%20commands%20during%20development.
// https://www.google.com/search?q=missing+console%2Fkernel.php+laravel&rlz=1C5CHFA_enMY1048MY1048&oq=missing+console%2Fkernel.php+laravel&gs_lcrp=EgZjaHJvbWUyBggAEEUYOTIHCAEQIRigATIHCAIQIRiPAjIHCAMQIRiPAtIBCTExODg4ajBqNKgCALACAQ&sourceid=chrome&ie=UTF-8
// https://www.youtube.com/watch?v=upJH4Xc1NY4
Schedule::command('app:check-scheduled-messages')
    ->everySecond();
// supervisor // sudo cat /etc/supervisor/conf.d/reverb.conf

