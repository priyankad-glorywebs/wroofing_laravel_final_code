<?php
namespace App\Repositories;
use Illuminate\Database\QueryException;
use App\Models\Transaction;
use Auth;

// class QuotationRepository implements QuotationRepositoryInterface
class TransactionRepository
{
    /**
     * Send request to contractor for quotation.
     *
     * @param \Illuminate\Http\Request $request
     * @return array ['success' => bool, 'html' => string, 'status' => string, 'message' => string]
     */
    public function getTransactions($quoteId): array
    {
        try {
            $TransactionData = Transaction::where('quote_id', (int)$quoteId)->get()->toArray();
            return $TransactionData;

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
}


