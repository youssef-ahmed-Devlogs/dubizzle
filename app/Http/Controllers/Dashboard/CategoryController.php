<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::filter(request()->query())->latest()->paginate(5);
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category;
        $categories = Category::where('parent_id', '=', null)->get();
        return view('dashboard.categories.create', compact('category', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formData = $request->validate([
            'name' => ['required', 'unique:categories,name', 'string', 'min:2', 'max:255'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'cover' => ['nullable', 'image', 'max:2048'],
            'order' => ['nullable', 'numeric'],
            'description' => ['nullable', 'string', 'max:2000'],
        ]);

        if ($request->hasFile('cover')) {
            $formData['cover'] = $request->file('cover')->store('categories');
        }

        $formData['created_by'] = Auth::id();
        $formData['slug'] = Str::slug($formData['name']);
        Category::create($formData);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categoryIsParent = Category::where('parent_id', $category->id)->count();
        $categories = Category::where('id', '!=', $category->id)->where('parent_id', '=', null)->get();
        return view('dashboard.categories.edit', compact('category', 'categoryIsParent', 'categories',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $formData = $request->validate([
            'name' => ['required', "unique:categories,name,$category->id", 'string', 'min:2', 'max:255'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'cover' => ['nullable', 'image', 'max:2048'],
            'order' => ['nullable', 'numeric'],
            'description' => ['nullable', 'string', 'max:2000'],
        ]);

        if ($request->hasFile('cover')) {
            $this->deleteCover($category);
            $formData['cover'] = $request->file('cover')->store('categories');
        }

        $formData['created_by'] = Auth::id();
        $formData['slug'] = Str::slug($formData['name']);
        $category->update($formData);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->deleteCover($category);
        $category->delete();
        return back();
    }

    private function deleteCover($category)
    {
        if ($category->cover && Storage::exists($category->cover))
            Storage::delete($category->cover);
    }
}
