<?php

namespace App\Observers;

use App\Models\VacancyApplication;
use App\Notifications\Admin\NewJobApplication;
use App\Support\AdminAudience;
use Illuminate\Support\Facades\Notification;

class VacancyApplicationObserver
{
    public function created(VacancyApplication $application): void
    {
        Notification::send(AdminAudience::for('application'), new NewJobApplication($application));
    }
}
