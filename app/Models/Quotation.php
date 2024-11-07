<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;
    protected $table = "quotations";

    protected $fillable = ['due_date','message','final_price','status','rejection_reason'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function contractor()
    {
        return $this->belongsTo(Contractor::class);
    }

    public function quoteItems()
{
    return $this->hasMany(QuotationItem::class,'quote_id');
}

}
