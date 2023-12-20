<?php

namespace App\Http\Controllers;

use App\Http\Requests\Team\StoreRequest;
use App\Http\Requests\Team\UpdateRequest;
use App\Marena;
use App\Models\Team;
use App\Services\TeamService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function __construct()
    {
//        $this->authorizeResource(Teams::class, 'team');
    }

    public function index(): View
    {
        $teams = Team::query()
            ->orderBy('teams.id')
            ->paginate(Marena::COUNT_ADMIN_ITEMS);

        return view('team.index')->with('teams', $teams);
    }

    public function show(Team $team)
    {
        return view('team.show')->with('team', $team);
    }

    public function create(): View
    {
        return view('team.create');
    }

    public function store(StoreRequest $request, TeamService $teamService): RedirectResponse
    {
        $team = $teamService->store($request);

        return redirect()->route('teams.show', $team->id);
    }

    public function edit(Team $team): View
    {
        return view('team.edit')->with('team', $team);
    }

    public function update(UpdateRequest $request, Team $team, TeamService $teamService): RedirectResponse
    {
        $teamService->update($request, $team);

        return redirect()->route('teams.show', $team->id);
    }

    public function destroy(Team $teams): RedirectResponse
    {
        return redirect()->route('teams.index');
    }

    public function description(Team $team): View
    {
        return view('team.show')->with('team', $team);
    }
}
