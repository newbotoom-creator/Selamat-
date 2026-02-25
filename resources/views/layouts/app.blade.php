<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MathEngine - Tailwind Edition</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
<nav class="bg-white border-b border-gray-200 py-4 shadow-sm">
    <div class="container mx-auto px-6 flex justify-between items-center">
        <a href="{{ route('math.index') }}" class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
            MathEngine
        </a>
        <div class="space-x-4 font-medium flex items-center">
            @auth
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-gray-600 hover:text-blue-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    Dashboard
                </a>
            @endauth

            <a href="{{ route('math.index') }}" class="text-gray-600 hover:text-blue-600">Hitung</a>
            <a href="{{ route('math.report') }}" class="bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700 transition">Laporan</a>
        </div>
    </div>
</nav>

    <main class="container mx-auto px-6 py-10">
        @yield('content')
    </main>
    @include('partials.footer')
</body>
</html>