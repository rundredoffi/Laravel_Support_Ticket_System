<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display the page with category list.
     *
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', Category::class);

        $categories = Category::select(['id', 'name', 'created_at'])
            ->latest()
            ->paginate(20);

        return view('web.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Category::class);

        return view('web.categories.create');
    }

    /**
     * Store a newly created category.
     *
     * @see \App\Observers\CategoryObserver::created()  Clears the cache.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(CategoryRequest $request)
    {
        $this->authorize('create', Category::class);

        Category::create($request->validated());

        return redirect()->route('categories.index')
            ->withSuccess($this->successMessage('category', 'created'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Category $category)
    {
        $this->authorize('update', $category);

        return view('web.categories.edit', compact('category'));
    }

    /**
     * Update the specified category.
     *
     * @see \App\Observers\CategoryObserver::updated()  Clears the cache.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $this->authorize('update', $category);

        $category->update($request->validated());

        return redirect()->route('categories.edit', $category)
            ->withSuccess($this->successMessage('category', 'updated'));
    }

    /**
     * Remove the specified category.
     *
     * @see \App\Observers\CategoryObserver::deleted()  Clears the cache.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);

        if (!$category->delete()) {
            return redirect()->route('categories.edit', $category)
                ->withFail($this->failMessage('category', 'deleted'));
        }

        return redirect()->route('categories.index')
            ->withSuccess($this->successMessage('category', 'deleted'));
    }
}
