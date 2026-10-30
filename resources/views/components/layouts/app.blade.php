@props([
    'title' => 'Overview',
    'heading' => null,
])

@php($heading = $heading ?? $title)

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aurelia — a premium, minimal dashboard template built with Laravel, Tailwind CSS and ApexCharts.">
    <meta name="theme-color" content="#f4f4f0" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#08080a" media="(prefers-color-scheme: dark)">

    <title>{{ $title }} · Aurelia</title>

    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='16' fill='%23111114'/%3E%3Ctext x='32' y='46' font-family='Georgia,serif' font-size='42' font-style='italic' fill='%23ffffff' text-anchor='middle'%3Ea%3C/text%3E%3C/svg%3E">

    <script>
        (() => {
            const saved = localStorage.getItem('aurelia-theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const dark = saved === 'dark' || ((!saved || saved === 'system') && prefersDark);

            document.documentElement.classList.toggle('dark', dark);
            document.documentElement.style.colorScheme = dark ? 'dark' : 'light';
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-canvas text-ink antialiased">
    <div id="sidebar-overlay" class="fixed inset-0 z-40 hidden bg-black/40 backdrop-blur-[2px] lg:hidden"></div>

    <x-sidebar />

    <div class="min-h-screen lg:pl-[276px]">
        <x-topbar :heading="$heading" />

        <main class="px-4 pb-4 pt-0 sm:px-6 lg:px-8">
            <div class="mx-auto w-full max-w-[1440px]">
                {{ $slot }}
            </div>
        </main>

        <footer class="mt-2 border-t border-line px-4 py-6 sm:px-6 lg:px-8">
            <div class="mx-auto flex max-w-[1440px] flex-col gap-3 text-xs text-faint sm:flex-row sm:items-center sm:justify-between">
                <p>© {{ date('Y') }} Aurelia Studio. A premium dashboard template.</p>

                <div class="flex flex-wrap items-center gap-x-5 gap-y-2">
                    <a href="#" class="transition hover:text-ink">Documentation</a>
                    <a href="#" class="transition hover:text-ink">Support</a>
                    <span class="inline-flex items-center gap-1.5">
                        <span class="size-1.5 rounded-full bg-positive"></span>
                        All systems operational
                    </span>
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
