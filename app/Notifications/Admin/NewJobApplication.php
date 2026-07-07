<?php

namespace App\Notifications\Admin;

use App\Models\VacancyApplication;

class NewJobApplication extends AdminNotification
{
    public function __construct(public VacancyApplication $application) {}

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'application',
            'title' => __('New job application'),
            'message' => $this->application->name ?? $this->application->email ?? '',
            'route' => 'admin.vacancy-applications.show',
            'param' => $this->application->id,
        ];
    }
}
