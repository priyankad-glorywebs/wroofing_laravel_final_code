<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuotationInformation;

class QuotationInformationController extends Controller
{
    /**
     * Show the form for creating a new Quotation Information.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $contractorId = auth()->guard('contractor')->user()->id;
        $quotationInformation = QuotationInformation::where('contractor_id', $contractorId)->first();

        return view(
            'layouts.front.projects.contractor.Quotation.service.create',
            compact('quotationInformation')
        );
    }

    /**
     * Store a newly created or updated Quotation Information in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'contractor_id' => 'required|exists:contractors,id',
            'content' => 'required',
        ]);

        QuotationInformation::updateOrCreate(
            ['contractor_id' => $request->contractor_id],
            ['content' => $request->content]
        );

        return redirect()->back()->with('success', 'Quotation Information saved successfully.');
    }
    public function hailMap()
    {
        return view('hail-maps');
    }

}
