<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $perPage = 10;
        $records = Category::latest()->paginate($perPage);

        return view('categories.index', compact('records'))
            ->with('i', (request()->input('page', 1) - 1) * $perPage);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('categories.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): View
    {
        $record = Category::find($id);

        return view('categories.show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $record = Category::find($id);

        return view('categories.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, int $id): RedirectResponse
    {
        $record = Category::find($id);
        $record->update($request->validated());

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $record = Category::find($id);
        if ($record) {
            $record->delete();
        }

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
