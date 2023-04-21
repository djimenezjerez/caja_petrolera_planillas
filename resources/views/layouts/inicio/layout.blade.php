<div class="min-h-screen bg-gray-100">
    @include('layouts.inicio.navigation')

    <!-- Page Heading -->
    <header class="bg-gray-50 shadow">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>
