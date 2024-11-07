<?php

namespace App\Http\Controllers;
use App\Models\Contractor;
use Illuminate\Support\Facades\Validator; // validator
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class BrandingController extends Controller
{
    public function index() {
        return view('layouts.front.branding');
    }

    public function brandingAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'company_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'primary_color' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $contractor = Contractor::find($request->contarctorId);

        if ($contractor) {
            $contractor->primary_color  = $request->primary_color;
            $oldCompanyLogo             = $contractor->company_logo;
            if ($request->hasFile('company_logo')) {
                $image = $request->file('company_logo');
                $imageName = \Str::random(3) . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('company_logo'), $imageName);
                $contractor->company_logo = 'company_logo/' . $imageName;
                if ($oldCompanyLogo && file_exists(public_path($oldCompanyLogo))) {
                    unlink(public_path($oldCompanyLogo));
                }
            }
            $contractor->save();

            return redirect()->route('branding.theme')->with('success', 'Branding added successfully.');
        } else {
            return response()->json(['error' => 'Contractor not found'], 404);
        }
    }

    /* Select Brand Theme */
    public function indexTheme() {
        return view('layouts.front.brandingtheme');
    }

    public function themeAdd(Request $request)
    {
        $contractor = Contractor::find($request->contarctorId);
        if ($contractor) {
            $contractor->template_style  = $request->style;
            $contractor->save();
            return redirect()->route('branding.theme')->with('success', 'Branding added successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Something is wrong.']);
        }
    }
    public function generateStylePdf(Request $request)
    {
        try{
            $contractor = Contractor::find($request->contarctorId);
            if(isset($request->style) && isset($contractor)){
                $data = [
                    'style' => $request->style, // Example data
                    'contractors' => $contractor, // Example data
                ];
                $viewName = 'layouts.front.projects.contractor.style.style-one';

                switch ($request->style) {
                    case 1:
                        $viewName = 'layouts.front.projects.contractor.style.style-one';
                        break;
                    case 2:
                        $viewName = 'layouts.front.projects.contractor.style.style-two';
                        break;
                    case 3:
                        $viewName = 'layouts.front.projects.contractor.style.style-three';
                        break;
                    case 4:
                        $viewName = 'layouts.front.projects.contractor.style.style-four';
                        break;
                    case 5:
                        $viewName = 'layouts.front.projects.contractor.style.style-five';
                        break;
                    case 6:
                        $viewName = 'layouts.front.projects.contractor.style.style-six';
                        break;
                    default:
                        // Handle the case where the style is not recognized
                        return response()->json(['error' => 'Invalid style selected'], 400);
                }

                $html = View::make($viewName, $data)->render();
                $pdf = new Dompdf();
                $pdf->loadHtml($html);
                $pdf->setPaper('A4', 'portrait');
                $pdf->render();
                // return $pdf;
                $styleId = $request->style;
                // Define the file name and path
                $fileName = 'style-' . $styleId . '.pdf';

                // Check if the directory exists
                $directoryPath = public_path('report_style/contractor/'.$contractor->id);
                if (!File::exists($directoryPath)) {
                    // Create the directory, including any necessary parent directories
                    File::makeDirectory($directoryPath, 0755, true);
                }
                $filePath = public_path('report_style/contractor/'.$contractor->id.'/'. $fileName);
                
                // Save the PDF file to the public directory
                file_put_contents($filePath, $pdf->output());
                // Return the URL to access the PDF file
                $pdfUrl = url('report_style/contractor/'.$contractor->id.'/'. $fileName);
                return response()->json(['pdf_url' => $pdfUrl]);
            }else{
                return response()->json(['error' => 'Something went wrong', 'message' => "style not selected"], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()], 500);
        }
    }

    public function viewer() {
        return view('layouts.front.brandingcontent');
    }
}
