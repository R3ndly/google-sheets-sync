<?php

namespace App\Console\Commands;

use App\Services\GoogleSheetsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GoogleFetchCommand extends Command
{
    protected $signature = 'google:fetch {count?}';
    protected $description = 'Fetch comments from Google Sheet';

    public function handle()
    {
        $spreadsheetId = Storage::get('google-sheet-id.txt');
        if (!$spreadsheetId) {
            $this->error('Google Sheet ID not set');
            return 1;
        }

        $service = new GoogleSheetsService();
        $service->setSpreadsheetId($spreadsheetId);

        $count = $this->argument('count');
        $comments = $service->getComments($count);

        $bar = $this->output->createProgressBar(count($comments));
        $bar->start();

        foreach ($comments as $comment) {
            $this->info("\nID: {$comment['id']}, Comment: {$comment['comment']}");
            $bar->advance();
        }

        $bar->finish();
        $this->info("\nDone!");
    }
}
