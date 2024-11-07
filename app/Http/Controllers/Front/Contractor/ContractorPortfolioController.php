<?php

namespace App\Http\Controllers\Front\Contractor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContractorPortfolio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Jobs\ProcessPortfoliMedia;
use Carbon\Carbon;



class ContractorPortfolioController extends Controller
{

    public function portfolio(Request $request)
    {
        $user = Auth::user() ?? auth()->guard('contractor')->user();
        // $projectImageData = ContractorPortfolio::where('contractor_id', $user->id)
        //     ->orderBy('date', 'desc')
        //     ->get();
        // $groupedData = $projectImageData->groupBy('date');


        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $projectImageData = ContractorPortfolio::where('contractor_id', $user->id)
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->orderBy('date', 'desc')
            ->get();

        $groupedData = $projectImageData->groupBy('date');


        if ($request->designfilter_todate != null && $request->designfilter_fromdate != null) {
            $filterData = ContractorPortfolio::where('contractor_id', $user->id);
            $to_date = Carbon::createFromFormat('m-d-Y', $request->designfilter_todate)->format('Y-m-d');
            $from_date = Carbon::createFromFormat('m-d-Y', $request->designfilter_fromdate)->format('Y-m-d');
            $filterData->whereDate('date', '>=', $to_date);
            $filterData->whereDate('date', '<=', $from_date);
            $groupedData = $filterData->orderBy('date', 'desc')->get()->groupBy(function ($item) {
                return Carbon::parse($item->date)->format('m-d-Y');
            });
            $dsview = view('layouts.front.filter-contractor-portfolio', compact('groupedData'))->render();
            return response()->json(['filterdata' => $dsview]);
        } else {
            return view('layouts.front.contractor-portfolio', compact('groupedData'));
        }
    }

    public function portfolioStore(Request $request)
    {
        if ($request->hasFile("file")) {
            $user = Auth::user() ?? auth()->guard('contractor')->user();
            $files = $request->file("file");

            foreach ($files as $file) {
                $filePath = $file->store('contractor_portfolio', 'public');
                ProcessPortfoliMedia::dispatch($filePath, $file->getClientOriginalName(), $user);
            }
        }


        // $projectImageData = ContractorPortfolio::where('contractor_id', $user->id)
        //     ->orderBy('date', 'desc')
        //     ->get();
        // $groupedData = $projectImageData->groupBy('date');


        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        
        $projectImageData = ContractorPortfolio::where('contractor_id', $user->id)
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->orderBy('date', 'desc')
            ->get();

        $groupedData = $projectImageData->groupBy('date');


        $view = view('layouts.front.contractor-portfolio-gallery', compact('groupedData'))->render();
        return response()->json([
            "success" => "Files uploaded successfully",
            // "project_id" => $project_id,
            //"projectImage" => $projectImageData,
            'designstudio' => $view
        ]);

    }

    public function portfolioDelete(Request $request, $file)
    {
        $mediaItem = ContractorPortfolio::find($file);
        if (!$mediaItem) {
            return response()->json(['message' => 'Media item not found.'], 404);
        }

        Storage::disk('public')->delete($mediaItem->image);
        $mediaItem->delete();
        $count = ContractorPortfolio::where('contractor_id', Auth::user()->id)->count();
        return response()->json(['message' => 'File deleted successfully.', 'count' => $count]);
    }
}
