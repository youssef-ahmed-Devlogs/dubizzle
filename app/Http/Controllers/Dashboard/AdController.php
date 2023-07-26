<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Category;
use App\Models\DBStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ads = Ad::filter(request()->query())->latest()->paginate(5);
        return view('dashboard.ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ad = new Ad;
        $categories = Category::all();
        return view('dashboard.ads.create', compact('ad', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:10', 'max:25'],
            'description' => ['required', 'min:10', 'max:255'],
        ]);

        $formData = $request->except(['categories_ids', 'images']);

        $formData['user_id'] = Auth::id();

        $ad = Ad::create($formData);
        $ad->categories()->sync($request->categories_ids);

        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $image) {
                $path =  $image->store("ads/" . Auth::id());

                DBStorage::create([
                    'file_path' => $path,
                    'file_type' => $image->getClientOriginalExtension(),
                    'file_size' => $image->getSize() / 1024,
                    'storable_type' => Ad::class,
                    'storable_id' => $ad->id,
                ]);
            }
        }

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
