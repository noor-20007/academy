<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - CoreHouse Academy</title>
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
        body { font-family: 'Cairo', sans-serif; }
        .gradient-bg {
            background: url('/home.png') center/cover no-repeat;
            position: relative;
        }
        .gradient-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(3px);
        }
        .input-focus:focus {
            border-color: #FF6B35;
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        }
        .btn-hover {
            transition: all 0.3s ease;
        }
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 107, 53, 0.3);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center px-4">
    <div class="max-w-md w-full relative z-10">
        <div class="bg-white rounded-2xl shadow-2xl p-8 transform transition-all hover:scale-105 duration-300">
            <div class="text-center mb-8">
                <img src="/logo.png" alt="CoreHouse Academy" class="h-20 mx-auto mb-4">
                <h1 class="text-3xl font-bold text-secondary mb-2">مرحبا بك مجدداً</h1>
                <p class="text-gray-600">سجل دخولك للمتابعة</p>
            </div>
            
            <form method="POST" action="/login" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-envelope text-primary ml-2"></i>
                        البريد الإلكتروني
                    </label>
                    <input type="email" name="email" required 
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none input-focus transition-all">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-lock text-primary ml-2"></i>
                        كلمة المرور
                    </label>
                    <input type="password" name="password" required 
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none input-focus transition-all">
                </div>

                <button type="submit" 
                        class="w-full bg-gradient-to-r from-primary to-accent text-white py-4 rounded-lg font-bold text-lg btn-hover">
                    <i class="fas fa-sign-in-alt ml-2"></i>
                    تسجيل الدخول
                </button>
            </form>

            <div class="mt-6 text-center">
                <div class="flex items-center justify-center space-x-reverse space-x-2 text-gray-500">
                    <i class="fas fa-shield-alt text-primary"></i>
                    <span class="text-sm">منصة آمنة وموثوقة</span>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-6">
            <p class="text-white text-sm">
                &copy; 2025 CoreHouse Academy. جميع الحقوق محفوظة
            </p>
        </div>
    </div>
</body>
</html>
