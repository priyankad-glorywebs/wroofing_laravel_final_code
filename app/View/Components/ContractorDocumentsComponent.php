<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ContractorDocumentsComponent extends Component
{
    public $projectId;
    public $documents;
    public $insuranceDocuments;
    public $mortgageDocuments;
    public $contractorDocuments;

    public function __construct($projectId, $documents, $insuranceDocuments, $mortgageDocuments, $contractorDocuments)
    {
        $this->projectId = $projectId;
        $this->documents = $documents;
        $this->insuranceDocuments = $insuranceDocuments;
        $this->mortgageDocuments = $mortgageDocuments;
        $this->contractorDocuments = $contractorDocuments;
    }

    public function render()
    {
        return view('components.contractor-documents-component');
    }
}
