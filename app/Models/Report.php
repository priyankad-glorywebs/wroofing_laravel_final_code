<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ReportSection;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';


    protected $fillable = ['contractor_id', 'project_id', 'title'];

    public function sections()
    {
        return $this->hasMany(ReportSection::class);
    }

    

}
