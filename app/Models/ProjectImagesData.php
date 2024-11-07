<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectImagesData extends Model
{
    use HasFactory;

    protected $table = "project_images_data";

    public function project()
  {
      return $this->belongsTo(Project::class, 'project_id');
  }
}
