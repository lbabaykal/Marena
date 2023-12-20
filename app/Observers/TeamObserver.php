<?php

namespace App\Observers;

use App\Models\Team;
use Illuminate\Support\Facades\Storage;

class TeamObserver
{
    public function updating(Team $team): void
    {
        if ($team->isDirty('logo') && $team->getOriginal('logo')) {
            Storage::disk('teams')->delete($team->getOriginal('logo'));
        }
    }

    public function deleted(Team $team): void
    {
        Storage::disk('teams')->delete($team->logo);
    }
}
