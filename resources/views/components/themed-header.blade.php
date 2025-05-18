{{-- filepath: resources/views/components/themed-header.blade.php --}}
<div {{ $attributes->merge(['class' => 'bg-black border-b shadow']) }}>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ $slot }}
        </h2>
    </div>
</div>
