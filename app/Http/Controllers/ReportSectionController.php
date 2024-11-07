<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportSection;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use PDF;
use App\Models\Contractor;
use App\Models\User;
use Mail;
use App\Mail\ReportMail;

class ReportSectionController extends Controller
{

    // Store title section data
public function store(Request $request)
{
    // dd($request->all());
    $allData = [
        'title' => $request->title,
        'date' => $request->date,
        'company_name' => $request->company_name,
        'address' => $request->address,
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
    ];


    $reportSection = ReportSection::where('report_id', $request->report_id)
        ->where('id', $request->section_type_id)
        ->first();

        
    $existingContent = json_decode($reportSection->content, true);

    if ($request->hasFile('company_logo')) {
        if (isset($existingContent['company_logo'])) {
            $oldLogoPath = public_path($existingContent['company_logo']);
            if (file_exists($oldLogoPath)) {
                unlink($oldLogoPath);
            }
        }
        
        $logoPath = 'logos/' . time() . '_' . $request->file('company_logo')->getClientOriginalName();
        $request->file('company_logo')->move(public_path('logos'), $logoPath);
        $allData['company_logo'] = $logoPath; 
    } else {
        $allData['company_logo'] = $existingContent['company_logo'] ?? null;
    }

    if ($request->hasFile('banner_image')) {
        if (isset($existingContent['banner_image'])) {
            $oldBannerPath = public_path($existingContent['banner_image']);
            if (file_exists($oldBannerPath)) {
                unlink($oldBannerPath);
            }
        }
        
        $bannerPath = 'banners/' . time() . '_' . $request->file('banner_image')->getClientOriginalName();
        $request->file('banner_image')->move(public_path('banners'), $bannerPath);
        $allData['banner_image'] = $bannerPath; 
    } else {
        $allData['banner_image'] = $existingContent['banner_image'] ?? null;
    }

    $reportSection->content = json_encode($allData);

    $reportSection->save();

    

    return response()->json(['success' => true, 'data' => $reportSection]);
}

//store introduction section information
public function storeIntroduction(Request $request)
{
    $allData = [
       'introduction_title' =>$request->input('introduction_title'),
       'content' => $request->input('content'),
    ];
     $reportSection = ReportSection::where('report_id', $request['report_id'])
        ->where('id', $request['section_type_id'])
        ->first();

    $reportSection->content  = json_encode($allData);
    $reportSection->save();

return response()->json(['success' => true, 'data' => $reportSection]);
}

// store data into the database quotation modules 
public function storeQuotationInfo(Request $request)
{
    $data = ReportSection::where('id', $request->sectionTypeId)
        ->where('report_id', $request->report_id)
        ->first();

    $combinedContent = [];

    if (!empty($request['content'])) {
        $content = json_decode($request['content'], true);
        if (isset($content['quote_details_title'])) {
            $combinedContent['quote_details_title'] = $content['quote_details_title'];
            $combinedContent['message'] = $content['message'];
        }
        if (!empty($content['items'])) {
            $combinedContent['items'] = $content['items'];
        }
    }

    if (!empty($request['contentone'])) {
        $contentone = json_decode($request['contentone'], true);
        if (isset($contentone['new_quote_title1'])) {
            $combinedContent['new_quote_title1'] = $contentone['new_quote_title1'];
        }
        if (!empty($contentone['itemsone'])) {
            $combinedContent['itemsone'] = $contentone['itemsone'];
        }
    }

    if (!empty($request['contenttwo'])) {
        $contenttwo = json_decode($request['contenttwo'], true);
        if (isset($contenttwo['new_quote_title2'])) {
            $combinedContent['new_quote_title2'] = $contenttwo['new_quote_title2'];
        }
        if (!empty($contenttwo['itemstwo'])) {
            $combinedContent['itemstwo'] = $contenttwo['itemstwo'];
        }
    }

    if (!empty($combinedContent)) {
        $data->content = json_encode($combinedContent);
        $data->save();
        return response()->json(['success' => true, 'data' => $data]);
    }

    return response()->json(['success' => false, 'message' => 'No content to store'], 400);
}


// Inspectoin section insert data into database
public function storeInspectionInfo(Request $request)
{
    // Validate the request data
    // $request->validate([
    //     'inspection_title' => 'required|string|max:255',
    //     // Add other validations as needed
    // ]);

    $reportSection = ReportSection::where('id', $request->section_type_inspection_id)
                                  ->where('report_id', $request->report_id)
                                  ->first();

    $content = json_decode($reportSection->content, true);

    $newContent = $this->prepareContent($request);
    
    $content['inspection_title'] = $request->inspection_title;

    foreach ($newContent['content'] as $key => $value) {
        $cleanedKey = str_replace('editor_editor_', '', $key);
        
        $content['content'][$cleanedKey] = $value;
    }

    foreach ($newContent['images'] as $key => $imagePath) {
        if (isset($content['images'][$key])) {
            $oldImagePath = public_path($content['images'][$key]);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $content['images'][$key] = $imagePath; 
    }

    $reportSection->content = json_encode($content);
    $reportSection->save();

    $updatedContent = view('your-view', [
        'reportSection' => $reportSection,
    ])->render();

    return response()->json(['success' => true, 'updatedContent' => $updatedContent]);
}


private function prepareContent(Request $request)
{
    $content = [
        'title' => $request->input('inspection_title'),
        'content' => [],
        'images' => []
    ];

    foreach ($request->all() as $key => $value) {
        if (str_starts_with($key, 'ckeditor_content_')) {
            $editorId = str_replace('ckeditor_content_', '', $key);
            $content['content'][$editorId] = $value; // Preserve editor_ prefix for internal handling
        }
    }

    foreach ($request->files as $key => $file) {
        if (str_starts_with($key, 'inspection_image')) {
            $imageName = \Str::random(3) . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('inspection_image'), $imageName);
            $content['images'][str_replace('inspection_image_', '', $key)] = 'inspection_image/' . $imageName;
        }
    }

    return $content;
}

// remove inspection section
public function deleteInspectionItem(Request $request)
{
    $sectionId = $request->input('section_id');
    $reportSection = ReportSection::find($sectionId);
    $content = json_decode($reportSection->content, true);

    $content_image = json_decode($reportSection->content_image, true);

    $key = $request->input('key');
    if (isset($content['content'][$key])) {
        unset($content['content'][$key]);
    }
    if (isset($content_image['images']['editor_'.$key])) {
        unset($content_image['images']['editor_'.$key]);
    }
    $reportSection->content = json_encode($content);
    $reportSection->content_image = json_encode($content_image);
    $reportSection->save();

    return response()->json(['success' => true]);
}
// end remove inspection section




// Inspection section delete specific  image 

public function deleteImage(Request $request)
{
    $sectionId = $request->input('section_id');
    $reportSection = ReportSection::find($sectionId);

    if (!$reportSection) {
        return response()->json(['message' => 'Report section not found'], 404);
    }

    $content = json_decode($reportSection->content_image, true);
    
        $key = $request->input('key');
    if (isset($content['images']['editor_'.$key])) {
        $imagePath = $content['images']['editor_'.$key];
        if ($imagePath && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }

        unset($content['images']['editor_'.$key]);

        $reportSection->content_image = json_encode($content);
        $reportSection->save();

        return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
    }

    return response()->json(['message' => 'Image not found'], 404);
}


// store warranty information into the database
public function storeWarrantyInformation(Request $request){
     $data = ReportSection::where('report_id', $request->input('reportId'))
        ->where('id', $request->input('section_type_id'))->first();
        $allData = [
            'date' => $request->input('date'),
            'title' => $request->input('title')
        ];
        $data->content = json_encode($allData);
        $data->save();
        return response()->json(['success' => true]);
}
// change the pages status 
public function changePageStatus(Request $request){
    $reportSection = ReportSection::where('id',$request->section_type_id)
    ->where('report_id', $request->reportId)
    ->first();
    if (!$reportSection) {
        return response()->json(['message' => 'Report section not found'], 404);
    }
    $reportSection->status = $request->status;
    $reportSection->save();
    return response()->json(['success'=>true,'message' => 'Status changed successfully']);
}



// Term and condition page store data and update data 
public function storeTermpageInformation(Request $request){
$allData = [
    'term_page_title' => $request->input('term_condition_title'),
    'content' => $request->input('content'),
];

$reportSection = ReportSection::where('report_id', $request->input('report_id'))
    ->where('id', $request->input('section_type_term_id'))
    ->first();

if ($reportSection) {
    $reportSection->content = json_encode($allData);
    $reportSection->save();
    return response()->json(['success' => true, 'data' => $reportSection]);
} else {
    return response()->json(['success' => false, 'message' => 'Report section not found.'], 404);
}

}


// Generate PDF - view PDF REPORT on click the preview button
public function generatePdf1(Request $request)
{
    $reportId = $request->input('report_id');
    
    $data = ReportSection::select('content')->where('id', $reportId)->first();
    $content = json_decode($data->content, true);

    // Prepare the data for the PDF
    $pdfData = [
        'title' => $content['title'] ?? 'Default Title',
        'date' => $content['date'] ?? date('Y-m-d'),
        'company_name' => $content['company_name'] ?? 'Default Company',
        'address' => $content['address'] ?? 'Default Address',
        'first_name' => $content['first_name'] ?? 'John',
        'last_name' => $content['last_name'] ?? 'Doe',
    ];

    // Generate PDF
    $pdf = \PDF::loadView('report-pdf', $pdfData);
    $pdfPath =  uniqid() . '.pdf'; // Define your path
    $pdf->save($pdfPath);

    return response()->json(['pdf_url' => url($pdfPath)]);
}



// delete title section banner image 
public function deleteBannerImage(Request $request)
{
    $validated = $request->validate([
        'section_type_id' => 'required|integer|exists:report_sections,id',
        'image_name' => 'required|string'
    ]);
    $section = ReportSection::findOrFail($validated['section_type_id']);
    $content = json_decode($section->content, true);
    $content['banner_image'] = null;
    $section->update(['content' => json_encode($content)]);
    $imagePath = public_path($validated['image_name']);
    if (file_exists($imagePath)) {
        unlink($imagePath);
        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }
    return response()->json(['success' => false, 'message' => 'Image not found.']);
}

// company logo Delete image
public function deleteCompanyLogoImage(Request $request)
{
    $validated = $request->validate([
        'section_type_id' => 'required|integer|exists:report_sections,id',
        'image_name' => 'required|string'
    ]);
    $section = ReportSection::findOrFail($validated['section_type_id']);
    $content = json_decode($section->content, true);
    $content['company_logo'] = null;
    $section->update(['content' => json_encode($content)]);
    $imagePath = public_path($validated['image_name']);
    if (file_exists($imagePath)) {
        unlink($imagePath);
        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }
    return response()->json(['success' => false, 'message' => 'Image not found.']);
}

    // thank you page section Add and update data to content 


    // public function ThankyouSection(Request $request){
        
    //     $thankData = ReportSection::where('id',$request->thankyou_section_type_id)
    //     ->where('report_id',$request->report_id)
    //     ->first();

    //     // dd($request->all());

    //     if($thankData){
    //         if(isset($request['thankyou-content'])){
    //                     $contentData['thankyou-content'] = $request['thankyou-content']??'';
    //                 }else{
                
    //                     $contentData['thankyou-content'] = $thankData->content??'';
    //                 }
                
    //                 if(isset($request['thankyou_title'])){
    //                     $contentData['thankyou_title'] = $request['thankyou_title']??'';
    //                 }else{
    //                     $contentData['thankyou_title'] = $thankData->title??'';
                
    //                 }
                


    //         $thankData->content = json_encode($contentData);
    //         $thankData->save();
    //         return response()->json(['success' => false, 'message' => 'Image not found.']);

          
    //     }

    // }
    public function ThankyouSection(Request $request)
{
    // Validate request data
    // $request->validate([
    //     'thankyou_logo' => 'image|mimes:jpeg,png,jpg|max:2048', // Example validation rules
    //     'thankyou_title' => 'required|string|max:255',
    //     'thankyou-content' => 'required|string',
    // ]);

    $thankData = ReportSection::where('id', $request->thankyou_section_type_id)
        ->where('report_id', $request->report_id)
        ->first();

    if ($thankData) {
        $contentData = [
            'thankyou-content' => $request->input('thankyou-content', $thankData->content ?? ''),
            'thankyou_title' => $request->input('thankyou_title', $thankData->title ?? ''),
        ];

        if ($request->hasFile('thankyou_logo')) {
            $file = $request->file('thankyou_logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = 'uploads/thankyoulogo/' . $filename; // Define your path

            $file->move(public_path('uploads/thankyoulogo'), $filename);

            $contentData['thankyou_logo'] = $filePath;
        } else {
            $existingContent = json_decode($thankData->content, true);
            $contentData['thankyou_logo'] = $existingContent['thankyou_logo'] ?? null;
        }

        $thankData->content = json_encode($contentData);
        $thankData->save();


        $thankData = json_decode($thankData->content, true);
    }


    return response()->json(['success' => true,'data'=>$thankData]);
}
//     public function storeData(Request $request)
// { 

    // dd($request->all());
    // $request->validate([
    //     'thankyoupage_content' => 'nullable|string',
    //     'thankyou_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 2MB max
    // ]);

    // $section = ReportSection::findOrFail($request->section_type_thank_you_page);
    // $content = json_decode($section->content, true) ?? [];

    // if ($request->hasFile('thankyou_logo')) {
    //     $image = $request->file('thankyou_logo');
        
    //     $imageName = \Str::random(3) . time() . '.' . $image->getClientOriginalExtension();
        
    //     $imagePath = 'thankyou_logo/' . $imageName;
    //     if ($image->move(public_path('thankyou_logo'), $imageName)) {
    //         $content['image'] = $imagePath;
    //     } else {
    //         return response()->json(['success' => false, 'message' => 'Image upload failed.']);
    //     }
    // } else {
    //     $content['image'] = $content['image'] ?? ''; 
    // }

    // if ($request->filled('thankyoupage_content')) {
    //     $content['thankyoupage_content'] = $request->input('thankyoupage_content');
    // }

    // $section->content = json_encode($content);
    
    // if ($section->save()) {
    //     return response()->json(['success' => true, 'message' => 'Thank You page updated successfully.']);
    // } else {
    //     return response()->json(['success' => false, 'message' => 'Failed to update the Thank You page.']);
    // }

// }


    // Store title section data
    // public function storeData(Request $request)
    // {
        // $allData = [
        //     'title' => $request->title,
        //     'date' => $request->date,
        //     'company_name' => $request->company_name,
        //     'address' => $request->address,
        //     'first_name' => $request->first_name,
        //     'last_name' => $request->last_name,
        // ];
    
        // $reportSection = ReportSection::where('report_id', $request->report_id)
        //     ->where('id', $request->section_type_id)
        //     ->first();
    
        // $existingContent = json_decode($reportSection->content, true);
    
        // if ($request->hasFile('company_logo')) {
        //     if (isset($existingContent['company_logo'])) {
        //         $oldLogoPath = public_path($existingContent['company_logo']);
        //         if (file_exists($oldLogoPath)) {
        //             unlink($oldLogoPath);
        //         }
        //     }
            
        //     $logoPath = 'logos/' . time() . '_' . $request->file('company_logo')->getClientOriginalName();
        //     $request->file('company_logo')->move(public_path('logos'), $logoPath);
        //     $allData['company_logo'] = $logoPath; 
        // } else {
        //     $allData['company_logo'] = $existingContent['company_logo'] ?? null;
        // }
    
        // if ($request->hasFile('banner_image')) {
        //     if (isset($existingContent['banner_image'])) {
        //         $oldBannerPath = public_path($existingContent['banner_image']);
        //         if (file_exists($oldBannerPath)) {
        //             unlink($oldBannerPath);
        //         }
        //     }
            
        //     $bannerPath = 'banners/' . time() . '_' . $request->file('banner_image')->getClientOriginalName();
        //     $request->file('banner_image')->move(public_path('banners'), $bannerPath);
        //     $allData['banner_image'] = $bannerPath; 
        // } else {
        //     $allData['banner_image'] = $existingContent['banner_image'] ?? null;
        // }
    
        // $reportSection->content = json_encode($allData);
        // $reportSection->save();
    
        
    
        // return response()->json(['success' => true, 'data' => $reportSection]);
    // }

//     public function storeData(Request $request)
// {
    
//     // Validate the incoming request data
//     // $request->validate([
//     //     'thankyou_title' => 'required|string|max:255',
//     //     'thankyou_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
//     //     'section_type_id' => 'required|integer',
//     //     'report_id' => 'required|integer',
//     //     'content' => 'nullable|string',
//     // ]);

//     // dd($request->all());
//     $thankYouPage  = ReportSection::where('id', $request->section_type_id)
//                                   ->where('report_id', $request->report_id)
//                                   ->first();
//                                 //   dd($thankYouPage);

//     if (!$thankYouPage) {
//         return response()->json(['success' => false, 'message' => 'Report section not found.'], 404);
//     }

//     // Update the title in the content
//     // dd($reportSection['thankyou-content']);

//     if(isset($request['thankyou-content'])){
//         $contentData['content'] = $request['thankyou-content']??'';
//     }else{

//         $contentData['content'] = $thankYouPage->content??'';
//     }

//     if(isset($request['thankyou_title'])){
//         $contentData['title'] = $request['thankyou_title']??'';
//     }else{
//         $contentData['title'] = $thankYouPage->title??'';

//     }

//     // Handle the logo upload   
//     if ($request->hasFile('thankyou_logo')) {
//         $logoPath = $request->file('thankyou_logo')->store('logos', 'public');
//         $contentData['thankyou_logo'] = $logoPath;
//     }

//     // dd($contentData);
//     // Save the updated content back to the report section
//     $thankYouPage->content = json_encode($contentData);
//     $thankYouPage->save();

//     return response()->json(['success' => true, 'data' => $thankYouPage], 200);
// }

//generate a final PDF for report Quotation

public function generatePDFReport(Request $request)
    {
        try{
            
            $reportSections = ReportSection::where('report_id', $request['reportId'])
                ->orderBy('order','ASC')
                ->get();
            if(isset($reportSections)){
                $html = View::make('report-pdf', ['reportSections' => $reportSections])->render();
                $pdf = new Dompdf();
                $pdf->loadHtml($html);
                $pdf->setPaper('A4', 'portrait');
                $pdf->render();
                $fileName = 'style-' . $request['reportId'] . '.pdf';

                $directoryPath = public_path('quote/report/'.$request['reportId']);
                if (!File::exists($directoryPath)) {
                    File::makeDirectory($directoryPath, 0755, true);
                }
                $filePath = public_path(path: 'quote/report/'.$request['reportId'].'/'. $fileName);
                
                file_put_contents($filePath, $pdf->output());
                $pdfUrl = url('quote/report/'.$request['reportId'].'/'. $fileName);
                return response()->json(['pdf_url' => $pdfUrl]);
            
            }else{
            return response()->json(['error' => 'Something went wrong', 'message' => "style not selected"], 500);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()], 500);
        }
    }
    



// send report  quotation to in email 
public function sendReport(Request $request){
    $reportSections = ReportSection::where('report_id', $request->report_id)
    ->orderBy('order','ASC')
    ->get();
     // Generate PDF if needed
    $pdf = $this->generatereportPDFData($reportSections);
     $user = User::find($request->user_id);
    if (!$user) {
        return response()->json(['message' => 'User not found.'], 404);
    }

    Mail::to($user->email)->send(new ReportMail($pdf));
    return response()->json(['message' => 'Great! Your quotation request was sent successfully.'], 200);
   
}

private function generatereportPDFData($reportSections)
{
    $html = View::make('report-pdf', compact('reportSections'))->render();
    $pdf = new Dompdf();
    $pdf->loadHtml($html);
    $pdf->setPaper('A4', 'portrait');
    $pdf->render();
    return $pdf;
}


// public function storeInspectionData(Request $request){
// {

//     $inspectionSection = ReportSection::find($request->inspection_section_type_id);

//     if ($inspectionSection) {
//         $contentData = [
//             'inspection_title' => $request->input('inspection_title'),
//             'inspection_content' => $request->input('inspection_content'),
//         ];

//         if ($request->hasFile('inspection_image')) {
//             $file = $request->file('inspection_image');
//             $filename = time() . '_' . $file->getClientOriginalName();
//             $filePath = 'uploads/inspection_images/' . $filename;

//             $file->move(public_path('uploads/inspection_images'), $filename);

//             $contentData['inspection_image'] = $filePath;
//         }

//         $inspectionSection->content = json_encode($contentData);
//         $inspectionSection->save();

//         return response()->json(['success' => true, 'data' => $inspectionSection]);
//     }

//     return response()->json(['success' => false], 500);
// }
// }

// public function storeInspectionData(Request $request)
// {
//     // $request->validate([
//     //     'inspection_title' => 'required|string|max:255',
//     //     'inspection_content' => 'required|string',
//     //     'inspection_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Adjust as needed
//     // ]);

//     $inspectionSection = ReportSection::find($request->inspection_section_type_id);

//     if ($inspectionSection) {
//         $contentData = [
//             'inspection_title' => $request->input('inspection_title'),
//             'inspection_content' => $request->input('inspection_content'),
//         ];

//         // Handle image upload
//         if ($request->hasFile('inspection_image')) {
//             $file = $request->file('inspection_image');
//             $filename = time() . '_' . $file->getClientOriginalName();
//             $filePath = 'uploads/inspection_images/' . $filename;

//             $file->move(public_path('uploads/inspection_images'), $filename);

//             $contentData['inspection_image'] = $filePath;
//         }

//         // Save as JSON
//         $inspectionSection->content = json_encode($contentData);
//         $inspectionSection->save();

//         return response()->json(['success' => true, 'data' => $inspectionSection]);
//     }

//     return response()->json(['success' => false], 500);
// }
// public function storeInspectionData(Request $request)
// {
   

//     $inspectionSection = ReportSection::find($request->inspection_section_type_id);

//     if ($inspectionSection) {
//         $contentData = [
//             'inspection_title' => $request->input('inspection_title'),
//             'inspection_content' => $request->input('inspection_content'),
//         ];

//         if ($request->hasFile('inspection_image')) {
//             $file = $request->file('inspection_image');
//             $filename = time() . '_' . $file->getClientOriginalName();
//             $filePath = 'uploads/inspection_images/' . $filename;

//             $file->move(public_path('uploads/inspection_images'), $filename);

//             $contentData['inspection_image'] = $filePath;
//         }

//         $inspectionSection->content = json_encode($contentData);
//         $inspectionSection->save();

//         return response()->json(['success' => true, 'data' => $inspectionSection]);
//     }

// }
public function storeInspectionData(Request $request)
{
    // $request->validate([
    //     'inspection_title' => 'required|string|max:255',
    //     'inspection_content' => 'required|string',
    //     'inspection_section_type_id' => 'required|integer|exists:report_sections,id', // Ensure section exists
    // ]);

    $inspectionSection = ReportSection::find($request->inspection_section_type_id);

    if ($inspectionSection) {
        $existingContent = json_decode($inspectionSection->content, true);
        
        $contentData = [
            'inspection_title' => $request->input('inspection_title'),
            'inspection_content' => $request->input('inspection_content'),
            'inspection_image' => $existingContent['inspection_image'] ?? null,
        ];

        if ($request->hasFile('inspection_image')) {
            $file = $request->file('inspection_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = 'uploads/inspection_images/' . $filename;

            $file->move(public_path('uploads/inspection_images'), $filename);
            
            $contentData['inspection_image'] = $filePath;
        }

        $inspectionSection->content = json_encode($contentData);
        $inspectionSection->save();
        $inspectionSection = json_decode($inspectionSection->content,true);

        return response()->json(['success' => true, 'data' => $inspectionSection]);
    }

    return response()->json(['success' => false], 500);
}

}
