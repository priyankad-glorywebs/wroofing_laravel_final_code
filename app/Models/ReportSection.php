<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportSection extends Model
{
    use HasFactory;

    protected $table = 'report_sections';
    protected $fillable = ['report_id', 'section_type_id', 'content', 'content_image','order', 'status'];


    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
