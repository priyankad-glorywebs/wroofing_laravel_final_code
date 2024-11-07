<?php
namespace App\Jobs;

use App\Models\Project;
use App\Models\ProjectImagesData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProcessProjectMedia implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    protected $originalName;
    protected $project_id;
    protected $user_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filePath, $originalName, $project_id, $user_id)
    {
        $this->filePath = $filePath;
        $this->originalName = $originalName;
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
        $filename = time() . "_" . \Str::random(3) . '_' . $this->originalName;

        $temporaryFilePath = storage_path('app/public/' . $this->filePath);

        if (!file_exists($temporaryFilePath)) {
            throw new \Exception("Temporary file does not exist: {$temporaryFilePath}");
        }

        $mediaType = explode('/', mime_content_type($temporaryFilePath))[0];

        $destinationPath = "project_images/{$filename}";
        Storage::disk('public')->move($this->filePath, $destinationPath);

        $projectImageData = new ProjectImagesData;
        $projectImageData->project_id = $this->project_id;
        $projectImageData->project_image = $filename;
        $projectImageData->credit_image = auth()->check() ? 1 : 0;
        $projectImageData->date = Carbon::now()->toDateString();
        $projectImageData->time = Carbon::now('Asia/Kolkata')->format('h:i A');
        $projectImageData->media_type = $mediaType;
        $projectImageData->created_by = $this->user_id->id;
        $projectImageData->save();

        $sumOfCreditImages = ProjectImagesData::where('credit_image', 1)
            ->where('project_id', $this->project_id)
            ->count();

        $project = Project::findOrFail($this->project_id);
        $project->credit = $sumOfCreditImages;
        $project->save();
    }

}
