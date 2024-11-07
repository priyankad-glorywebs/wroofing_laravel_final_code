<?php
use App\Models\Project; // model
use App\Models\ProjectImagesData; //model
use App\Models\ProjectDocument; //model
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Settings;


/* start details page progressbar */
function  get_progress_bar_score($project_id){
    // dd($project_id);
    /* step 1 */
    $data = Project::where('id',$project_id)->first();
    $projectAddress 	= null;	
    $projectIcompany	= null;
    $projectIagency 	= null;
    $projectBill  		= null;
    $projectMcompany  	= null;
    if(isset($data) && !empty($data)){
        $projectAddress 	= $data->address;	
        $projectIcompany	= $data->insurance_company;
        $projectIagency 	= $data->insurance_agency;
        $projectBill  		= $data->billing;
        $projectMcompany  	= $data->mortgage_company;
    }
    $progressbar_Per = 00;
    if(!empty($projectAddress) && !empty($projectIcompany) && !empty($projectIagency) && !empty($projectBill) && !empty($projectMcompany)){
        $progressbar_Per = 40;
    }

    /* step 2 */
    $projectImageData = ProjectImagesData::where('project_id', $project_id)
	->orderBy('date', 'desc')
	->get();
	$groupedData = $projectImageData->groupBy('date');
    if(isset($groupedData) && !empty($groupedData)){
        foreach($groupedData as $groupedDataVal){
            if(count(value: $groupedDataVal) > 0){
                $progressbar_Per = 70;
            }
        }
    }

    /* step 3 */
    $documentsData = ProjectDocument::where("project_id", $project_id)->get();
    
    if($documentsData->isNotEmpty()){
        $totaldoc = null;  // Reset totaldoc
        $docTypes = ['documents', 'insurancedocuments', 'mortgagedocuments', 'contractordocuments'];
    
        foreach ($documentsData as $val) {
            // Check if document_name is one of the defined types and has a document_file
            if (in_array($val->document_name, $docTypes) && isset($val->document_file)) {
                $totaldoc = ($totaldoc ?? 0) + 10; // Increment by 10
                // Remove the checked document from the array to avoid rechecking
                $docTypes = array_diff($docTypes, [$val->document_name]);
            }
        }
    
        // Determine the progress based on $totaldoc
        switch($totaldoc) {
            case 10:
                $progressbar_Per += 10;
                break;
            case 20:
                $progressbar_Per += 20;
                break;
            case 30:
                $progressbar_Per += 20;
                break;
            case 40:
                $progressbar_Per += 30;
                break;
        }
    }
    return $progressbar_Per;
}
/* end details page progressbar */

function is_image($filename)
{
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    return in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
}

function is_video_file($filename)
{
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    return in_array($extension, ['mp4', 'avi', 'mov', 'mkv']);
}

function generateUniqueFileName($originalName, $extension)
{
    $baseName = pathinfo($originalName, PATHINFO_FILENAME);
    $uniqueId = uniqid();
    $fileName = $baseName . '_' . $uniqueId . '.' . $extension;
    $count = 1;

    while (file_exists($fileName)) {
        $fileName = $baseName . '_' . $uniqueId . '-' . $count . '.' . $extension;
        $count++;
    }

    return $fileName;
}
    

if (!function_exists('imageExists')) {
    function imageExists($path) {
        if (File::exists(public_path($path))) {
            return true;
        }
        if (Storage::disk('public')->exists($path)) {
            return true;
        }
       
        return false;
    }
}

if (!function_exists('get_front_general_settings')) {
    function get_front_general_settings()
    {
        $settings = Settings::all();
        $dataArr = [];
        if (!empty($settings)) {
            $settings = $settings->toArray();
            if (!empty($settings)) {
                foreach ($settings as $settingsVal) {
                    $dataArr = json_decode($settingsVal['value'], true);
                }
            }
        }
        return $dataArr;
    }
}


function isImage($filePath) {
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'];
    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    return in_array($extension, $allowedExtensions);
}