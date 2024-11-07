<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'customer_id',
        'contractor_id',
        'quote_id',
        'project_id',
        'amount',
        'discount',
        'total',
        'transaction_number',
        'payment_status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
