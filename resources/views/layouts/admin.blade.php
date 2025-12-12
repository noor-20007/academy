<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة الإدارة')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FF6B35',
                        secondary: '#004E89',
                        accent: '#F7931E'
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="/logo.png">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="/logo.png">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="flex h-screen">
        <aside class="w-64 bg-secondary text-white">
            <div class="p-4">
                <img src="/logo.png" alt="CoreHouse Academy" class="h-12 mb-8">
            </div>
            <nav class="space-y-2 px-4">
                <a href="/admin/users"
                    class="block px-4 py-3 rounded hover:bg-white hover:bg-opacity-10 {{ request()->is('admin/users*') ? 'bg-white bg-opacity-20' : '' }}"><i
                        class="fas fa-users ml-2"></i> المستخدمين</a>
                <a href="/admin/courses"
                    class="block px-4 py-3 rounded hover:bg-white hover:bg-opacity-10 {{ request()->is('admin/courses*') ? 'bg-white bg-opacity-20' : '' }}"><i
                        class="fas fa-book ml-2"></i> الكورسات</a>
                <a href="/admin/categories"
                    class="block px-4 py-3 rounded hover:bg-white hover:bg-opacity-10 {{ request()->is('admin/categories*') ? 'bg-white bg-opacity-20' : '' }}"><i
                        class="fas fa-folder ml-2"></i> التصنيفات</a>
                <a href="/admin/lessons"
                    class="block px-4 py-3 rounded hover:bg-white hover:bg-opacity-10 {{ request()->is('admin/lessons*') ? 'bg-white bg-opacity-20' : '' }}"><i
                        class="fas fa-video ml-2"></i> الدروس</a>
                <a href="/admin/tasks"
                    class="block px-4 py-3 rounded hover:bg-white hover:bg-opacity-10 {{ request()->is('admin/tasks*') ? 'bg-white bg-opacity-20' : '' }}"><i
                        class="fas fa-tasks ml-2"></i> المهام</a>
                <a href="{{ route('admin.registration-requests.index') }}"
                    class="block px-4 py-3 rounded hover:bg-white hover:bg-opacity-10 {{ request()->is('admin/registration-requests*') ? 'bg-white bg-opacity-20' : '' }}"><i
                        class="fas fa-user-plus ml-2"></i> طلبات التسجيل</a>
                <a href="/" class="block px-4 py-3 rounded hover:bg-white hover:bg-opacity-10"><i
                        class="fas fa-home ml-2"></i> الموقع</a>
            </nav>
        </aside>

        <div class="flex-1 overflow-auto">
            <header class="bg-white shadow-sm p-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold">@yield('header', 'لوحة الإدارة')</h1>
                    <form method="POST" action="/logout">
                        @csrf
                        <button class="text-red-600 hover:text-red-700">تسجيل خروج</button>
                    </form>
                </div>
            </header>

            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
