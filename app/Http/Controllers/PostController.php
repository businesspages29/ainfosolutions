<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home(): View
    {
        $perPage = 12;
        $records = Post::latest()->paginate($perPage);

        return view('home', compact('records'));
    }

    /**
     * Display a listing of the resource.
     */
    public function details(string $slug): View
    {
        $record = Post::where('slug', $slug)->first();

        return view('details', compact('record'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $perPage = 10;
        $records = Post::latest()->paginate($perPage);

        return view('posts.index', compact('records'))
            ->with('i', (request()->input('page', 1) - 1) * $perPage);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::pluck('name', 'id');
        $statuses = PostStatus::options();

        return view('posts.edit', compact('categories', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request): RedirectResponse
    {
        $inputs = $request->validated();
        $inputs['user_id'] = Auth::id();
        if ($request->hasFile('image')) {
            $inputs['image'] = $request->file('image')->store('posts', 'public');
        }
        Post::create($inputs);

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): View
    {
        $record = Post::find($id);

        return view('posts.show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $record = Post::find($id);
        $categories = Category::pluck('name', 'id');
        $statuses = PostStatus::options();

        return view('posts.edit', compact('record', 'categories', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, int $id): RedirectResponse
    {
        $record = Post::find($id);
        $inputs = $request->validated();
        $inputs['user_id'] = Auth::id();
        if ($request->hasFile('image')) {
            if ($record->image) {
                Storage::disk('public')->delete($record->image);
            }
            $inputs['image'] = $request->file('image')->store('posts', 'public');
        }

        $record->update($inputs);

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $record = Post::find($id);
        if ($record) {
            if ($record->image) {
                Storage::disk('public')->delete($record->image);
            }
            $record->delete();
        }

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully');
    }
}
