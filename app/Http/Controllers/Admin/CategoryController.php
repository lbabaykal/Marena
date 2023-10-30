<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Marena;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()
            ->orderBy('categories.id')
            ->paginate(Marena::COUNT_ADMIN_ITEMS);
        return view('admin.category.index')->with('categories', $categories);
    }

    public function show(Category $category): RedirectResponse
    {
        return redirect()->route('admin.category.index');
    }

    public function create(): View
    {
        return view('admin.category.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Category::query()->create($data);
        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category): View
    {
        return view('admin.category.edit')->with('category', $category);
    }

    public function update(UpdateRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated();
        $category->update($data);
        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->route('admin.categories.index');
    }

}
