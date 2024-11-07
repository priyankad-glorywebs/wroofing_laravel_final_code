<?php
namespace App\Services;

use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use App\Mail\QuotationMail;

// class QuotationService implements QuotationInterface
class TransactionService 

{
    protected $TransactionRepository;

    public function __construct(TransactionRepository $TransactionRepository)
    {
        $this->TransactionRepository = $TransactionRepository;
    }

    /**
     * Send request to contractor for quotation.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function getTransactions($quoteId): array
    {
        return $this->TransactionRepository->getTransactions($quoteId);
    }

}