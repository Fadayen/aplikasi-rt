<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\WhatsappService;

class SendWhatsappJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;      // retry max 3x
    public $backoff = 10;   // jeda 10 detik antar retry

    protected $phone;
    protected $message;

    public function __construct($phone, $message)
    {
        $this->phone   = $phone;
        $this->message = $message;
    }

    public function handle(): void
    {
        WhatsappService::send($this->phone, $this->message);
    }
}

