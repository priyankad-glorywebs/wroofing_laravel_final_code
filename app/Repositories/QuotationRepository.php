<?php

namespace App\Repositories;

use App\Repository\Quotation\QuotationRepositoryInterface;
use App\Models\Project;
use App\Models\Quotation;
use Illuminate\Database\QueryException;
use App\Models\QuotationItem;
use Auth;

// class QuotationRepository implements QuotationRepositoryInterface
class QuotationRepository
{
    /**
     * Send request to contractor for quotation.
     *
     * @param \Illuminate\Http\Request $request
     * @return array ['success' => bool, 'html' => string, 'status' => string, 'message' => string]
     */
    public function sendRequestContractor($request): array
    {
        try {
            if (isset($request->project_id)) {
                $projectData = Project::where('id', $request->project_id)->first();

                if ($projectData && $projectData->project_status !== 'approved') {
                    $projectData->project_status = 'Requested';
                    $projectData->save();
                }

                $quotation = new Quotation;
                $quotation->project_id = $projectData->id;
                $quotation->status = 'Requested';
                $quotation->contractor_id = $request->contractor_id;
                $quotation->save();

                if ($request->ajax()) {
                    $quotations = Quotation::where('project_id', $request->project_id)->get();

                    $viewQuote = view('layouts.front.projects.customer.view-quote', compact('quotations'))->render();
                    $status = $quotation->status ?? '';

                    $statusView = view('layouts.front.projects.customer.status', compact('status'))->render();

                    return [
                        'success' => true,
                        'html' => $viewQuote,
                        'status' => $statusView,
                        'message' => 'Quotation request sent successfully.'
                    ];
                }
            }
        } catch (QueryException $e) {
            \Log::error('SQL Error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Error occurred while sending quotation request.'
            ];
        } catch (\Throwable $e) {
            \Log::error('Error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Unexpected error occurred.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Invalid or missing project ID.'
        ];
    }


    public function sendQuotation($quote_id)
    {
        $decoded_id = base64_decode($quote_id);
        $quoteData = Quotation::with('project', 'contractor')
            ->find($decoded_id);
        if (!$quoteData) {
            return null;
        }
        $userDetails = $quoteData->project->user;
        $contractorData = auth()->guard('contractor')->user();
        $quotationItems = QuotationItem::join('quotations', 'quotations.id', '=', 'quotations_items.quote_id')
            ->where('quotations.id', $decoded_id)
            ->where('quotations.contractor_id', $contractorData->id)
            ->select('quotations_items.*')
            ->get();
        return [
            'quoteData' => $quoteData ?? '',
            'userDetails' => $userDetails ?? '',
            'quotationItems' => $quotationItems ?? '',
        ];
    }

    public function createQuotationItem(array $data)
    {
        QuotationItem::create($data);
    }

    public function update(Quotation $quotation)
    {
        $quotation->save();
    }

    public function deleteQuotationItems($quoteId)
    {
        QuotationItem::where('quote_id', $quoteId)->delete();
    }
    public function find($id)
    {
        return Quotation::findOrFail($id);
    }


    public function findWithRelations($quoteId)
    {
        return Quotation::with('project', 'contractor')->find($quoteId);
    }

    public function getQuotationItems($quoteId)
    {
        return QuotationItem::where('quote_id', $quoteId)->get();
    }


    //send quotation methods
    public function findWithRelationships($quoteId)
    {
        return Quotation::with('project.user', 'contractor')
            ->find($quoteId);
    }
    
    public function updateStatus($quoteId, $status)
    {
        $quote = Quotation::where('id', $quoteId)->first();
        if ($quote) {
            $quote->status = $status;
            $quote->save();
        }
        return $quote;
    }
    
    // public function getQuotationItems($quoteId)
    // {
    //     return QuotationItem::where('quote_id', $quoteId)->get();
    // }
    
    // public function findWithRelationships($quoteId)
    // {
    //     return Quotation::with('project.user', 'contractor')
    //         ->find($quoteId);
    // }

    // public function getQuotationItems($quoteId)
    // {
    //     return QuotationItem::where('quote_id', $quoteId)->get();
    // }


    public function findOrFail($quoteId)
    {
        return Quotation::findOrFail($quoteId);
    }

    public function updateQuotationStatus($quoteId, $status, $reasonRejection = null)
    {
        $quote = Quotation::findOrFail($quoteId);
        $quote->status = $status;
        if ($status === 'rejected' && !is_null($reasonRejection)) {
            $quote->rejection_reason = $reasonRejection;
        }
        $quote->save();

        return $quote;
    }

    public function updateProjectStatus($projectId, $status)
    {
        $project = Project::findOrFail($projectId);
        $project->project_status = $status;
        $project->save();

        return $project;
    }
    // public function sendnewquote($request){
    //     $quotation = new Quotation;
    //         $quotation->project_id = $request->projectid;
    //         // $quotation->status = 'Responded';
    //         $quotation->contractor_id = $request->contractorid;
    //         $quotation->save();
    //         return response()->json(['success' => true, 'quoteid' => base64_encode($quotation->id), 'message' => 'Your Quotation status has been changed']);
    
    // }
    public function createQuotation($project_id, $contractor_id)
    {
        $quotation = new Quotation;
        $quotation->project_id = $project_id;
        $quotation->contractor_id = $contractor_id;
        $quotation->save();

        return $quotation;
    }
}

