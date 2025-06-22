<?php

namespace App\Console;

use App\Models\Lease;
use App\Models\User;
use App\Notifications\LeaseExpiringSoon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Collection;

class Kernel extends ConsoleKernel
{
    /**
     * Zarejestruj zadania konsoli aplikacji.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    /**
     * Zdefiniuj harmonogram poleceń.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function (): void {
            // pobierz umowy wygasające w ciągu 30 dni
            $leases = Lease::with(['tenant', 'unit.property'])
                ->whereBetween('end_date', [now(), now()->addDays(30)])
                ->get();

            if ($leases->isEmpty()) {
                return;
            }

            // wyślij powiadomienie do wszystkich użytkowników
            User::all()->each(fn (User $user) => $user->notify(new LeaseExpiringSoon($leases)));
        })->daily()->name('leases:expiring-reminder');
    }
}
