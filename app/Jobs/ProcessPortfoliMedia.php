<?php

namespace App\Jobs;

use App\Models\ContractorPortfolio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProcessPortfoliMedia implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    protected $fileName;
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filePath, $fileName, $user)
    {
        $this->filePath = $filePath;
        $this->fileName = $fileName;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $temporaryFilePath = storage_path('app/public/' . $this->filePath);

        if (!file_exists($temporaryFilePath)) {
            throw new \Exception("Temporary file does not exist: {$temporaryFilePath}");
        }

        $mediaType = explode('/', mime_content_type($temporaryFilePath))[0];
        $date = now()->toDateString();
        // $time = now()->toTimeString();
        $timeFormatted = Carbon::now('Asia/Kolkata')->format('h:i A');


        ContractorPortfolio::create([
            'contractor_id' => $this->user->id,
            'image' => $this->filePath,
            'date' => $date,
            'time' => $timeFormatted,
            'media_type' => $mediaType,
        ]);
    }
}
