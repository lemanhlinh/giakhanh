<?php

namespace App\Jobs;

use App\Mail\MailBookTable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailBookTable implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $store;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $store)
    {
        $this->data = $data;
        $this->store = $store;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->data['email']){
            Mail::to($this->data['email'])->cc('linhlemanh209@gmail.com')->send(new MailBookTable($this->data, $this->store));
        }else{
            Mail::to('linhlemanh209@gmail.com')->send(new MailBookTable($this->data, $this->store));
        }
    }
}
