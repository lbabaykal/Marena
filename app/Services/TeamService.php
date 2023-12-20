<?php

namespace App\Services;

use App\Http\Requests\Team\StoreRequest;
use App\Http\Requests\Team\UpdateRequest;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamService
{
    public function store(StoreRequest $request)
    {
        $fileName = $this->uploadLogo($request);

        $data = $request->validated();
        $data['logo'] = $fileName;
        $data['user_id'] = auth()->id();

        return Team::query()->create($data);
    }

    public function update(UpdateRequest $request, Team $team)
    {
        $fileName = $this->uploadLogo($request);

        $data = $request->validated();
        $data['logo'] = $fileName ?? $team->logo;
        $data['user_id'] = auth()->id();

        return $team->update($data);
    }

    private function uploadLogo(StoreRequest|UpdateRequest $request): string|null
    {
        if (! $request->hasFile('logo')) {
            return null;
        }

        return $request->file('logo')->store(options: 'teams');
    }

}
