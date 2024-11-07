<?php

namespace App\Services;

use App\ProjectInterface;
use App\ProjectRepositoryInterface;

class ProjectService implements ProjectInterface
{
    protected $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function getAllProjects()
    {
        return $this->projectRepository->getAllProjects();
    }
}