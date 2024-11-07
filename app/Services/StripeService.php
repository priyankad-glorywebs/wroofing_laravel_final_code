<?php
namespace App\Services;

use App\Repositories\StripeRepository;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use App\Mail\QuotationMail;

// class QuotationService implements QuotationInterface
class StripeService 

{
    protected $StripeRepository;

    public function __construct(StripeRepository $StripeRepository)
    {
        $this->StripeRepository = $StripeRepository;
    }

    /**
     * Send request to contractor for quotation.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function updateStatus($quoteId,$status): array
    {
        return $this->StripeRepository->updateStatus($quoteId, $status);
    }
}