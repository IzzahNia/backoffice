<!-- filepath: resources/views/v2/applicationReviews/index.blade.php -->
<x-app-layout>
    <x-themed-header>
        {{ __('Application Reviews') }}
    </x-themed-header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-theme-four overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <livewire:applicationReviews.table />
                    <livewire:applicationReviews.form />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
