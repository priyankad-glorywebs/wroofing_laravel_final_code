<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\ProjectImagesData;
use Carbon\Carbon;
use Illuminate\Support\Str;



class ProcessMediaUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $fileInfo;

    /**
     * Create a new job instance.
     */
    public function __construct($fileInfo)
    {
        $this->fileInfo = $fileInfo;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $projectImageData = new ProjectImagesData;
        $projectImageData->project_id = $this->fileInfo['projectId'];
        $projectImageData->project_image = $this->fileInfo['filename'];
        $projectImageData->date = Carbon::now()->toDateString();
        $projectImageData->time = Carbon::now('Asia/Kolkata')->format('h:i A');
        $projectImageData->media_type = $this->fileInfo['mediaType'];
        $projectImageData->created_by = $this->fileInfo['userId'];
        $projectImageData->save();
    }
}



