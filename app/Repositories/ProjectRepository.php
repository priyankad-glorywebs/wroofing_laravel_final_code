<?php

namespace App\Repositories;

use App\Models\Project;
use Carbon\Carbon;
use App\Models\ProjectImagesData;
use App\ProjectRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;


class ProjectRepository implements ProjectRepositoryInterface
{
    public function getAllProjects()
    {
        return Project::all();
    }


    public function createProject($projectData)
    {
        try {
            $project = new Project();
            $project->name = $projectData['name'];
            $project->title = $projectData['title'];
            $project->user_id = $projectData['user_id'];
            $project->created_by = $projectData['created_by'];
            $project->updated_by = $projectData['updated_by'];
            $project->status = $projectData['status'];
            $project->save();
            return $project;
        } catch (\Exception $e) {
            throw $e;
        }
    }


       public function isProjectNameUnique($name, $userId)
    {
        return Project::
            where('user_id', $userId)
            ->where('name', $name)
            // ->orwhere('title', $name)
            ->doesntExist();
    }


    //design studio customer side 
    public function designStudio($project_id, $request)
    {
        if ($request->designfilter_todate != null && $request->designfilter_fromdate != null) {
            $filterData = ProjectImagesData::where('project_id', base64_decode($project_id));
            $to_date = Carbon::createFromFormat('m-d-Y', $request->designfilter_todate)->format('Y-m-d');
            $from_date = Carbon::createFromFormat('m-d-Y', $request->designfilter_fromdate)->format('Y-m-d');
            $filterData->whereDate('date', '>=', $to_date);
            $filterData->whereDate('date', '<=', $from_date);
            $groupedData = $filterData->orderBy('date', 'desc')->get()->groupBy(function ($item) {
                return Carbon::parse($item->date)->format('m-d-Y');
            });

            $dsview = view('layouts.front.projects.steps.filterdata-design-studio', compact('groupedData'))->render();

            return response()->json(['filterdata' => $dsview]);
        } else {
            return view("layouts.front.projects.steps.design-studio", compact("project_id"));
        }
    }


    /*************************************************************************************************************************/
    /***********************************************   Contractor Method     ******************************************** */
    /***********************************************************************************************************************/


    //Contractor dashboard page project list
    // add project by contrcator 

     // add project by contrcator 

     public function createProjectContractor($projectData)
     {
         try {
             $project = new Project();
             $project->name = $projectData['name'];
             $project->title = $projectData['title'];
             $project->country_code = $projectData['country_code'];
             $project->phone = $projectData['contact_number'];
             $project->user_id = $projectData['user_id']??'';
             $project->created_by = $projectData['created_by'];
             $project->updated_by = $projectData['updated_by'];
             $project->status = $projectData['status'];
             $project->added_by_contractor = $projectData['added_by_contractor']??'';
             $project->save();
             return $project;
         } catch (\Exception $e) {
             throw $e;
         }
     }


}