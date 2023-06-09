<div class="min-h-screen bg-gray-100">
    @include('layouts.credencial.navigation')

    <!-- Page Heading -->
    <header class="bg-gray-50 shadow">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div>
                {{ Session::get('empresa_nombre') }}
            </div>
            {{ $header }}
        </div>
    </header>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>
