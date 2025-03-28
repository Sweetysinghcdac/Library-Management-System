<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReturnReminder extends Notification implements ShouldQueue
{
    use Queueable;

    use Queueable;

    public $bookTitle;
    public $dueDate;

    public function __construct($bookTitle, $dueDate)
    {
        $this->bookTitle = $bookTitle;
        $this->dueDate = $dueDate;
    }

    public function via($notifiable)
    {
        return ['mail','database']; // or add 'database' for UI notification
    }

    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
                    ->subject("📚 Book Return Reminder")
                    ->greeting("Hello {$notifiable->name},")
                    ->line("This is a reminder to return the book '{$this->bookTitle}' by {$this->dueDate}.")
                    ->line("Please make sure to return it on time to avoid late penalties.")
                    ->action('View Your Borrowings', url('/visitor/dashboard'))
                    ->line('Thank you for using our library!');
    }
    public function toDatabase($notifiable)
    {
        return [
            'message' => "Reminder: Return '{$this->bookTitle}' by {$this->dueDate}.",
            'url' => url('/visitor/dashboard'),
        ];
    }
}

