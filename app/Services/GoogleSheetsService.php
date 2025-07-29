<?php

namespace App\Services;

use Google_Client;
use Google_Service_Sheets;
use Google_Service_Sheets_ValueRange;
use Illuminate\Support\Facades\Storage;

class GoogleSheetsService
{
    protected $client;
    protected $service;
    protected $spreadsheetId;
    protected $sheetName = 'Sheet1';

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setApplicationName(config('app.name'));
        $this->client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
        $this->client->setAuthConfig(storage_path('app/google-credentials.json'));
        $this->client->setAccessType('offline');

        $this->service = new Google_Service_Sheets($this->client);
    }

    public function setSpreadsheetId($spreadsheetId)
    {
        $this->spreadsheetId = $spreadsheetId;
    }

    public function syncItems($items)
    {
        if (!$this->spreadsheetId) {
            throw new \Exception('Spreadsheet ID not set');
        }

        $response = $this->service->spreadsheets_values->get(
            $this->spreadsheetId,
            $this->sheetName
        );
        $existingData = $response->getValues();

        $newData = [
            ['ID', 'Name', 'Status', 'Description', 'Created At', 'Updated At']
        ];

        foreach ($items as $item) {
            $newData[] = [
                $item->id,
                $item->name,
                $item->status,
                $item->description,
                $item->created_at,
                $item->updated_at,
            ];
        }

        $comments = [];
        if ($existingData && count($existingData) {
            foreach ($existingData as $row) {
                if (count($row) > count($newData[0])) {
                    $comments[$row[0]] = $row[count($newData[0])];
                }
            }
        }

        foreach ($newData as &$row) {
            if (isset($row[0]) {
                $id = $row[0];
                if (isset($comments[$id])) {
                    $row[] = $comments[$id];
                }
            }
        }

        $range = $this->sheetName;
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $newData
        ]);
        $params = [
            'valueInputOption' => 'RAW'
        ];

        $this->service->spreadsheets_values->clear($this->spreadsheetId, $range, new \Google_Service_Sheets_ClearValuesRequest());
        $this->service->spreadsheets_values->update(
            $this->spreadsheetId,
            $range,
            $body,
            $params
        );
    }

    public function getComments($count = null)
    {
        $response = $this->service->spreadsheets_values->get(
            $this->spreadsheetId,
            $this->sheetName
        );
        $values = $response->getValues();

        $comments = [];
        $headers = $values[0] ?? [];
        $commentColumnIndex = count($headers);

        foreach ($values as $i => $row) {
            if ($i === 0) continue;

            if (isset($row[0]) && isset($row[$commentColumnIndex])) {
                $comments[] = [
                    'id' => $row[0],
                    'comment' => $row[$commentColumnIndex]
                ];
            }

            if ($count && count($comments) >= $count) {
                break;
            }
        }

        return $comments;
    }
}
