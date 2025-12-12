<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('courses')->get();
        return view('categories.index', compact('categories'));
    }

    public function courses($id)
    {
        $category = Category::findOrFail($id);
        $courses = $category->courses()->with('teacher')->get();
        return view('categories.courses', compact('category', 'courses'));
    }
}
