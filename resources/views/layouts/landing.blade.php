<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SIMS - La solució integral per a la gestió d'inventari i empreses. Optimitza el teu negoci amb el nostre programari avançat.">
    
    <title>@yield('title', 'SIMS - Gestió Empresarial')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --secondary: #94a3b8;
            --dark: #0f172a;
            --light: #f8fafc;
            --glass: rgba(255, 255, 255, 0.7);
            --glass-dark: rgba(15, 23, 42, 0.8);
        }

        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }

        h1, h2, h3, .font-display {
            font-family: 'Outfit', sans-serif;
        }

        .glass-nav {
            background: var(--glass);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .gradient-text {
            background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-gradient {
            background: radial-gradient(circle at top right, rgba(59, 130, 246, 0.1) 0%, transparent 40%),
                        radial-gradient(circle at bottom left, rgba(6, 182, 212, 0.05) 0%, transparent 40%);
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .animate-float {
            animation: float 4s ease-in-out infinite;
        }
    </style>
</head>
<body class="antialiased bg-white text-slate-900 hero-gradient">
    <nav class="fixed top-0 w-full z-50 glass-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200">
                        <span class="text-white font-bold text-xl">S</span>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-slate-900 font-display">SIMS</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Features</a>
                    <a href="#stats" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Statistics</a>
                    <a href="http://localhost:5173" class="inline-flex items-center px-6 py-2.5 rounded-full bg-blue-600 text-white text-sm font-semibold hover:bg-indigo-700 transition-all shadow-md hover:shadow-lg active:scale-95">
                        Go to App
                    </a>
                </div>

                <!-- Mobile menu button can be added here if needed -->
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-slate-950 text-slate-400 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">S</span>
                        </div>
                        <span class="text-xl font-bold text-white font-display">SIMS</span>
                    </div>
                    <p class="max-w-xs mb-6">
                        The ultimate business management platform for SMEs and freelancers. Power and simplicity in one place.
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Product</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-indigo-400">Features</a></li>
                        <li><a href="#" class="hover:text-indigo-400">Pricing</a></li>
                        <li><a href="#" class="hover:text-indigo-400">API</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-indigo-400">Documentation</a></li>
                        <li><a href="#" class="hover:text-indigo-400">Contact</a></li>
                        <li><a href="#" class="hover:text-indigo-400">Privacy</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-900 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs">
                <p>&copy; {{ date('Y') }} SIMS Management. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-white">Twitter</a>
                    <a href="#" class="hover:text-white">LinkedIn</a>
                    <a href="#" class="hover:text-white">GitHub</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
