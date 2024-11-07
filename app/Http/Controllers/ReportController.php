<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\SectionType;
use App\Models\Project;
use App\Models\User;

use App\Models\ReportSection;
use DB;
class ReportController extends Controller
{
    public function changeOrder(Request $request)
{
    $orderData = $request->input('order');
    $reportId = $request->input('report');

    foreach ($orderData as $index => $id) {
        DB::table('report_sections')
            ->where('id', $id)
            ->where('report_id', $reportId)
            ->update(['order' => $index + 1]); // Add +1 if your index is zero-based
    }

    return response()->json([
        'message' => 'Section order changed successfully.',
        'success' => true
    ]);
}
    public function store(Request $request)
    {
        $report = new Report();
        $report->contractor_id = \Auth::guard('contractor')->id();
        $report->project_id = $request->project_id;
        $report->title = $request->title;
        $report->save();
        return response()->json(['success' => true, 'redirect_url' => route('report-view', $report->id)]);
    }


    public function view($id)
    {
        $report = Report::findOrFail($id);

        $getCustomerDetails = $this->getCustomerDetails($report->project_id);
        $sections = SectionType::get();
        $reportSections = ReportSection::where('report_id', $report->id)->orderBy('order','asc')->get();
    if ($reportSections->isEmpty()) {
            foreach ($sections as $index => $sectionType) {
                ReportSection::create([
                    'report_id' => $report->id,
                    'section_type_id' => $sectionType->id,
                    'content' => null,
                    'order' => $index + 1,
                ]);
            }
        }


       $introduction = $reportSections;
        $sectionContents = [];
        foreach ($reportSections as $section) {
            $sectionContents[$section->section_type_id] = json_decode($section->content, true);
        }

        // $salesPersonToken = '{{SALES_PERSON_NAME}}';
        // $accountNameToken = '{{ACCOUNT_NAME}}';
        // $salesPersonFirstNameToken = '{{SALES_PERSON_FIRST_NAME}}';
        // $salesPersonLastName = '{{SALES_PERSON_LAST_NAME}}';
        $salesPersonFullName = '{{SALES_PERSON_FULL_NAME}}';
        // $salesPersonTitle = '{{SALES_PERSON_TITLE}}';
        $salesPersonPhone = '{{SALES_PERSON_PHONE}}';
        $salesPersonEmail = '{{SALES_PERSON_EMAIL}}';
        // $customerFirstName = '{{CUSTOMER_FIRST_NAME}}';
        // $customerLastName = '{{CUSTOMER_LAST_NAME}}';
        $customerFullName = '{{CUSTOMER_FULL_NAME}}';
        // $customerAddress = '{{CUSTOMER_ADDRESS}}';
        $companyNameToken = '{{COMPANY_NAME}}';


        return view('layouts.report-new-view', compact(
            'report',
            'sections',
            'sectionContents',
            // 'salesPersonToken',
            // 'accountNameToken',
            // 'salesPersonFirstNameToken',
            // 'salesPersonLastName',
            'salesPersonFullName',
            // 'salesPersonTitle',
            'salesPersonPhone',
            'salesPersonEmail',
            // 'customerFirstName',
            // 'customerLastName',
            'customerFullName',
            // 'customerAddress',
            'companyNameToken',
            'getCustomerDetails'

        ));
    } 

private function getCustomerDetails($project_id)
    {
        $data = Project::where('id', $project_id)->pluck('user_id');

        $customer = User::find($data[0]);
        return $customer;
    }


public function storeInspectionInfo(Request $request)
{
    $reportSection = ReportSection::where('id', $request->section_type_inspection_id)
                                  ->where('report_id', $request->report_id)
                                  ->first();

    $content = json_decode($reportSection->content, true);
    $contentImages = json_decode($reportSection->content_image, true) ?? [];

    $content['inspection_title'] = $request->inspection_title;

    foreach ($request->input('content', []) as $key => $value) {
        $cleanedKey = str_replace('editor_', '', $key);
        $content['content'][$cleanedKey] = $value;
    }

    foreach ($request->allFiles() as $key => $file) {
        if (str_starts_with($key, 'inspection_image')) {
            $imageName = \Str::random(3) . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('inspection_image'), $imageName);
            $contentImages['images'][str_replace('inspection_image_', '', $key)] = 'inspection_image/' . $imageName;
        }
    }


    if (isset($content['content'])) {
        foreach ($content['content'] as $key => $value) {
            if (!isset($contentImages['images'][$key])) {
                $contentImages['images'][$key] = $contentImages['images'][$key] ?? null;
            }
        }
    }


    if (isset($contentImages['images'])) {
        foreach ($contentImages['images'] as $key => $value) {
            if ($value === null) {
                unset($contentImages['images'][$key]);
            }
        }
    }

    $reportSection->content_image = json_encode($contentImages);
    $reportSection->content = json_encode($content);
    $reportSection->save();

    return response()->json(['success' => true,'inspectionData'=>$reportSection]);
}

private function prepareContent(Request $request)
{
    $content = [
        'title' => $request->input('inspection_title'),
        'content' => [],
        'images'=>[]
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


}