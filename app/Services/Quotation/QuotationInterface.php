<?php
namespace App\Services\Quotation;
use Illuminate\Http\Request;

/**
 * Interface QuotationInterface
 * 
 * This interface defines the contract for interacting with a quotation service.
 */
interface QuotationInterface
{
    /**
     * Sends a request to a contractor for a quotation.
     *
     * @param Request $request The request object containing necessary data for the quotation request.
     * @return array An array containing the response from the contractor.
     */
    public function sendRequestContractor(Request $request): array;
}
