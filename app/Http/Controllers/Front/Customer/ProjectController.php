<?php

namespace App\Http\Controllers\Front\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator; // validator
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Repositories\ProjectRepository; // Repository
use App\Models\Project;
use App\Models\Quotation;
use App\Models\Contractor;
use App\Models\ProjectImagesData;
use App\Models\ProjectDocument;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Jobs\DocumentUpload;
use App\Jobs\ProcessProjectMedia;
use App\Models\ContractorPortfolio;
use Illuminate\Validation\Rule;
use App\Mail\UserAccountCreated;
use Mail;


//interface 
use App\ProjectInterface;



class ProjectController extends Controller
{


    private $projectRepository;
    protected $projectService;


    public function __construct(ProjectRepository $projectRepository, ProjectInterface $projectService)
    {
        $this->projectRepository = $projectRepository;
        $this->projectService = $projectService;

    }
    //******************************************/
    // Display project list from customer side //
    //******************************************/
    public function list()
    {
        $projects = $this->projectService->getAllProjects();
        return view("layouts.front.projects.project-list", compact("projects"));
    }


    public function create(Request $request, $project_id)
    {

        $contarctorList = Contractor::get();
        $projectData = Project::where('id', $project_id)->first();
        $quoteData = Quotation::where('project_id', base64_decode($project_id))->pluck('contractor_id')->toArray();
        $quotations = Quotation::where('project_id', base64_decode($project_id))->where('status', '!=', 'Requested')
            ->where('status', '!=', 'Rejected')
            ->get();
        return view("layouts.front.projects.project-details", compact("project_id", "contarctorList", "projectData", "quoteData", "quotations"));
    }

    public function test()
    {
    }

    //***************************************/
    // cretea a  project from customer side //
    //***************************************/
    public function addProject(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "projectname" => [
                    "required",
                    "string",
                    "max:255",
                    function ($attribute, $value, $fail) {
                        $isUnique = $this->projectRepository->isProjectNameUnique($value, auth()->id());

                        if (!$isUnique) {
                            $fail("The $attribute has already been taken for this user.");
                        }
                    },
                ],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "success" => false,
                    "message" => "Validation failed",
                    "errors" => $validator->errors(),
                ]);
            }

            $projectData = [
                'name' => $request->projectname,
                'title' => $request->projectname,
                'user_id' => auth()->id(),
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
                'status' => 0,
            ];

            $project = $this->projectRepository->createProject($projectData);

            return response()->json([
                "success" => true,
                "message" => "Project created successfully",
                "data" => $project->id,

            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Something went wrong",
                "error" => $e->getMessage(),
            ]);
        }
    }



    //************************************************************************/
    // Design studio Design- customer side //
    //************************************************************************/
    public function designStudio($project_id, Request $request)
    {
        $data = $this->projectRepository->designStudio($project_id, $request);
        return $data;
    }



    //************************************************************************/
// Remove  image and videos inside the project  customer side //
//************************************************************************/    
    public function removeImage(Request $request)
    {
        $fileName = $request->input("file_name");
        $projectId = $request->input("project_id");

        Storage::disk("public")->delete("project_images/" . $fileName);

        $project = Project::findOrFail(base64_decode($projectId));
        $imageArray = json_decode($project->project_image, true);

        if (is_array($imageArray) && in_array($fileName, $imageArray)) {
            $updatedImages = array_values(array_diff($imageArray, [$fileName]));
            $project->update(["project_image" => json_encode($updatedImages)]);
        }

        return response()->json(["message" => "Image removed successfully"]);
    }


    public function designStudioStore(Request $request, $project_id)
    {
        $project_id = base64_decode($project_id);
        $project = Project::findOrFail($project_id);

        if ($request->hasFile("file")) {
            $user = Auth::user() ?? auth()->guard('contractor')->user();
            $files = $request->file("file");

            //dd($files);
            foreach ($files as $file) {
                $filePath = $file->store('project_images', 'public');

                ProcessProjectMedia::dispatch($filePath, $file->getClientOriginalName(), $project_id, $user);
            }
        }


        // $projectImageData = ProjectImagesData::where('project_id', $project_id)
        //     ->orderBy('date', 'desc')
        //     ->get();

        // $sumOfCreditImages = ProjectImagesData::where('credit_image', 1)
        //     ->where('project_id', $project_id)
        //     ->sum('credit_image');

        // $project->credit = $sumOfCreditImages;
        // $project->update();

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

        $sumOfCreditImages = ProjectImagesData::where('credit_image', 1)
            ->where('project_id', $project_id)
            ->sum('credit_image');

        $project->credit = $sumOfCreditImages;
        $project->update();

        $project_id = base64_encode($project_id);


        $view = view('layouts.front.projects.steps.work-gallery', compact('project', 'groupedData'))->render();


        return response()->json([
            "success" => "Files uploaded successfully",
            "project_id" => $project_id,
            //"projectImage" => $projectImageData,
            'designstudio' => $view
        ]);
    }


    public function generalInformation($project_id)
    {
        $project_id = base64_decode($project_id);
        return view("layouts.front.projects.steps.general-information", compact("project_id"));
    }




    public function generalInformationPost(Request $request, $project_id = null)
    {
        try {
            $decoded_project_id = $project_id ? base64_decode($project_id) : null;

            $validator = Validator::make($request->all(), [
                "title" => "required|string|max:255",
                "address" => "required|string|max:255",
            ]);

            $project = Project::where('title', $request->title)
                ->where('user_id', Auth::id())
                ->where('id', '<>', $decoded_project_id) // Exclude the current project if updating
                ->first();

            if ($project) {
                return redirect()->back()->withInput()->withErrors(['errors' => 'The title has already been taken.']);
            }


            // Find the project if project_id is provided, otherwise create a new one
            // $project = $decoded_project_id ? Project::find($decoded_project_id) : new Project();
            if ($decoded_project_id) {
                $project = Project::find($decoded_project_id);
                // Check if project is null (project ID doesn't exist in the database)
                if (!$project) {
                    return redirect()->back()->withInput()->withErrors(['error' => 'Project not found.']);
                }
            } else {
                $project = new Project();
            }

            // Set project properties
            $project->title             = $request->title;
            $project->address           = $request->address;
            $project->customer_name     = $request->customer_name ?? '';
            $project->insurance_company = $request->insurancecompany ?? "";
            $project->phone             = $request->contact_number ?? "";
            $project->country_code      = $request->country_code ?? "us";
            $project->insurance_agency  = $request->insuranceagency ?? "";
            $project->billing           = $request->billing ?? "";
            $project->mortgage_company  = $request->mortgagecompany ?? "";
            $project->project_status    = "Request";
            $project->user_id           = Auth::id();
            $project->created_by        = Auth::id();
            $project->updated_by        = Auth::id();
            $project->save();

            // Update user information
            $userId = Auth::user()->id;
            // if ($userId) {
            //     $user = User::find($userId);
            //     $user->contact_number = $request->contact_number ?? '';
            //     $user->name = $request->customer_name ?? '';
            //     $user->save();
            // }

            // Encode project ID for redirect   
            $encoded_project_id = base64_encode($project->id);
            return redirect()->route("design.studio", [
                "project_id" => $encoded_project_id,
            ]);
        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return redirect()->back()->withInput()->withErrors(["error" => "An error occurred while saving the data."]);
        }
    }




    public function documentation($project_id)
    {
        try {
            $project_id = base64_decode($project_id);

            $documentsData = ProjectDocument::where("project_id", $project_id)->get();
            $documents = [];
            $insurancedocuments = [];
            $mortgagedocuments = [];
            $contractordocuments = [];

            foreach ($documentsData as $val) {
                switch ($val->document_name) {
                    case "documents":
                        $documents[] = pathinfo($val->document_file);
                        break;
                    case "insurancedocuments":
                        $insurancedocuments[] = pathinfo($val->document_file);
                        break;
                    case "mortgagedocuments":
                        $mortgagedocuments[] = pathinfo($val->document_file);
                        break;
                    case "contractordocuments":
                        $contractordocuments[] = pathinfo($val->document_file);
                        break;
                    default:
                        break;
                }
            }

            $data = compact(
                "project_id",
                "documents",
                "insurancedocuments",
                "mortgagedocuments",
                "contractordocuments"
            );

            $data = array_filter($data);

            return view("layouts.front.projects.steps.documentation", $data);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->withErrors(["error" => "An error occurred while processing the request."]);
        }
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
            // return redirect()->route("project.list");
            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->withInput()->withErrors(["error" => "An error occurred while processing the request."]);
        }
    }



    public function removeDocuments(Request $request)
    {
        $file = $request->input('file');
        $removefile = 'project_documents_laststage/' . $file;
        $projectId = $request->input('project_id');
        $filePath = public_path('project_documents_laststage/' . $file);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $data = ProjectDocument::where('project_id', $projectId)
            ->where('document_file', $removefile)
            ->delete();


        return response()->json(['message' => 'Document removed successfully']);
    }


    public function index($project_id, Request $request)
    {
        $decodedProjectId = base64_decode($project_id);

        $contractorList = Contractor::whereNotNull('email_verified_at');

        if ($request->has('contractor_search')) {
            $searchTerm = $request->contractor_search;
            $contractorList = $contractorList->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%')
                    ->orWhere('contact_number', 'like', '%' . $searchTerm . '%');
            });
        }

        $contractorList = $contractorList->paginate(3);

        $projectData = Project::find($project_id);
        $quoteData = Quotation::where('project_id', $decodedProjectId)->pluck('contractor_id')->toArray();
        $quotations = Quotation::where('project_id', $decodedProjectId)
            ->whereNotNull('status')
            ->get();

        if ($request->ajax() && !$request->has('c_id')) {
            $view = view('layouts.front.contractor-lists', compact('contractorList', 'project_id', 'quoteData', 'quotations'))->render();
            return response()->json(['html' => $view]);

        }

        $c_id = $request->c_id ?? '';
        if ($request->ajax() && !empty($c_id)) {
            $portfolio = ContractorPortfolio::where('contractor_id', $c_id)->get();
            return view('layouts.front.projects.gallery-portfolio', compact('portfolio'))->render();
        }

        return view('layouts.front.contractor', compact('project_id', 'contractorList', 'projectData', 'quoteData', 'quotations'));
    }



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

    public function customerprofileView()
    {

        return view('layouts.front.customer-profile');

    }


    public function customerprofileUpdate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'address' => 'required|max:255',
            // 'customer_profile' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($request->user_id);

        if ($user) {
            $user->name = $request->name;
            // $user->email = $request->email;
            $user->contact_number = $request->contact_number;
            $user->country_code = $request->country_code ? $request->country_code : 'us';
            $user->zip_code = $request->zipcode;
            $user->address = $request->address;


            $oldImagePath = $user->profile_image;


            if ($request->hasFile('customer_profile')) {
                $image = $request->file('customer_profile');
                $imageName = \Str::random(3) . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('customer_image'), $imageName);
                $user->profile_image = 'customer_image/' . $imageName;
                if ($oldImagePath && file_exists(public_path($oldImagePath))) {
                    unlink(public_path($oldImagePath));
                }

                $user->save();
            }

            if ($request->has('password')) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            return redirect()->back()->with('success', 'Profile updated successfully.');
        } else {
            return response()->json(['error' => 'The Customer not found'], 404);
        }
    }

    public function deleteImages($project_id, $media_item_id)
    {
        $mediaItem = ProjectImagesData::find($media_item_id);
        if (!$mediaItem) {
            return response()->json(['message' => 'Media item not found.'], 404);
        }
        Storage::delete('project_images/' . $mediaItem->project_image);

        $mediaItem->delete();

        $project = Project::where('id', base64_decode($project_id))->first();
        $sumOfCreditImages = ProjectImagesData::where('credit_image', 1)
            ->where('project_id', base64_decode($project_id))
            ->sum('credit_image');


        $project->credit = $sumOfCreditImages;
        $project->update();



        $count = ProjectImagesData::where('project_id', base64_decode($project_id))
            ->get()->count();

        

        $customer_count = ProjectImagesData::where('project_id',$project_id)
         ->where('created_by','!=',Auth::user()->id)
           ->get()->count();
    

           $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;

        $projectImageData = ProjectImagesData::where('project_id', base64_decode($project_id))
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->orderBy('date', 'desc')
            ->get();

        $groupedData_count = $projectImageData->groupBy('date')->count();

            // dd($groupedData_count);

        return response()->json(['message' => 'File deleted successfully.', 'count' => $count,'customer_count'=>$customer_count,'groupedData_count'=>$groupedData_count]);
    }

    public function deleteProfileImage(Request $request){
        $imageName = $request->input('image_name');
        $user = User::find(Auth::user()->id);
        if (!$imageName) {
            return response()->json(['message' => 'Media item not found.'], 404);
        }

        $filePath = public_path('customer_image/' . $imageName);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        
        $user->profile_image = NULL;
        $user->save();

        return response()->json(['message' => 'Image deleted successfully']);
        }

        public function addProjectContractor(Request $request) {
        // dd($request->all());
            $user = User::where('email', $request->email)->first();
        
            if (!$user) {
                $password = 'Glory@123'; 
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => \Hash::make(123123),
                    'email_verified_at' => Carbon::now(),
                    'role' => 'user',
                    'country_code' => $request->country_code,
                    'contact_number' => $request->contact_number
                ]);

                        // Send the email notification
            Mail::to($user->email)->send(new UserAccountCreated($user, $password));




            }
        
            $user_id = $user->id;
            // dd($user_id);   
        
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'projectname' => [
                    'required',
                    'string',
                    'max:255',
                    function ($attribute, $value, $fail) use ($user_id) { 
                        $isUnique = $this->projectRepository->isProjectNameUnique($value, $user_id);
                        if (!$isUnique) {
                            $fail("The $attribute has already been taken for your account.");
                        }
                    },
                ],
            ]);
        
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ]);
            }
        
            try {
                $projectData = [
                    'name' => $request->projectname,
                    'title' => $request->projectname,
                    'contact_number'=>$request->contact_number,
                    'country_code' => $request->country_code,
                    'user_id' => $user_id,
                    'created_by' => auth()->guard('contractor')->user()->id,
                    'added_by_contractor' => '1',
                    'contractor_id' => auth()->guard('contractor')->user()->id,
                    'updated_by' => auth()->guard('contractor')->user()->id,
                    'status' => 0,
                ];
        
                $project = $this->projectRepository->createProjectContractor($projectData);
        
                return response()->json([
                    'success' => true,
                    'message' => 'Project created successfully',
                    'data' => $project->id,
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong',
                    'error' => $e->getMessage(),
                ]);
            }
        }


        public function updateProjectInfo(Request $request, $id)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'customer_name'=>'required|string|max:255',
        'contact_number' => 'nullable|string|max:15',
        'address' => 'nullable|string',
        'insurance_company' => 'nullable|string',
        'insurance_agency' => 'nullable|string',
        'billing' => 'nullable|string',
        'mortgage_company' => 'nullable|string',

    ]);



    $project = Project::findOrFail($id);

    $project->update([
        'title' => $validated['title'],
        'customer_name'=>$validated['customer_name'],
        'country_code'=>$request->country_code ? $request->country_code : 'us',
        'phone' => $validated['contact_number'],
        'address' => $validated['address'],
        'insurance_company' => $validated['insurance_company']??'',
        'insurance_agency' => $validated['insurance_agency']??'',
        'billing' => $validated['billing']??'',
        'mortgage_company' => $validated['mortgage_company']??'',
    ]);

    return response()->json([
        'success' => true,
        'projectinfo' => $project


    ]);
}
}
