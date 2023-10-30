<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Country\StoreRequest;
use App\Http\Requests\Admin\Country\UpdateRequest;
use App\Marena;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CountryController extends Controller
{
    public function index(): View
    {
        $countries = Country::query()
            ->orderBY('countries.id')
            ->paginate(Marena::COUNT_ADMIN_ITEMS);
        return view('admin.country.index')->with('countries', $countries);
    }

    public function show(Country $country): RedirectResponse
    {
        return redirect()->route('admin.country.index');
    }

    public function create(): View
    {
        return view('admin.country.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Country::query()->create($data);
        return redirect(route('admin.countries.index'));
    }

    public function edit(Country $country): View
    {
        return view('admin.country.edit')->with('country', $country);
    }

    public function update(UpdateRequest $request, Country $country): RedirectResponse
    {
        $data = $request->validated();
        $country->update($data);
        return redirect(route('admin.countries.index'));
    }

    public function destroy(Country $country): RedirectResponse
    {
        $country->delete();
        return redirect(route('admin.countries.index'));
    }

}
