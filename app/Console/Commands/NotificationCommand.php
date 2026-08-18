<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\Notifikasi;


class NotificationCommand extends Command
{

    protected $signature = 'notifikasi:command';
    protected $description = 'notifikasi baru';
    /**
     * Execute the console command.
     */
    public function handle()
    {

        Notifikasi::create([

            'pesan' => 'cek notifikasi baru'

        ]);

        return Command::SUCCESS;
        //
    }
}
