<?php

namespace App\Repositories\Contracts;

interface BackOfficeNotificationRepository
{
    public function getWorkflowTaskForBackOffice($isAdmin = false, $userId = null);

    public function getWorkflowTaskDetailForBackOffice($isAdmin = false, $userId = null);

}
