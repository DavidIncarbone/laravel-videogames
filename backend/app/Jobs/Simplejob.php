<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class Simplejob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    protected $message;

    /**
     * Create a new job instance.
     */
    public function __construct($_message)
    {
        $this->message = $_message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Esecuzione del SimpleJob: ' . $this->message);
    }
}
