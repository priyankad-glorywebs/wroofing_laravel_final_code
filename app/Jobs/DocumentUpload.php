<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

use App\Models\Project;
use App\Models\ProjectDocument;

class DocumentUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $projectId;
    protected $documentType;
    protected $fileName;
    protected $filePath;

    /**
     * Create a new job instance.
     */
    public function __construct($projectId, $documentType, $fileName, $filePath)
    {
        $this->projectId = $projectId;
        $this->documentType = $documentType;
        $this->fileName = $fileName;
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $directory = "project_documents_laststage";
        $publicDirectory = public_path($directory);

        if (!file_exists($publicDirectory)) {
            mkdir($publicDirectory, 0755, true);
        }
        $originalFileName = microtime(true) * 2 . '_' . random_int(1, 9) . '_' . $this->fileName;

        $copied = copy(storage_path('app/' . $this->filePath), $publicDirectory . '/' . $originalFileName);

        if (!$copied) {
            throw new \Exception("Failed to copy file to destination directory.");
        }

        if (Auth::guard('contractor')->check()) {
            $projectData = Project::where('id', (int)$this->projectId)->first();
            $data = ProjectDocument::create([
                "project_id" => (int)$this->projectId,
                "document_name" => $this->documentType,
                "document_file" => $directory . '/' . $originalFileName,
                "created_by" => $projectData->user_id,
                "updated_by" => $projectData->user_id,
            ]);
        }else{
            $data = ProjectDocument::create([
                "project_id" => (int)$this->projectId,
                "document_name" => $this->documentType,
                "document_file" => $directory . '/' . $originalFileName,
                "created_by" => auth()->id(),
                "updated_by" => auth()->id(),
            ]);
        }

        return $data;
    }
}
