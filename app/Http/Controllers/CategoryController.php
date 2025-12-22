<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate(['name' => 'required|string|unique:categories,name']);

            $category = Category::create(['name' => $request->name]);

            return response()->json($category, 200);
        } catch (\Exception $e) {
            return response()->json('Error - ' . $e->getMessage(), 500);
        }
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
    public function update(Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);

            $request->validate([
                // unique:table,column,except,idColumn
                'name' => 'required|string|unique:categories,name,' . $id
            ]);

            $category->update(['name' => $request->name]);

            return response()->json($category, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->errors()['name'][0], 422);
        } catch (\Exception $e) {
            return response()->json('Error - ' . $e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);

            // Check if the category is being used in any blogs
            // This assumes your Category model has a 'blogs' relationship
            if ($category->blogs()->exists()) {
                return response()->json('Cannot delete: This category is currently assigned to one or more blogs.', 422);
            }

            $category->delete();

            return response()->json(['message' => 'Category deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json('Error - ' . $e->getMessage(), 500);
        }
    }
}
