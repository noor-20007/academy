<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('teacher', 'category')->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.courses.create', compact('categories', 'teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'teacher_id' => 'required|exists:users,id',
            'thumbnail' => 'nullable|string',
            'roadmap_levels' => 'nullable|array',
            'roadmap_levels.*' => 'nullable|string|max:500',
        ]);

        // Handle thumbnail: URLs are stored as-is; only base64 is processed
        if (!empty($validated['thumbnail']) && strpos($validated['thumbnail'], 'data:image') === 0) {
            $validated['thumbnail'] = $this->saveThumbnail($validated['thumbnail']);
        }

        // Convert roadmap_levels array into roadmap JSON format
        $roadmap = [];
        if ($request->has('roadmap_levels') && is_array($request->roadmap_levels)) {
            foreach ($request->roadmap_levels as $index => $level) {
                if (!empty($level)) {
                    $roadmap[] = [
                        'level' => $index + 1,
                        'title' => $level,
                        'description' => '',
                    ];
                }
            }
        }
        $validated['roadmap'] = !empty($roadmap) ? $roadmap : null;

        Course::create($validated);
        return redirect('/admin/courses');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $categories = Category::all();
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.courses.edit', compact('course', 'categories', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'teacher_id' => 'required|exists:users,id',
            'thumbnail' => 'nullable|string',
            'roadmap_levels' => 'nullable|array',
            'roadmap_levels.*' => 'nullable|string|max:500',
        ]);

        // Handle thumbnail: URLs are stored as-is; only base64 is processed
        if (!empty($validated['thumbnail']) && strpos($validated['thumbnail'], 'data:image') === 0) {
            $validated['thumbnail'] = $this->saveThumbnail($validated['thumbnail']);
        }

        // Convert roadmap_levels array into roadmap JSON format
        $roadmap = [];
        if ($request->has('roadmap_levels') && is_array($request->roadmap_levels)) {
            foreach ($request->roadmap_levels as $index => $level) {
                if (!empty($level)) {
                    $roadmap[] = [
                        'level' => $index + 1,
                        'title' => $level,
                        'description' => '',
                    ];
                }
            }
        }
        $validated['roadmap'] = !empty($roadmap) ? $roadmap : null;

        $course->update($validated);
        return redirect('/admin/courses');
    }

    public function destroy($id)
    {
        Course::findOrFail($id)->delete();
        return redirect('/admin/courses');
    }

    /**
     * Save base64 thumbnail to storage and return the path
     */
    private function saveThumbnail($base64Data)
    {
        try {
            // Extract the file extension from the base64 header
            if (preg_match('/data:image\/(\w+);base64,/', $base64Data, $matches)) {
                $extension = $matches[1];
            } else {
                $extension = 'jpg'; // Default to jpg if we can't parse
            }

            // Generate a unique filename
            $filename = 'thumbnails/' . uniqid() . '.' . $extension;

            // Decode base64 data
            $imageData = base64_decode(explode(',', $base64Data)[1]);

            // Save to storage
            \Illuminate\Support\Facades\Storage::disk('public')->put($filename, $imageData);

            // Return the path
            return '/storage/' . $filename;
        } catch (\Exception $e) {
            // If something goes wrong, return null to avoid breaking the update
            return null;
        }
    }
}
