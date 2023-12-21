<?php

namespace Modules\OffersNetwork\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\OffersNetwork\Entities\Category;
use Modules\OffersNetwork\Http\Requests\CategoryRequest;

/**
 * Class CategoryController
 * @package Modules\OffersNetwork\Http\Controllers\Admin
 */
class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     *
     * @return View
     */
    public function index(): View
    {
        $categories = Category::paginate();

        return view('offersnetwork::admin.category.index', compact('categories'));
    }

    /**
     * Store a newly created category.
     *
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        Category::create($validatedData);

        return back()->withNotify([['success', 'New category created']]);
    }

    /**
     * Show details of a specific category.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        $category = Category::findOrFail($request->id);

        return response()->json(['category' => $category]);
    }

    /**
     * Update an existing category.
     *
     * @param CategoryRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request): RedirectResponse
    {
        $category = Category::findOrFail($request->id);

        $validatedData = $request->validated();

        $category->update($validatedData);

        return back()->withNotify([['success', 'Category updated']]);
    }

    /**
     * Remove a category from records.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        Category::destroy($request->id);

        return back()->withNotify([['success', 'Category deleted']]);
    }

    /**
     * Toggle the active status of a category.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function toggleActiveStatus($id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        $category->update([
            'is_active' => !$category->is_active,
        ]);

        return back()->withNotify([['success', 'Category status updated']]);
    }

    /**
     * Toggle the "at home" status of a category.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function toggleAtHomeStatus($id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        $category->update([
            'at_home' => !$category->at_home,
        ]);

        return back()->withNotify([['success', 'Category status updated']]);
    }
}
