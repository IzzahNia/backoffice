{{-- filepath: resources/views/livewire/events/form.blade.php --}}
<div>
    @if($showModal)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen">
                <!-- Backdrop -->
                <div
                    class="fixed inset-0 bg-black opacity-50"
                    wire:click="hide"
                ></div>
                <!-- Modal Content -->
                <div
                    class="bg-theme-four border-theme-secondary rounded shadow-lg p-8 w-full max-w-md z-20 text-white"
                    onclick="event.stopPropagation();"
                >
                    <h3 class="text-lg font-bold mb-4">
                        {{ $mode === 'edit' ? 'Edit Event' : 'Create Event' }}
                    </h3>
                    <form wire:submit.prevent="save">
                        <div class="mb-4">
                            <label class="block theme-secondary">Name</label>
                            <input
                                type="text"
                                wire:model.defer="name"
                                class="w-full border rounded px-3 py-2 bg-theme-four text-black placeholder-gray-500"
                                placeholder="Event Name"
                            />
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block theme-secondary">Start Time</label>
                            <input
                                type="datetime-local"
                                wire:model.defer="start_time"
                                class="w-full border rounded px-3 py-2 bg-theme-four text-black"
                            />
                            @error('start_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block theme-secondary">End Time</label>
                            <input
                                type="datetime-local"
                                wire:model.defer="end_time"
                                class="w-full border rounded px-3 py-2 bg-theme-four text-black"
                            />
                            @error('end_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block theme-secondary">Location</label>
                            <input
                                type="text"
                                wire:model.defer="location"
                                class="w-full border rounded px-3 py-2 bg-theme-four text-black placeholder-gray-500"
                                placeholder="Event Location"
                            />
                            @error('location') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block theme-secondary">Description</label>
                            <textarea
                                wire:model.defer="description"
                                class="w-full border rounded px-3 py-2 bg-theme-four text-black placeholder-gray-500"
                                placeholder="Event Description"
                            ></textarea>
                            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block theme-secondary">Type</label>
                            <select
                                wire:model.defer="type"
                                class="w-full border rounded px-3 py-2 bg-theme-four text-black"
                            >
                                <option value="">Select Type</option>
                                @foreach($types as $eventType)
                                    <option value="{{ $eventType->value }}">{{ ucfirst($eventType->value) }}</option>
                                @endforeach
                            </select>
                            @error('type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4 flex items-center">
                            <input
                                type="checkbox"
                                wire:model.defer="is_verified"
                                id="is_verified"
                                class="mr-2"
                            />
                            <label for="is_verified" class="theme-secondary">Verified</label>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" wire:click="hide" class="mr-2 px-4 py-2 rounded bg-gray-300 text-black">Cancel</button>
                            <button type="submit" class="px-4 py-2 rounded bg-blue-500 text-white font-semibold">
                                {{ $mode === 'edit' ? 'Update' : 'Save' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
