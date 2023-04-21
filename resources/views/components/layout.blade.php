<div class="min-h-screen bg-gray-100">
    <x-navigation />

    <!-- Page Heading -->
    @if(isset($header))
        <header class="bg-gray-50 shadow">
            <div class="max-w-7xl mx-auto 46 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $header }}
                </h2>
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>
