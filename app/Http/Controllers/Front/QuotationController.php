<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\QuotationRepository;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Quotation;
use App\Models\Contractor;
use App\Models\User;
use App\Models\QuotationItem;
use Exception;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use App\Mail\QuotationMail;
use App\Models\QuotationInformation;
use PDF;
use App\Services\QuotationService;
use App\Services\TransactionService;

class QuotationController extends Controller
{

    protected $quotationService;
    protected $transactionService;

    public function __construct(QuotationService $quotationService, TransactionService $transactionService)
    {
        $this->quotationService = $quotationService;
        $this->transactionService = $transactionService;
    }
    /**
     * Send request to contractor for quotation.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendRequestContractor(Request $request)
    {
        $response = $this->quotationService->sendRequestContractor($request);
        return response()->json($response);
    }


    public function sendQuotation($quote_id)
    {
        $response = $this->quotationService->sendQuotation($quote_id);
        if (!$response) {
            abort(404);
        }
        $quoteData = $response['quoteData'] ?? '';
        $userDetails = $response['userDetails'] ?? '';
        $quotationItems = $response['quotationItems'] ?? '';
        return view('layouts.front.projects.contractor.Quotation.quotation', compact('quoteData', 'userDetails', 'quotationItems'));
    }

    public function store(Request $request, $quoteId)
    {
        $result = $this->quotationService->store($request, $quoteId);

        if ($result['success']) {
            return redirect()->back()->with(['success' => true, 'message' => $result['message']]);
        } else {
            return response()->json(['success' => false, 'message' => $result['message']]);
        }
    }
    public function previewQuote($quoteId)
    {
        $response        = $this->quotationService->previewQuote($quoteId);
        $quoteId         = base64_decode($quoteId);
        $transactionData = $this->transactionService->getTransactions($quoteId);
        $quoteData       = $response['quoteData'] ?? '';
        $userDetails     = $response['userDetails'] ?? '';
        $quotationitem   = $response['quotationItems'] ?? '';
        $transaction     = array();
        if(isset($transactionData) ){
            if(isset($transactionData[0])){
                $transaction = $transactionData[0];
            }else{
                $transaction = null;
            }
        }
        return view('layouts.front.projects.contractor.Quotation.quotation_preview', compact('quoteData', 'userDetails', 'quotationitem', 'transaction'));
    }

    public function sentQuote(Request $request)
    {
        $quoteId = $request->quote_id;
        $quoteData = $this->quotationService->sendQuote($quoteId);

        if (!$quoteData) {
            abort(404);
        }
        return response()->json(['success' => true, 'data' => $quoteData, 'message' => 'Quotation sent successfully']);
    }

    public function viewQuotation(Request $request, $quote_id)
    {
        $quoteId            = base64_decode($quote_id);
        $quotationData      = $this->quotationService->viewQuotation($quoteId);
        $transactionData    = $this->transactionService->getTransactions($quoteId);
        
        if(isset($transactionData) && isset($quotationData)){
            if(isset($transactionData[0])){
                $quotationData['transaction'] = $transactionData[0];
            }else{
                $quotationData['transaction'] = null;
            }
        }
        if (!$quotationData) {
            abort(404);
        }

        return view('layouts.front.projects.contractor.Quotation.view_quotation', $quotationData);
    }




    public function customerQuotationStatus(Request $request)
    {
        $quoteId = $request->quote_id;
        $status = $request->status;
        $reasonRejection = $request->reasonRejection ?? null;
        $projectId = $request->project_id ?? null;

        return $this->quotationService->customerQuotationStatus($quoteId, $status, $reasonRejection, $projectId);
    }



    public function sendNewQuote(Request $request)
    {
        $project_id = $request->projectid;
        $contractor_id = $request->contractorid;

        $quotation = $this->quotationService->sendNewQuote($project_id, $contractor_id);

        return response()->json([
            'success' => true,
            'quoteid' => base64_encode($quotation->id),
            'message' => 'Your Quotation status has been changed'
        ]);
    }

    /* paynow page */
    public function customerQuotationPaynow($quote_id)
    {   
        $quoteId        = (int)base64_decode($quote_id);
        $quotationData  = $this->quotationService->viewQuotation($quoteId);
        if (!$quotationData) {
            abort(404);
        }
        return view('layouts.front.projects.contractor.Quotation.quotationpay', $quotationData);
    }

    public function reviewAndSignQuote(Request $request,$quote_id,$project_id,$customer_id)
    {
        $quote_id   = base64_decode($quote_id);
        $project_id = base64_decode($project_id);
        $customer_id= base64_decode($customer_id);

        // Retrieve the quote using the quoteId
        $transactionData    = $this->transactionService->getTransactions((int)$quote_id);
        // Check if payment is already completed
        if(isset($transactionData) && isset($transactionData[0]['payment_status'])){
            if ($transactionData[0]['payment_status'] === 'Completed') {
                return redirect()->route('quote.expired'); // Redirect to an expired page
            }
        }
        $quotationData  = $this->quotationService->viewQuotation((int)$quote_id);
        
        if(isset($quotationData)){
            $quotationData['customer_id']  = (int)$customer_id;
        }    
        
        if (!$quotationData) {
            abort(404);
        }
        // Render a view with the quote details and payment form (e.g., Stripe)
        return view('layouts.front.quotes.review-sign', compact('quotationData'));
    }

    // private function pdfview(Request $request, $quoteid)
    // {
    //     $contractor = auth()->guard('contractor')->user();
    //     $quoteData = Quotation::with('project', 'contractor')->find($quoteid);
    //     $quotationitem = QuotationItem::where('quote_id', $quoteid)->get();
    //     $userDetails = $quoteData->project->user;

    //     $data = [
    //         'quoteData' => $quoteData,
    //         'quotationitem' => $quotationitem,
    //         'contractor' => $contractor,
    //         'userDetails' => $userDetails
    //     ];
    //     $contractorId = auth()->guard('contractor')->user()->id;
    //     $quotationInformation = QuotationInformation::where('contractor_id', $contractorId)->first();

    //     $pdf = \PDF::loadView('layouts.front.projects.contractor.Quotation.quotationpdf', compact('quoteData', 'quotationitem', 'userDetails', 'contractor', 'quotationInformation'))->setOptions(['defaultFont' => 'arial']);
    //     mail::to($userDetails->email)->send(new QuotationMail($pdf));
    //     return $pdf->download('quotation.pdf');
    // }
}
