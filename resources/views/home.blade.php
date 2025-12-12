@extends('layouts.app')

@section('title', 'الرئيسية - أكاديمية CoreHouse')

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">

    <style>
        /* إعدادات المتغيرات والخطوط */


             :root {
            --primary: #f4a51c;
            /* برتقالي */
            --secondary: #0c7b78;
            /* تركواز */
            --dark: #0f1e2e;
            /* كحلي غامق */
            --light: #f8f9fa;
        }

        body {
            font-family: 'Cairo', sans-serif;
            direction: rtl;
            text-align: right;
            background-color: #fdfdfd;
            overflow-x: hidden;
        }

        /* تأثيرات النصوص والعناصر */
        .text-gradient {
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-bg {
            background: url('/home.png');
            position: relative;
        }
        
        .hero-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(2px);
            z-index: 1;
        }

        /* تأثير الزجاج */
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 10px 30px rgba(12, 123, 120, 0.08);
        }

        /* أزرار بتأثير جذاب */
        .btn-wow {
            background: linear-gradient(45deg, var(--secondary), #0e938f);
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(12, 123, 120, 0.3);
        }

        .btn-wow:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(12, 123, 120, 0.5);
            color: white;
        }

        /* أنيميشن بسيط للكروت */
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1) !important;
        }

        /* دائرة زخرفية خلف الصورة */
        .blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: var(--primary);
            opacity: 0.1;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
        }
    </style>

    <div class="hero-bg relative py-32 overflow-hidden min-h-screen flex items-center">
        <div class="blob" style="top: -100px; left: -100px;"></div>
        <div class="blob" style="bottom: -100px; right: -100px; background: var(--secondary);"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full border border-white/30 mb-6">
                <i class="fas fa-rocket text-primary animate-bounce"></i>
                <p class="text-sm text-gray-700 font-medium">مرحباً بك في عالم التعلم المتقدم</p>
            </div>
            <h1 class="text-5xl lg:text-7xl font-black mb-8 leading-tight">
                <span class="text-gray-900 drop-shadow-lg">تعلم</span> 
                <span style="background: linear-gradient(135deg, #f4a51c, #ff6b35); -webkit-background-clip: text; -webkit-text-fill-color: transparent; filter: drop-shadow(0 4px 8px rgba(244, 165, 28, 0.3)); animation: pulse 2s infinite;">بذكاء</span><span class="text-gray-900 drop-shadow-lg">،</span><br>
                <span class="text-gray-900 drop-shadow-lg">ليس بصعوبة</span>
            </h1>
            <p class="text-xl text-gray-700 mb-12 leading-relaxed max-w-2xl mx-auto font-medium bg-white/10 backdrop-blur-sm p-6 rounded-2xl border border-white/20">
                انضم إلى أكاديمية <span class="font-bold text-primary">CoreHouse</span> واكتسب المهارات التقنية المطلوبة عالمياً مع خبراء متخصصين ومنهج عملي متطور.
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('courses.index') }}"
                    class="btn-wow px-8 py-4 rounded-full text-lg font-bold flex items-center gap-2">
                    <span>ابدأ الان</span>
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">لماذا تختار <span
                        style="color:var(--secondary)">CoreHouse</span>؟</h2>
                <p class="text-gray-500 max-w-2xl mx-auto">نحن لا نقدم مجرد دورات، بل نقدم تجربة تعليمية متكاملة تضمن لك
                    الوصول إلى الاحتراف.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="hover-lift bg-white p-8 rounded-2xl border border-gray-100 shadow-lg text-center group">
                    <div class="w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-6 transition-colors group-hover:scale-110 duration-300"
                        style="background: rgba(244, 165, 28, 0.1); color: var(--primary);">
                        <i class="fas fa-laptop-code text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800">محتوى عملي 100%</h3>
                    <p class="text-gray-600 leading-relaxed">انسَ النظريات المملة. دوراتنا تركز على التطبيق العملي وبناء
                        مشاريع حقيقية تضعها في سيرتك الذاتية.</p>
                </div>

                <div class="hover-lift bg-white p-8 rounded-2xl border border-gray-100 shadow-lg text-center group">
                    <div class="w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-6 transition-colors group-hover:scale-110 duration-300"
                        style="background: rgba(12, 123, 120, 0.1); color: var(--secondary);">
                        <i class="fas fa-building text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800">تدريب عملي حقيقي</h3>
                    <p class="text-gray-600 leading-relaxed">احصل على فرصة التدريب العملي داخل شركتنا واكتسب خبرة حقيقية في بيئة عمل احترافية مع مشاريع فعلية.</p>
                </div>

                <div class="hover-lift bg-white p-8 rounded-2xl border border-gray-100 shadow-lg text-center group">
                    <div class="w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-6 transition-colors group-hover:scale-110 duration-300"
                        style="background: rgba(244, 165, 28, 0.1); color: var(--primary);">
                        <i class="fas fa-certificate text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800">شهادات قوية</h3>
                    <p class="text-gray-600 leading-relaxed">احصل على شهادة إتمام موثقة عند الانتهاء من المسار التعليمي
                        لتعزيز فرصك الوظيفية.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- من نحن -->
    <div id="about" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-4xl font-bold mb-6 text-gray-900">من نحن؟</h2>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        نحن شركة <span style="color: var(--primary); font-weight: bold;">CoreHouse</span> للبرمجة، شركة متخصصة في تصميم وتطوير المواقع الإلكترونية والحلول البرمجية المتقدمة. نقدم خدمات شاملة تشمل تطوير التطبيقات، أنظمة إدارة المحتوى، والحلول التقنية المخصصة للشركات.
                    </p>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        بالإضافة إلى خدماتنا البرمجية، أطلقنا <span style="color: var(--secondary); font-weight: bold;">أكاديمية CoreHouse</span> لنشر المعرفة التقنية وتدريب الجيل القادم من المطورين والمبرمجين على أحدث التقنيات والممارسات في عالم البرمجة.
                    </p>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center p-4 bg-white rounded-lg shadow-sm">
                            <h3 class="text-2xl font-bold" style="color: var(--primary)">+100</h3>
                            <p class="text-sm text-gray-500">مشروع منجز</p>
                        </div>
                        <div class="text-center p-4 bg-white rounded-lg shadow-sm">
                            <h3 class="text-2xl font-bold" style="color: var(--secondary)">+5</h3>
                            <p class="text-sm text-gray-500">سنوات خبرة</p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="فريق العمل" class="rounded-2xl shadow-xl w-full">
                </div>
            </div>
        </div>
    </div>

    <div class="py-20 relative overflow-hidden text-center text-white" style="background: var(--dark);">
        <div class="absolute inset-0 opacity-20"
            style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
        </div>

        <div class="max-w-4xl mx-auto px-4 relative z-10">
            <img src="logo.png" alt="CoreHouse Logo" class="mx-auto mb-6" style="width:160px; height:auto;">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">هل أنت مستعد لتغيير مستقبلك؟</h2>
            <p class="text-xl text-gray-300 mb-10">انضم لأكثر من 500 طالب بدأوا رحلتهم نحو الاحتراف معنا.</p>
            <a href="{{ route('registration.create') }}"
                class="inline-block px-10 py-4 bg-white text-gray-900 font-bold rounded-full text-lg shadow-xl hover:bg-gray-100 hover:scale-105 transition transform">
                سجل الآن مجاناً
            </a>
        </div>
    </div>

@endsection
