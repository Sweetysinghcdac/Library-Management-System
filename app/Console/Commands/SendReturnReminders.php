<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Notifications\ReturnReminder;
use Illuminate\Support\Carbon;

class SendReturnReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:reminders';
    protected $description = 'Send return reminders to users whose book is due soon';

    public function handle()
    {
        $tomorrow = Carbon::tomorrow();

        $bookings = Booking::with('user', 'book')
            ->whereDate('due_date', $tomorrow)
            ->where('status', 'pending')
            ->get();

        foreach ($bookings as $booking) {
            $booking->user->notify(new ReturnReminder($booking->book->title, $booking->due_date->format('d M Y')));
        }

        $this->info('Return reminders sent successfully.');
    }
}
