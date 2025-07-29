<?php

namespace App\Console\Commands;

use App\Models\Item;
use App\Services\GoogleSheetsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SyncGoogleSheetCommand extends Command
{
    protected $signature = 'google:sync';
    protected $description = 'Sync database with Google Sheet';

    public function handle()
    {
        $spreadsheetId = Storage::get('google-sheet-id.txt');
        if (!$spreadsheetId) {
            $this->error('Google Sheet ID not set');
            return 1;
        }

        $items = Item::allowed()->get();
        $service = new GoogleSheetsService();
        $service->setSpreadsheetId($spreadsheetId);
        $service->syncItems($items);

        $this->info('Sync completed!');
    }
}
