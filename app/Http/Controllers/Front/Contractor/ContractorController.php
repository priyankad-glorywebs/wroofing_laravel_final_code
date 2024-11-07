<?php

namespace App\Http\Controllers\Front\Contractor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectImagesData;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectDocument;
use App\Models\Contractor;
use App\Models\Quotation;
use Illuminate\Support\Facades\Validator; // validator
use App\Jobs\ProcessProjectMediaContractor;
use App\Models\ContractorPortfolio;
use App\Jobs\DocumentUpload;
use DB;




class ContractorController extends Controller
{


    public function index($project_id, Request $request)
    {

        $contarctorList = Contractor::get();
        $projectData = Project::where('id', $project_id)->first();
        $quoteData = Quotation::where('project_id', base64_decode($project_id))->pluck('contractor_id')->toArray();
        $quotations = Quotation::where('project_id', base64_decode($project_id))->get();
        $c_id = $request->c_id ?? '';

        $portfolio = [];
        if ($request->ajax() && !empty($c_id)) {
            $portfolio = ContractorPortfolio::where('contractor_id', $c_id)->get();
            return view('layouts.front.projects.gallery-portfolio', compact('portfolio'))->render();
        }

        return view('layouts.front.contractor', compact('project_id', 'contarctorList', 'projectData', 'quoteData', 'quotations', 'portfolio'));
    }

    public function contractorProjectList(Request $request) // working code 
    {

        // if ($request->from_date != NULL && $request->to_date != NULL || $request->title)  {
                if ($request->title != NULL || $request->from_date != NULL && $request->to_date !== NULL) {  
            $query = User::query()->join('projects', 'users.id', '=', 'projects.user_id');
            $to_date = Carbon::createFromFormat('m-d-Y', $request->to_date)->format('Y-m-d');
            $from_date = Carbon::createFromFormat('m-d-Y', $request->from_date)->format('Y-m-d');

            $query->when($to_date, function ($q) use ($to_date) {
                $q->whereDate('projects.created_at', '<=', $to_date);
            });

            $query->when($from_date, function ($q) use ($from_date) {
                $q->whereDate('projects.created_at', '>=', $from_date);
            });

            if ($request->title) {
                $query->where(function ($subQuery) use ($request) {
                    $subQuery->where('projects.title', 'LIKE', '%' . $request->title . '%')
                        ->orWhere('projects.project_status', 'LIKE', '%' . $request->title . '%')
                        ->orWhere('users.name', 'LIKE', '%' . $request->title . '%')
                        ->orWhere('projects.id', 'LIKE', '%' . $request->title . '%')
                        ->orWhere('users.email', 'LIKE', '%' . $request->title . '%')
                        ->orWhere('users.contact_number', 'LIKE', '%' . $request->title . '%');
                });
            }

            if ($request->has('project_status') && $request->project_status && $request->project_status != 'all') {
                $query->where('projects.project_status', $request->project_status);
            }

            if ($request->ajax()) {
                $projects = $query->orderBy('projects.id', 'DESC')->paginate(10);

                // dd($projects);
                $view = view('layouts.front.projects.contractor.contractordashboard', compact('projects'))->render();
                return response()->json(['html' => $view]);
            }
        } else {
            $currentMonth = Carbon::now()->month;
            $projects = Project::whereMonth('projects.created_at', $currentMonth)
                ->orderBy('projects.id', 'DESC')
                ->paginate(10);
        }
        return view('layouts.front.projects.contractor.contractor-project-list', compact('projects'));
    }





// public function contractorProjectList(Request $request)
// {
//     $query = User::query()->join('projects', 'users.id', '=', 'projects.user_id');
    
//     if ($request->title || ($request->from_date && $request->to_date)) {
//         // Process date filters
//         if ($request->from_date && $request->to_date) {
//             $from_date = Carbon::createFromFormat('m-d-Y', $request->from_date)->format('Y-m-d');
//             $to_date = Carbon::createFromFormat('m-d-Y', $request->to_date)->format('Y-m-d');
            
//             $query->whereBetween('projects.created_at', [$from_date, $to_date]);
//         }

//         // Process title filter
//         if ($request->title) {
//             $query->where(function ($subQuery) use ($request) {
//                 $subQuery->where('projects.title', 'LIKE', '%' . $request->title . '%')
//                     ->orWhere('projects.project_status', 'LIKE', '%' . $request->title . '%')
//                     ->orWhere('users.name', 'LIKE', '%' . $request->title . '%')
//                     ->orWhere('projects.id', 'LIKE', '%' . $request->title . '%')
//                     ->orWhere('users.email', 'LIKE', '%' . $request->title . '%')
//                     ->orWhere('users.contact_number', 'LIKE', '%' . $request->title . '%');
//             });
//         }

//         // Process project status filter
//         if ($request->has('project_status') && $request->project_status && $request->project_status != 'all') {
//             $query->where('projects.project_status', $request->project_status);
//         }

//         if ($request->ajax()) {
//             $projects = $query->orderBy('projects.id', 'DESC')->paginate(3);

//             $view = view('layouts.front.projects.contractor.contractordashboard', compact('projects'))->render();
//             return response()->json(['html' => $view]);
//         }
//     } else {
//         $currentMonth = Carbon::now()->month;
//         $projects = Project::whereMonth('projects.created_at', $currentMonth)
//             ->orderBy('projects.id', 'DESC')
//             ->paginate(3);

//             return view('layouts.front.projects.contractor.contractor-project-list', compact('projects'));

//     }

// }


// public function contractorProjectList(Request $request)
// {
//     $query = User::query()->join('projects', 'users.id', '=', 'projects.user_id');

//     if ($request->filled('title') || ($request->filled('from_date') && $request->filled('to_date'))) {
//         // Process date filters
//         if ($request->filled('from_date') && $request->filled('to_date')) {
//             $from_date = Carbon::createFromFormat('m-d-Y', $request->from_date)->format('Y-m-d');
//             $to_date = Carbon::createFromFormat('m-d-Y', $request->to_date)->format('Y-m-d');
//             $query->whereBetween('projects.created_at', [$from_date, $to_date]);
//         }

//         // Process title filter
//         if ($request->filled('title')) {
//             $query->where(function ($subQuery) use ($request) {
//                 $subQuery->where('projects.title', 'LIKE', '%' . $request->title . '%')
//                     ->orWhere('projects.project_status', 'LIKE', '%' . $request->title . '%')
//                     ->orWhere('users.name', 'LIKE', '%' . $request->title . '%')
//                     ->orWhere('projects.id', 'LIKE', '%' . $request->title . '%')
//                     ->orWhere('users.email', 'LIKE', '%' . $request->title . '%')
//                     ->orWhere('users.contact_number', 'LIKE', '%' . $request->title . '%');
//             });
//         }

//         // Process project status filter
//         if ($request->filled('project_status') && $request->project_status !== 'all') {
//             $query->where('projects.project_status', $request->project_status);
//         }

//         if ($request->ajax()) {
//             $projects = $query->orderBy('projects.id', 'DESC')->paginate(3);
//             $view = view('layouts.front.projects.contractor.contractordashboard', compact('projects'))->render();
//             return response()->json(['html' => $view]);
//         }
//     } else {
//         $currentMonth = Carbon::now()->month;
//         $projects = Project::whereMonth('projects.created_at', $currentMonth)
//             ->orderBy('projects.id', 'DESC')
//             ->paginate(3);

//         if ($request->ajax()) {
//             $view = view('layouts.front.projects.contractor.contractordashboard', compact('projects'))->render();
//             return response()->json(['html' => $view]);
//         } else {
//             return view('layouts.front.projects.contractor.contractor-project-list', compact('projects'));
//         }
//     }
// }
    public function designStudioStoreContractor(Request $request, $project_id)
    {
        $project_id = base64_decode($project_id);
        $project = Project::findOrFail($project_id);

        if ($request->hasFile("file")) {
            foreach ($request->file("file") as $file) {
                $user_id = Auth::user() ? Auth::user()->id : auth()->guard('contractor')->user()->id;

                $filePath = $file->store('temp/project_images', 'public');

                ProcessProjectMediaContractor::dispatch($filePath, $project_id, $user_id);
            }

            // $projectImageData = ProjectImagesData::where('project_id', $project_id)
            //     ->orderBy('date', 'desc')
            //     ->get();

            // $project_id = base64_encode($project_id);
            // $groupedData = $projectImageData->groupBy('date');
            

            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
    
            $projectImageData = ProjectImagesData::where('project_id', $project_id)
                ->whereMonth('date', $currentMonth)
                ->whereYear('date', $currentYear)
                ->orderBy('date', 'desc')
                ->get();
    
            $groupedData = $projectImageData->groupBy(function($date) {
                return Carbon::parse($date->date)->format('Y-m-d'); 
            });
    
            $project_id = base64_encode($project_id);
    

            $view = view('layouts.front.projects.contractor.design-studio-contractor', compact('project', 'groupedData'))->render();

            return response()->json([
                "success" => "Files uploaded successfully",
                "project_id" => $project_id,
                'designstudio' => $view
            ]);
        }
    }

//     public function designStudioStoreContractor(Request $request, $project_id)
// {
//     $project_id = base64_decode($project_id);
//     $project = Project::findOrFail($project_id);
//     $imageIds = [];

//     if ($request->hasFile("file")) {
//         foreach ($request->file("file") as $file) {
//             $original_name = $file->getClientOriginalName();
//             $user_id = Auth::user() ? Auth::user()->id : auth()->guard('contractor')->user()->id;
//             $filePath = $file->store('temp/project_images', 'public');
//             $imageData =  ProcessProjectMediaContractor::dispatch($filePath, $project_id, $user_id,$original_name);
        
//             if($imageData) {
//                 $imageIds[] = $imageData->id; // Collect the image ID
//             }
//         }

//         // dd($imageData);

//         // Assuming you're using a view to return the updated design studio view after upload
//         $currentMonth = Carbon::now()->month;
//         $currentYear = Carbon::now()->year;
//         $projectImageData = ProjectImagesData::where('project_id', $project_id)
//             ->whereMonth('date', $currentMonth)
//             ->whereYear('date', $currentYear)
//             ->orderBy('date', 'desc')
//             ->get();

//         $groupedData = $projectImageData->groupBy(function ($date) {
//             return Carbon::parse($date->date)->format('Y-m-d');
//         });

//         $project_id = base64_encode($project_id);
//         $view = view('layouts.front.projects.contractor.design-studio-contractor', compact('project', 'groupedData'))->render();

//         return response()->json([
//             "success" => "Files uploaded successfully",
//             "project_id" => $project_id,
//             'designstudio' => $view,
//             'image_ids' => $imageIds, // Return the image IDs


//         ]);
//     }
// }
// public function designStudioStoreContractor(Request $request, $project_id)
// {
// $project_id = base64_decode($project_id);
// $project = Project::findOrFail($project_id);
// $imageIds = [];

// if ($request->hasFile("file")) {
//     foreach ($request->file("file") as $file) {
//         $original_name = $file->getClientOriginalName();
//         $user_id = Auth::user() ? Auth::user()->id : auth()->guard('contractor')->user()->id;
//         $filePath = $file->store('temp/project_images', 'public');
        
//         // Create the record in ProjectImagesData first
//         $projectImageData = new ProjectImagesData;
//         $projectImageData->project_id = $project_id;
//         $projectImageData->project_image = $original_name; // Store the original name
//         $projectImageData->original_name = $original_name;
//         $projectImageData->date = Carbon::now()->toDateString();
//         $projectImageData->time = Carbon::now('Asia/Kolkata')->format('h:i A');
//         $projectImageData->media_type = explode('/', $file->getMimeType())[0];
//         $projectImageData->created_by = $user_id;
//         $projectImageData->save();
        
//         // Store the image ID for later use
//         $imageIds[] = $projectImageData->id;

//         // Dispatch the job to process the file
//         ProcessProjectMediaContractor::dispatch($filePath, $project_id, $user_id, $original_name);
//     }

//     // Assuming you're using a view to return the updated design studio view after upload
//     $currentMonth = Carbon::now()->month;
//     $currentYear = Carbon::now()->year;
//     $projectImageData = ProjectImagesData::where('project_id', $project_id)
//         ->whereMonth('date', $currentMonth)
//         ->whereYear('date', $currentYear)
//         ->orderBy('date', 'desc')
//         ->get();

//     $groupedData = $projectImageData->groupBy(function ($date) {
//         return Carbon::parse($date->date)->format('Y-m-d');
//     });

//     $project_id = base64_encode($project_id);
//     $view = view('layouts.front.projects.contractor.design-studio-contractor', compact('project', 'groupedData'))->render();

//     return response()->json([
//         "success" => "Files uploaded successfully",
//         "project_id" => $project_id,
//         'designstudio' => $view,
//         'image_ids' => $imageIds, // Return the image IDs
//     ]);
// }
// }



// public function designStudioStoreContractor(Request $request, $project_id)
// {
//     $project_id = base64_decode($project_id);
//     $project = Project::findOrFail($project_id);
//     $imageIds = [];

//     if ($request->hasFile("file")) {
//         foreach ($request->file("file") as $file) {
//             $original_name = $file->getClientOriginalName();
//             $user_id = Auth::user() ? Auth::user()->id : auth()->guard('contractor')->user()->id;

//             // Generate a unique name for the file
//             $new_name = generateUniqueImageName('project_images', $original_name);
//             $filePath = $file->storeAs('temp/project_images', $new_name, 'public');
            
//             // Create the record in ProjectImagesData first
//             $projectImageData = new ProjectImagesData;
//             $projectImageData->project_id = $project_id;
//             $projectImageData->project_image = $new_name; // Store the new name
//             $projectImageData->original_name = $original_name;
//             $projectImageData->date = Carbon::now()->toDateString();
//             $projectImageData->time = Carbon::now('Asia/Kolkata')->format('h:i A');
//             $projectImageData->media_type = explode('/', $file->getMimeType())[0];
//             $projectImageData->created_by = $user_id;
//             $projectImageData->save();
            
//             // Store the image ID for later use
//             $imageIds[] = $projectImageData->id;

//             // Dispatch the job to process the file
//             ProcessProjectMediaContractor::dispatch($filePath, $project_id, $user_id);
//         }

//         // Assuming you're using a view to return the updated design studio view after upload
//         $currentMonth = Carbon::now()->month;
//         $currentYear = Carbon::now()->year;
//         $projectImageData = ProjectImagesData::where('project_id', $project_id)
//             ->whereMonth('date', $currentMonth)
//             ->whereYear('date', $currentYear)
//             ->orderBy('date', 'desc')
//             ->get();

//         $groupedData = $projectImageData->groupBy(function ($date) {
//             return Carbon::parse($date->date)->format('Y-m-d');
//         });

//         $project_id = base64_encode($project_id);
//         $view = view('layouts.front.projects.contractor.design-studio-contractor', compact('project', 'groupedData'))->render();

//         return response()->json([
//             "success" => "Files uploaded successfully",
//             "project_id" => $project_id,
//             'designstudio' => $view,
//             'image_ids' => $imageIds, // Return the image IDs
//         ]);
//     }
// }

    public function getImageData(Request $request, $project_id){
        $project_id = base64_decode($project_id);
        $project = Project::findOrFail($project_id);
        // $projectImageData = ProjectImagesData::where('project_id', $project_id)
        //     ->orderBy('date', 'desc')
        //     ->get();

        // $groupedData = $projectImageData->groupBy(function ($date) {
        //     return Carbon::parse($date->date)->format('Y-m-d');
        // });
// 
        // dd($project);
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $projectImageData = ProjectImagesData::where('project_id', $project_id)
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->orderBy('date', 'desc')
            ->get();

        $groupedData = $projectImageData->groupBy(function ($date) {
            return Carbon::parse($date->date)->format('Y-m-d');
        });

        $project_id = base64_encode($project_id);
        $view = view('layouts.front.projects.contractor.design-studio-contractor', compact('project', 'groupedData'))->render();

        return response()->json([
            "success" => "Files uploaded successfully",
            'status'=>true,
            "project_id" => $project_id,
            'designstudio' => $view
        ]);
    }


    public function removeImageContractor(Request $request) //old query
    {
        // dd($request->all());
        $fileName = $request->input("file_name");
        $projectId = $request->input("project_id");
        // Storage::disk("public")->delete("project_images/" . $fileName);
        $project = Project::findOrFail($projectId);
        $imageArray = json_decode($project->project_image, true);
        if (is_array($imageArray) && in_array($fileName, $imageArray)) {
            $updatedImages = array_values(array_diff($imageArray, [$fileName]));
            $project->update(["project_image" => json_encode($updatedImages)]);
        }
        return response()->json(["message" => "Image removed successfully"]);
    }


public function removeImage(Request $request)
{
    // dd($request->all())
    $image_id = $request->input('file_name'); 
    // dd($image_id)
;    $imageRecord = ProjectImagesData::where('id', $image_id)->first();
    
    if (!$imageRecord) {
        return response()->json([
            'success' => false,
            'message' => 'Image not found.',
        ], 404);
    }

    $filePath = 'project_images/' . $imageRecord->project_image;

    if (Storage::disk('public')->exists($filePath)) {
        Storage::disk('public')->delete($filePath); 
    }

    // Delete the record from the database
    $imageRecord->delete();

    return response()->json([
        'success' => true,
        'message' => 'Image removed successfully.',
    ]);
}


    public function deleteImagesContractor($project_id, $media_item_id)
    {
        $mediaItem = ProjectImagesData::find($media_item_id);
        if (!$mediaItem) {
            return response()->json(['message' => 'Media item not found.'], 404);
        }
        Storage::delete('project_images/' . $mediaItem->project_image);
        $mediaItem->delete();

        $count = ProjectImagesData::where('project_id',$project_id)
        ->where('created_by',Auth::user()->id)
        ->get()->count();
        $customer_count = ProjectImagesData::where('project_id',$project_id)
        ->where('created_by','!=',Auth::user()->id)
        ->get()->count();

        return response()->json(['message' => 'File deleted successfully.','count' => $count,'customer_count' => $customer_count]);
    }



    // public function projectDetailsContractor(Request $request, $project_id)
    // {
    //     $projectData = base64_decode($project_id);
    //     $projectinfo = Project::where('id', $projectData)->with('user')->first();

        

    //     $documentsData = ProjectDocument::where("project_id", $projectinfo->id)->get();
    //     $documents = [];
    //     $insurancedocuments = [];
    //     $mortgagedocuments = [];
    //     $contractordocuments = [];

    //     foreach ($documentsData as $val) {
    //         switch ($val->document_name) {
    //             case "documents":
    //                 $documents[] = pathinfo($val->document_file);
    //                 break;
    //             case "insurancedocuments":
    //                 $insurancedocuments[] = pathinfo($val->document_file);
    //                 break;
    //             case "mortgagedocuments":
    //                 $mortgagedocuments[] = pathinfo($val->document_file);
    //                 break;
    //             case "contractordocuments":
    //                 $contractordocuments[] = pathinfo($val->document_file);
    //                 break;
    //             default:
    //                 break;
    //         }
    //     }

    //     $contractor = auth()->guard('contractor')->user();

    //     $quotations = Quotation::where('project_id', base64_decode($project_id))
    //     ->where('contractor_id', $contractor->id)
    //     ->where('status', '!=', NULL)
    //     ->get();

    //     return view('layouts.front.projects.contractor.details', compact('projectinfo', 'quotations', 'documents', 'insurancedocuments', 'mortgagedocuments', 'contractordocuments'));
    // }

    public function projectDetailsContractor(Request $request, $project_id)
    {
        $projectData            = base64_decode($project_id);
        $projectinfo            = Project::where('id', $projectData)->with('user')->first();
        $project_documents      = ProjectDocument::where('project_id', $projectinfo->id)->get();

        $documentdata           = [];
        $contractordocuments    = [];
        $insurancedocuments     = [];
        $mortgagedocuments      = [];

        foreach ($project_documents as $document) {
            if ($document->document_name == "documents") {
                $documentDate = Carbon::parse($document->created_at)->format('F d, Y');
                $documentdata[] = array_merge(
                    pathinfo($document->document_file),
                    [
                        'filename' => $document->document_file ?? '',
                        'filedate' => $documentDate ?? '',
                    ]
                );
            }
            if ($document->document_name == "contractordocuments") {
                $contractorDate = Carbon::parse($document->created_at)->format('F d, Y');
                $contractordocuments[] = array_merge(
                    pathinfo($document->document_file),
                    [
                        'filename' => $document->document_file ?? '',
                        'filedate' => $contractorDate ?? '',
                    ]
                );
            }
            if ($document->document_name == "insurancedocuments") {
                $insurancedDate = Carbon::parse($document->created_at)->format('F d, Y');
                $insurancedocuments[] = array_merge(
                    pathinfo($document->document_file),
                    [
                        'filename' => $document->document_file ?? '',
                        'filedate' => $insurancedDate ?? '',
                    ]
                );
            }
            if ($document->document_name == "mortgagedocuments") {
                
                $mortgageDate = Carbon::parse($document->created_at)->format('F d, Y');
                $mortgagedocuments[] = array_merge(
                    pathinfo($document->document_file),
                    [
                        'filename' => $document->document_file ?? '',
                        'filedate' => $mortgageDate ?? '',
                    ]
                );
            }
        }

        $documentdata = array_filter($documentdata);
        $mortgagedocuments = array_filter($mortgagedocuments);
        $contractordocuments = array_filter($contractordocuments);
        $insurancedocuments = array_filter($insurancedocuments);
        $contractor = auth()->guard('contractor')->user();

        $quotations = Quotation::where('project_id', base64_decode($project_id))
            ->where('contractor_id', $contractor->id)
            ->where('status', '!=', NULL)
            ->get();

        return view('layouts.front.projects.contractor.details', compact('projectinfo', 'quotations', 'documentdata', 'contractordocuments', 'insurancedocuments', 'mortgagedocuments'));
    }

    public function documentationStore(Request $request)
    {
        try {
            $projectId = $request->input('project_id');
            if (!$projectId) {
                return redirect()->back()->withInput()->withErrors(["error" => "Project ID not found."]);
            }

            $documentTypes = ["documents", "insurancedocuments", "mortgagedocuments", "contractordocuments"];
            foreach ($documentTypes as $documentType) {
                if ($request->hasFile($documentType)) {
                    $files = $request->file($documentType);
                    foreach ($files as $file) {
                        $filePath = $file->store('uploads');
                        dispatch(new DocumentUpload($projectId, $documentType, $file->getClientOriginalName(), $filePath));
                    }
                }
            }
            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->withInput()->withErrors(["error" => "An error occurred while processing the request."]);
        }
    }

    public function removeDocuments(Request $request)
    {
        $file       = $request->input('file');
        $removefile = 'project_documents_laststage/' . $file;
        $projectId  = $request->input('project_id');
        $filePath   = public_path('project_documents_laststage/' . $file);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $data = ProjectDocument::where('project_id', $projectId)
        ->where('document_file', $removefile)
        ->delete();
        return response()->json(['message' => 'Document removed successfully']);
    }


    ///Filter for design studio contractor side 

    // public function DesignstuidoContractorFilter(Request $request, $project_id)
    // {
    //     $projectData = base64_decode($project_id);
    //     $project = Project::where('id', $projectData)->first();



    //     if ($request->designfilter_todate != null && $request->designfilter_fromdate != null) {

    //         // dd($request->designfilter_todate)
    //         $designfilter_todate = Carbon::createFromFormat('m-d-Y', $request->designfilter_todate)->format('Y-m-d');
    //         $designfilter_fromdate = Carbon::createFromFormat('m-d-Y', $request->designfilter_fromdate)->format('Y-m-d');


    //         $filterData = ProjectImagesData::where('project_id', base64_decode($project_id));

    //         if ($designfilter_todate) {
    //             $filterData->whereDate('date', '>=', $designfilter_todate);
    //         }

    //         if ($designfilter_fromdate) {
    //             $filterData->whereDate('date', '<=', $designfilter_fromdate);
    //         }

    //         $groupedData = $filterData->orderBy('date', 'desc')
    //             ->get()->groupBy('date');
    //         $dsview = view('layouts.front.projects.contractor.design-studio-contractor', compact('groupedData', 'project'))->render();

    //         return response()->json(['filterdata' => $dsview]);


    //     }

    // }

    public function DesignstuidoContractorFilter(Request $request, $project_id){
    $projectData = base64_decode($request->project_id);
    $project = Project::where('id', $projectData)->first();

    if ($request->designfilter_todate != null && $request->designfilter_fromdate != null) {
        $designfilter_todate = Carbon::createFromFormat('m-d-Y', $request->designfilter_todate)->format('Y-m-d');
        $designfilter_fromdate = Carbon::createFromFormat('m-d-Y', $request->designfilter_fromdate)->format('Y-m-d');

        $filterData = ProjectImagesData::where('project_id', $projectData);

        if ($designfilter_todate) {
            $filterData->whereDate('date', '>=', $designfilter_fromdate);
        }

        if ($designfilter_fromdate) {
            $filterData->whereDate('date', '<=', $designfilter_todate);
        }

        $groupedData = $filterData->orderBy('date', 'desc')
            ->get()->groupBy('date');
        $dsview = view('layouts.front.projects.contractor.design-studio-contractor', compact('groupedData', 'project'))->render();

        return response()->json(['filterdata' => $dsview]);
    }else{
        $projectData = base64_decode($request->project_id);

        $project = Project::where('id', $projectData)->first();

        $groupedData = ProjectImagesData::where('project_id', $projectData)
        ->orderBy('date', 'desc')
        ->get()->groupBy('date');
        $dsview = view('layouts.front.projects.contractor.design-studio-contractor', compact('groupedData', 'project'))->render();

    return response()->json(['filterdata' => $dsview]);
    }

    }



    


    //downlaod documents
    public function download($filename)
    {
        $filePath = storage_path('app/public/' . $filename);
        if (file_exists($filePath)) {
            $headers = [
                'Content-Type' => 'image/*',
            ];
            return response()->download($filePath, $filename, $headers);
        } else {
            abort(404, 'File not found');
        }
    }

    //update contractor profile
    public function profileView()
    {
        return view('layouts.front.contractor-profile');
    }

    
    public function deleteProfileImage(Request $request)
    {
        try{
            $contractor = Contractor::find($request->contarctorId);
            if ($contractor) {
                if($request->remove_image == 'profile'){
                    $contractor->profile_image = null;
                }
                if($request->remove_image == 'banner'){
                    $contractor->banner_image = null;
                }
                if($request->remove_image == 'logo'){
                    $contractor->company_logo = null;
                }
                $contractor->save();
                return response()->json([
                    "success" => true,
                    "message" => "delete images successfully",
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Something went wrong",
                "error" => $e->getMessage(),
            ]);
        }
    }
    public function profileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contarctorId' => 'required|exists:contractors,id',
            'name' => 'required|string|max:255',
            // 'contactnumber' => 'required|string|max:20',
            // 'zipcode' => 'required|string|max:10',
            'customer_profile' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $contractor = Contractor::find($request->contarctorId);

        if ($contractor) {
            $contractor->name = $request->name;
            // $contractor->email = $request->email;
            $contractor->country_code = $request->country_code ? $request->country_code : 'us';
            $contractor->contact_number = $request->contact_number;
            $contractor->zip_code = $request->zipcode;
            $contractor->address = $request->address;
            $contractor->company_name = $request->company_name;


            $bannerImageName = null;

            $oldImagePathBanner = $contractor->banner_image;


            $oldCompanyLogo = $contractor->company_logo;

            if ($request->hasFile('banner_image')) {
                $image = $request->file('banner_image');
                $imageName = \Str::random(3) . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('contractor_banner'), $imageName);
                $contractor->banner_image = 'contractor_banner/' . $imageName;
                if ($oldImagePathBanner && file_exists(public_path($oldImagePathBanner))) {
                }
            }

            $oldImagePath = $contractor->profile_image;
            if ($request->hasFile('customer_profile')) {
                $image = $request->file('customer_profile');
                $imageName = \Str::random(3) . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('customer_image'), $imageName);
                $contractor->profile_image = 'customer_image/' . $imageName;
                if ($oldImagePath && file_exists(public_path($oldImagePath))) {
                    unlink(public_path($oldImagePath));
                }

            }

            // $oldCompanyLogo = $contractor->company_logo;
            if ($request->hasFile('company_logo')) {
                $image = $request->file('company_logo');
                $imageName = \Str::random(3) . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('company_logo'), $imageName);
                $contractor->company_logo = 'company_logo/' . $imageName;
                if ($oldCompanyLogo && file_exists(public_path($oldCompanyLogo))) {
                    unlink(public_path($oldCompanyLogo));
                }
            }



            if ($request->has('password')) {
                $contractor->password = bcrypt($request->password);
            }


            $contractor->save();

            return redirect()->back()->with('success', 'Profile updated successfully.');
        } else {
            return response()->json(['error' => 'Contractor not found'], 404);
        }
    }


    public function saveNotes(Request $request){
        $validated = $request->validate([
            'notes' => 'required|string',
        ]);
    
        // dd($request->all());
        $data = ProjectImagesData::find($request->mediaImageId);
        $data->notes = $request->notes;
        $data->update();

    
        return response()->json(['message' => 'Notes saved successfully!']);
    }
    public function detailPage(Request $request)
    {
        $mediaItem = ProjectImagesData::find($request->id);
        if($mediaItem->credit_image == 1){
            $username = User::where('id',$mediaItem->created_by)->pluck('name');
        }else{
            $username = Contractor::where('id',$mediaItem->created_by)->pluck('name');
        }
        if (!$mediaItem) {
            return response()->json(['error' => 'Media item not found'], 404);
        }
        $formattedDate = Carbon::parse($mediaItem->date)->format('F-d-Y');
        return response()->json([
            'date' => $formattedDate,
            'time' => $mediaItem->time,
            'media_type' => $mediaItem->media_type,
            'media_url' => asset('storage/project_images/'.$mediaItem->project_image),
            'notes' => $mediaItem->notes,
            'project_name' => $mediaItem->project_image,
            'user_name' => $username??'',
        ]);
        
    }
}
