<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Country\StoreRequest;
use App\Http\Requests\Admin\Country\UpdateRequest;
use App\Marena;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::orderBY('id', 'ASC')->paginate(Marena::COUNT_ADMIN_ITEMS);
        return view('admin.country.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.country.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Country::create($data);
        return redirect(route('admin.countries.index'));
    }

    public function show(Country $country)
    {
        return redirect()->route('admin.country.index');
    }

    public function edit(Country $country)
    {
        return view('admin.country.edit', compact('country'));
    }

    public function update(UpdateRequest $request, Country $country)
    {
        $data = $request->validated();
        $country->update($data);
        return redirect(route('admin.countries.index'));
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return redirect(route('admin.countries.index'));
    }
}
