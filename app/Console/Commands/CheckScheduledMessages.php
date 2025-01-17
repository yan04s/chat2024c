<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ChatMessage;
use App\Events\MessageSent;

class CheckScheduledMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-scheduled-messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $messages = ChatMessage::whereNotNull('scheduleAt')
            ->where('scheduleAt', '=', now())
            ->get();

        // Iterate through each message and broadcast it
        foreach ($messages as $message) {
            // Broadcast the message
            broadcast(new MessageSent($message));

            // Optionally, you can add a log or console output for each broadcasted message
            $this->info('Broadcasted scheduled message with ID: ' . $message->id);
        }
    }
}
