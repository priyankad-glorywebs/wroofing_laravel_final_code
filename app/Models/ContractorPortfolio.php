<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractorPortfolio extends Model
{
    use HasFactory;

    protected $table = 'contractor_portfolios';

    protected $fillable = [
        'contractor_id',
        'image',
        'date',
        'time',
        'media_type',
    ];
}
