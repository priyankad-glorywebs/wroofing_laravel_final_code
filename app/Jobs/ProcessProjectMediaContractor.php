<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\ProjectImagesData;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProcessProjectMediaContractor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    protected $project_id;
    protected $user_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filePath, $project_id, $user_id)
    {
        $this->filePath = $filePath;
        $this->project_id = $project_id;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Get the file from the temporary storage
        $file = Storage::disk('public')->get($this->filePath);
        $filename = time() . "_" . Str::random(3) . '_' . basename($this->filePath);
        $mediaType = explode('/', mime_content_type(storage_path('app/public/' . $this->filePath)))[0];

        // Move the file to the permanent storage location
        Storage::disk('public')->move($this->filePath, "project_images/{$filename}");

        $projectImageData = new ProjectImagesData;
        $projectImageData->project_id = $this->project_id;
        $projectImageData->project_image = $filename;
        $projectImageData->date = Carbon::now()->toDateString();
        $timeFormatted = Carbon::now('Asia/Kolkata')->format('h:i A');
        $projectImageData->time = $timeFormatted;
        $projectImageData->media_type = $mediaType;
        $projectImageData->created_by = $this->user_id;
        $projectImageData->save();
    }
}
