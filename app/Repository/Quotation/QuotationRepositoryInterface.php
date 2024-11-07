<?php

namespace App\Repository\Quotation;

use Illuminate\Http\Request;

/**
 * Interface QuotationRepositoryInterface
 * 
 * This interface defines the contract for interacting with a quotation repository.
 */
interface QuotationRepositoryInterface 
{
    /**
     * Sends a request to a contractor for a quotation.
     *
     * @param Request $request The request object containing necessary data for the quotation request.
     * @return array An array containing the response from the contractor.
     */
    public function sendRequestContractor(Request $request): array;


    // public function sendQuotation($quoteId):void;
    /**
     * Send quotation for the given quote ID using the repository.
     *
     * @param int $quoteId The ID of the quotation to send.
     * @return bool True if the quotation was successfully sent; otherwise, false.
     */
    public function sendQuotation($quoteId): bool;
}
