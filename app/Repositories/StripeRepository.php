<?php
namespace App\Repositories;
use Illuminate\Database\QueryException;
use App\Models\Quotation;
use Auth;

// class QuotationRepository implements QuotationRepositoryInterface
class StripeRepository
{
    /**
     * Send request to contractor for quotation.
     *
     * @param \Illuminate\Http\Request $request
     * @return array ['success' => bool, 'html' => string, 'status' => string, 'message' => string]
     */
    public function updateStatus($quoteId, $status): array
    {
        $quote = Quotation::where('id', $quoteId)->first();
        if ($quote) {
            $quote->status = $status;
            $quote->save();
        }
        $quote = $quote->toArray();
        return $quote;
    }
}

