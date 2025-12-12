<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>@yield('title', 'CoreHouse Academy')</title>
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
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="/logo.png">
</head>

<body class="bg-gray-50">
    <!-- Navbar Enhanced with Logo Colors -->
    <nav class="bg-white shadow-lg border-b" style="border-color: var(--primary)">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <img src="/logo.png" alt="CoreHouse Academy" class="h-12 drop-shadow-lg">
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-reverse space-x-8">
                    @auth
                        <a href="{{ route('courses.index') }}"
                            class="font-semibold text-gray-700 hover:text-[var(--primary)] transition">Courses</a>
                        @unless(auth()->check() && auth()->user()->role == 'student')
                        <a href="/categories"
                            class="font-semibold text-gray-700 hover:text-[var(--primary)] transition">Categories</a>
                        @endunless
                        <a href="/tasks"
                            class="font-semibold text-gray-700 hover:text-[var(--primary)] transition">Tasks</a>
                        <a href="/leaderboard"
                            class="font-semibold text-gray-700 hover:text-[var(--primary)] transition">White hats</a>
                    @else
                        <a href="{{ route('courses.index') }}"
                            class="font-semibold text-gray-700 hover:text-[var(--primary)] transition">الكورسات</a>
                    @endauth
                </div>

                <div class="hidden md:flex items-center space-x-reverse space-x-4">
                    @auth
                        @if (auth()->user()->role == 'admin')
                            <a href="/admin/users"
                                class="font-semibold text-gray-700 hover:text-[var(--primary)] transition">Admin Panel</a>
                        @elseif(auth()->user()->role == 'teacher')
                            <a href="/teacher/dashboard"
                                class="font-semibold text-gray-700 hover:text-[var(--primary)] transition">Teacher Panel</a>
                        @else
                            <a href="{{ route('dashboard') }}"
                                class="font-semibold text-gray-700 hover:text-[var(--primary)] transition">Dashboard</a>
                        @endif

                        <div class="flex items-center gap-3 bg-gray-50 px-4 py-2 rounded-full shadow-sm border"
                            style="border-color: var(--secondary)">
                            <span class="flex items-center gap-2 text-gray-800 font-medium">
                                <i class="fa-solid fa-user-circle text-2xl" style="color: var(--primary)"></i>
                                <span>{{ auth()->user()->name }}</span>
                            </span>

                            <a href="/profile" class="text-gray-600 hover:text-[var(--primary)] transition p-1"
                                aria-label="Profile">
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>

                            <form method="POST" action="/logout" class="inline">
                                @csrf
                                <button class="text-red-500 hover:text-red-600 transition p-1" aria-label="Logout">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('registration.create') }}"
                            class="bg-primary text-white px-4 py-2 rounded-md hover:bg-opacity-90 transition font-semibold">اشترك الآن</a>
                        <a href="/login"
                            class="font-semibold text-gray-700 hover:text-[var(--primary)] transition">تسجيل الدخول</a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-700 hover:text-[var(--primary)] focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                @auth
                    <a href="{{ route('courses.index') }}"
                        class="block px-4 py-2 font-semibold text-gray-700 hover:text-[var(--primary)] transition">Courses</a>
                    @unless(auth()->check() && auth()->user()->role == 'student')
                    <a href="/categories"
                        class="block px-4 py-2 font-semibold text-gray-700 hover:text-[var(--primary)] transition">Categories</a>
                    @endunless
                    <a href="/tasks"
                        class="block px-4 py-2 font-semibold text-gray-700 hover:text-[var(--primary)] transition">Tasks</a>
                    <a href="/leaderboard"
                        class="block px-4 py-2 font-semibold text-gray-700 hover:text-[var(--primary)] transition">White hats</a>
                    
                    @if (auth()->user()->role == 'admin')
                        <a href="/admin/users"
                            class="block px-4 py-2 font-semibold text-gray-700 hover:text-[var(--primary)] transition">Admin Panel</a>
                    @elseif(auth()->user()->role == 'teacher')
                        <a href="/teacher/dashboard"
                            class="block px-4 py-2 font-semibold text-gray-700 hover:text-[var(--primary)] transition">Teacher Panel</a>
                    @else
                        <a href="{{ route('dashboard') }}"
                            class="block px-4 py-2 font-semibold text-gray-700 hover:text-[var(--primary)] transition">Dashboard</a>
                    @endif
                    
                    <a href="/profile" class="block px-4 py-2 font-semibold text-gray-700 hover:text-[var(--primary)] transition">Profile</a>
                    
                    <form method="POST" action="/logout" class="px-4 py-2">
                        @csrf
                        <button class="text-red-500 hover:text-red-600 transition font-semibold">Logout</button>
                    </form>
                @else
                    <a href="{{ route('courses.index') }}"
                        class="block px-4 py-2 font-semibold text-gray-700 hover:text-[var(--primary)] transition">الكورسات</a>
                    <a href="{{ route('registration.create') }}"
                        class="block px-4 py-2 bg-primary text-white font-semibold rounded-md mx-4 text-center">اشترك الآن</a>
                    <a href="/login"
                        class="block px-4 py-2 font-semibold text-gray-700 hover:text-[var(--primary)] transition">تسجيل الدخول</a>
                @endauth
            </div>
        </div>
    </nav>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Logo & Description -->
                <div class="md:col-span-2">
                    <img src="/logo.png" alt="CoreHouse Academy" class="h-16 mb-4">
                    <p class="text-gray-300 mb-4 leading-relaxed">
                        أكاديمية CoreHouse - وجهتك الأولى لتعلم البرمجة والتكنولوجيا. نقدم دورات احترافية وتدريب عملي لإعدادك لسوق العمل.
                    </p>
                    <div class="flex space-x-4 space-x-reverse">
                        <a href="https://www.facebook.com/share/17q8bgs9no/" target="_blank" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-bold mb-4">روابط سريعة</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('courses.index') }}" class="text-gray-300 hover:text-white transition">الدورات</a></li>
                        <li><a href="#about" class="text-gray-300 hover:text-white transition">من نحن</a></li>
                        <li><a href="/leaderboard" class="text-gray-300 hover:text-white transition">المتصدرين</a></li>
                        <li><a href="{{ route('registration.create') }}" class="text-gray-300 hover:text-white transition">التسجيل</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-bold mb-4">تواصل معنا</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li class="flex items-center gap-2">
                            <i class="fas fa-envelope" style="color: #f4a51c"></i>
                            <span>core.house.acedemay@gmail.com</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-phone" style="color: #f4a51c"></i>
                            <span>+20 15 56380869</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-map-marker-alt" style="color: #f4a51c"></i>
                            <span> الغربيه -سمنود</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-400">
               
                    <span style="color: #f4a51c">صُنع بـ ❤️ من فريق CoreHouse</span>
                         &copy;   
                </p>
            </div>
        </div>
    </footer>
</body>

</html>
