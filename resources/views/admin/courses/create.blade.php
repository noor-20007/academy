@extends('layouts.admin')

@section('title', 'إضافة كورس')
@section('header', 'إضافة كورس جديد')

@section('content')
<div class="max-w-2xl mx-auto mt-8">
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="/admin/courses">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">العنوان</label>
                <input type="text" name="title" required class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">الوصف</label>
                <textarea name="description" required rows="4" class="w-full px-4 py-2 border rounded-lg"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">التصنيف</label>
                <select name="category_id" required class="w-full px-4 py-2 border rounded-lg">
                    <option value="">اختر التصنيف</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">المدرس</label>
                <select name="teacher_id" required class="w-full px-4 py-2 border rounded-lg">
                    <option value="">اختر المدرس</option>
                    @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">رابط الصورة</label>
                <input type="text" name="thumbnail" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">خريطة المسار (الأقسام)</label>
                <div id="roadmap-container" class="space-y-3">
                    <!-- Levels will be added here dynamically -->
                </div>
                <button type="button" class="mt-3 text-sm text-indigo-600 hover:text-indigo-700 font-medium" onclick="addRoadmapLevel()">+ إضافة مستوى</button>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded">حفظ</button>
                <a href="/admin/courses" class="bg-gray-300 text-gray-700 px-6 py-2 rounded">إلغاء</a>
            </div>
        </form>
    </div>
</div>

<script>
let roadmapCount = 0;

function addRoadmapLevel() {
    roadmapCount++;
    const container = document.getElementById('roadmap-container');
    const levelIndex = container.children.length + 1;

    const levelHtml = `
        <div class="roadmap-level flex items-center gap-3 bg-gray-50 p-4 rounded-lg">
            <div class="flex-1">
                <label class="block text-sm text-gray-600 mb-1">مستوى ${levelIndex}</label>
                <input type="text" name="roadmap_levels[]" placeholder="أدخل اسم المستوى" class="w-full px-3 py-2 border rounded-lg text-sm">
            </div>
            <button type="button" class="mt-6 text-red-600 hover:text-red-700 font-medium text-sm" onclick="removeRoadmapLevel(this)">حذف</button>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', levelHtml);
}

function removeRoadmapLevel(btn) {
    btn.closest('.roadmap-level').remove();
}

// Initialize with one empty level
document.addEventListener('DOMContentLoaded', function() {
    addRoadmapLevel();
});
</script>

@endsection
