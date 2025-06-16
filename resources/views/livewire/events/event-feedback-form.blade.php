<div class="max-w-lg mx-auto p-6 bg-yellow-500 rounded shadow mt-8">
    <h2 class="text-xl font-bold mb-4">Feedback for {{ $event->name }}</h2>
    <p class="mb-4 text-black">We value your feedback! Please fill out the form below to help us improve future events.</p>
    @if ($submitted)
        <div class="mb-4 px-4 bg-white text-green-600 rounded">Thank you for your feedback!</div>
    @else
        <form wire:submit.prevent="submit">
            <div class="mb-2">
                <label class="block text-sm font-semibold" for="name">Name (optional)</label>
                <input type="text" id="name" wire:model="name" class="w-full border rounded p-2" placeholder="Your name" />
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="mb-2">
                <label class="block text-sm font-semibold" for="email">Email (optional)</label>
                <input type="email" id="email" wire:model="email" class="w-full border rounded p-2" placeholder="your@email.com" />
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="mb-2">
                <label class="block text-sm font-semibold" for="feedback">Your Feedback</label>
                <textarea id="feedback" wire:model="feedback" class="w-full border rounded p-2" rows="4" placeholder="Share your thoughts about the event..."></textarea>
                <span class="text-xs text-gray-700">Please provide at least 5 characters.</span>
                @error('feedback') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold" for="rating">Rating</label>
                <select id="rating" wire:model="rating" class="w-full border rounded p-2">
                    <option value="" disabled>Select a rating</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
                <span class="text-xs text-gray-700">1 = Poor, 5 = Excellent</span>
                @error('rating') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <button type="submit"
                class="bg-black text-white px-4 py-2 rounded"
                @if($submitted) disabled class="opacity-50 cursor-not-allowed" @endif
                wire:loading.attr="disabled">
                Submit Feedback
            </button>
        </form>
    @endif
</div>
