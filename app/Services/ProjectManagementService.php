<?php

namespace App\Services;

use App\Models\Project;
use App\Models\TimeLog;
use App\Models\Expense;

class ProjectManagementService
{
    public function logTime(Project $project, array $data): TimeLog
    {
        return $project->timeLogs()->create($data);
    }

    public function logExpense(array $data): Expense
    {
        return Expense::create($data);
    }
}
