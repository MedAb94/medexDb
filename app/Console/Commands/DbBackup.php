<?php

namespace App\Console\Commands;

use Cloudinary\Api\Upload\UploadApi;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class DbBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automating Daily Backups';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (! Storage::exists('backup')) {
            Storage::makeDirectory('backup');
        }

        $filename = "backup-" . Carbon::now()->format('d_m_y') .'_'.Carbon::now()->format('H_i'). ".gz";
       // dd($filename);

        $command = "mysqldump --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD')
            . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE')
            . "  | gzip > " . storage_path() . "/app/backup/" . $filename;

        $returnVar = NULL;
        $output  = NULL;

        exec($command, $output, $returnVar);
        if ($returnVar == 0) {
           // upload to google drive
            $file = storage_path() . "/app/backup/" . $filename;
            self::uploadToDrive($file);
            $this->info('Backup has been successful');
            // delete the file
            Storage::delete('backup/' . $filename);
        } else {
            $this->error('Backup has failed');
        }
    }

    static function uploadToDrive($file_path): void
    {
        try {
            $file_name =basename($file_path);
            $result = (new UploadApi())->upload($file_path, [
                'resource_type' => 'raw',
                'folder' => 'bk',
               'public_id' => $file_name
            ]);
//            dd($result);
//            echo 'Upload successful: ' . json_encode($result);
        } catch (Exception $e) {
            echo 'Upload failed: ' . $e->getMessage();
        }
//        $client = new Google_Client();
//        $client->setAccessToken(config('google.access_token'));
//        //dd($client->getAccessToken());
//        $client->setClientId(config('google.client_id'));
//        $client->setClientSecret(config('google.client_secret'));
//        if ($client->isAccessTokenExpired()) {
//            //  dd($client->getRefreshToken());
//            $client->fetchAccessTokenWithRefreshToken(config('google.refresh_token'));
//        }
//
//        $service = new Google_Service_Drive($client);
//        $file = new Google_Service_Drive_DriveFile();
//        $file->setName(basename($file_path));
//         $service->files->create($file, [
//            'data' => file_get_contents($file_path),
//            'mimeType' => 'application/gzip',
//            'uploadType' => 'multipart',
//        ]);

    }
}
