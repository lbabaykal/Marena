<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Marena;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBY('id', 'ASC')->paginate(Marena::COUNT_ADMIN_ITEMS);
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Category::create($data);
        return redirect(route('admin.categories.index'));
    }

    public function show(Category $category)
    {
        return redirect()->route('admin.category.index');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(UpdateRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);
        return redirect(route('admin.categories.index'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect(route('admin.categories.index'));
    }
}
