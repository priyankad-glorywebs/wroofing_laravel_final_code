<?php
namespace App\Services;

use App\Repositories\QuotationRepository;
use App\Services\Quotation\QuotationInterface;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use App\Mail\QuotationMail;
use App\Mail\QuoteEmail;
use App\Models\Project;
use Illuminate\Support\Facades\URL;

// class QuotationService implements QuotationInterface
class QuotationService
{
    protected $quotationRepository;

    public function __construct(QuotationRepository $quotationRepository)
    {
        $this->quotationRepository = $quotationRepository;
    }

    /**
     * Send request to contractor for quotation.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function sendRequestContractor($request): array
    {
        return $this->quotationRepository->sendRequestContractor($request);

    }

    public function sendQuotation($quote_id)
    {
        return $this->quotationRepository->sendQuotation($quote_id);
    }

    public function store(Request $request, $quoteId)
    {
        $quoteId = base64_decode($quoteId);
        $quote = $this->quotationRepository->find($quoteId);

        $validatedData = $request->validate([
            'due_date' => 'required',
            'subtotal' => 'required'
        ]);

        $data = explode('$', $request->subtotal);
        $dueDate = date('Y-m-d', strtotime($request->due_date));

        $quote->due_date = $dueDate ?? '';
        $quote->message = $request->message ?? '';
        $quote->final_price = $data[1] ?? '';
        $this->quotationRepository->update($quote);

        $this->quotationRepository->deleteQuotationItems($quoteId);

        if ($request->has('items')) {
            foreach ($request->items as $key => $item) {
                $quotationItem = [
                    'quote_id' => $quoteId,
                    'description' => $item['description'] ?? '',
                    'quantity' => $item['qty'] ?? '',
                    'unit_price' => $item['price'] ?? ''
                ];
                $this->quotationRepository->createQuotationItem($quotationItem);
            }
        } else {
            return ['success' => false, 'message' => 'Add at least one item before submitting quotation'];
        }

        return ['success' => true, 'message' => 'Quotation created successfully'];
    }



    public function previewQuote($quoteId)
    {
        $quoteData = $this->quotationRepository->findWithRelations(base64_decode($quoteId));
        $quotationItems = $this->quotationRepository->getQuotationItems(base64_decode($quoteId));
        $userDetails = $quoteData->project->user;
        return [
            'quoteData' => $quoteData,
            'userDetails' => $userDetails,
            'quotationItems' => $quotationItems,
        ];
    }



    public function sendQuote($quoteId)
    {
        $quote = $this->quotationRepository->updateStatus($quoteId, 'Responded');

        if (!$quote) {
            return null;
        }

        $quoteData      = $this->quotationRepository->findWithRelationships($quoteId);
        $quotationItems = $this->quotationRepository->getQuotationItems($quoteId);
        $contractor     = auth()->guard('contractor')->user();
        $userDetails    = $quoteData->project->user;

        $project        = Project::find($quoteData->project_id);

        $data = [
            'quoteData'     => $quoteData,
            'quotationitem' => $quotationItems,
            'contractor'    => $contractor,
            'userDetails'   => $userDetails,
        ];

        // Generate PDF if needed
        $pdf = $this->generatePDF($data);

        // Send email
        Mail::to($userDetails->email)->send(new QuotationMail($pdf));

        /* PAYMENT LINK */
        $signedUrl = URL::temporarySignedRoute(
            'review.sign.quote', // The name of the route
            now()->addHours(24), // Expire after 24 hours
            [
                'quote_id' => base64_encode($quoteData->id),
                'project_id' => base64_encode($quoteData->project_id),
                'customer_id' => base64_encode($userDetails->id),
            ] // Route parameter
        );

        // Send the email
        Mail::to($userDetails->email)->send(new QuoteEmail($signedUrl, $data));
        return [
            'quoteData'     => $quoteData,
            'quotationitem' => $quotationItems,
            'contractor'    => $contractor,
            'userDetails'   => $userDetails,
        ];
    }

    private function generatePDF($data)
    {
        $html = View::make('layouts.front.projects.contractor.Quotation.quotationpdf', $data)->render();
        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        // $pdf->setOptions(['defaultFont' => 'Plus Jakarta Sans']);
        $pdf->render();
        return $pdf;
    }


    public function viewQuotation($quoteId)
    {
        $quoteData = $this->quotationRepository->findWithRelationships($quoteId);

        if (!$quoteData) {
            return null; // or handle accordingly
        }
        $quotationItems = $this->quotationRepository->getQuotationItems($quoteId);
        $userDetails = $quoteData->project->user;

        return [
            'quoteData' => $quoteData,
            'quotationitem' => $quotationItems,
            'userDetails' => $userDetails,
        ];
    }

    public function customerQuotationStatus($quoteId, $status, $reasonRejection = null, $projectId = null)
    {
        try {
            $quote = $this->quotationRepository->updateQuotationStatus($quoteId, $status, $reasonRejection);

            if ($status === 'approved' && !is_null($projectId)) {
                $this->quotationRepository->updateProjectStatus($projectId, $status);
            }

            return response()->json(['success' => true, 'status' => $quote->status, 'message' => 'Your Quotation status has been changed']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while updating the quotation status'], 500);
        }
    }

    // send a new quotation request
    public function sendNewQuote($project_id, $contractor_id)
    {
        $quotation = $this->quotationRepository->createQuotation($project_id, $contractor_id);
        return $quotation;
    }
}