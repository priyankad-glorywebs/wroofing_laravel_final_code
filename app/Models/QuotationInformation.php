<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationInformation extends Model
{
    use HasFactory;
    protected $table = "quotation_informations";
    protected $fillable = ['contractor_id', 'content'];

    public function contractor()
    {
        return $this->belongsTo(Contractor::class);
    }
}
