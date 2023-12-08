<?php

namespace App\Services;

use App\Http\Requests\Team\StoreRequest;
use App\Http\Requests\Team\UpdateRequest;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamService
{
    private string|null $logo = null;

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo'] = $this->saveLogo($request);
        }

        $data['user_id'] = auth()->id();

        return Team::query()->create($data);
    }

    public function update(UpdateRequest $request, Team $team)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo'] = $this->saveLogo($request);
            $this->logo = $team->logo ?? null;
        }

        $data['user_id'] = auth()->id();

        $team = $team->update($data);
        $this->deleteLogo();

        return $team;
    }

    public function saveLogo(Request $request): bool|string
    {
        return $request->file('logo')->store('/', 'teams');
    }

    public function deleteLogo(): void
    {
        if (isset($this->logo)) {
            Storage::disk('teams')->delete($this->logo);
        }
    }

}
