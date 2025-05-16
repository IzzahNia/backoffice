<div>
    @if($showModal)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen">
                <div class="fixed inset-0 bg-black opacity-50" wire:click="hide"></div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 w-full max-w-md z-20" onclick="event.stopPropagation();">
                    <h3 class="text-lg font-bold mb-4">
                        {{ $mode === 'edit' ? 'Edit Application' : 'Create Application' }}
                    </h3>
                    <form wire:submit.prevent="save">
                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-200">Title</label>
                            <input type="text" wire:model.defer="title"
                                class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100" />
                            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-200">Description</label>
                            <textarea wire:model.defer="description"
                                class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"></textarea>
                            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-200">Event</label>
                            <select wire:model.defer="event_id"
                                class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                <option value="">No Event</option>
                                @foreach($events as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('event_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-200">Type</label>
                            <select wire:model.defer="type"
                                class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                <option value="">Select Type</option>
                                <option value="user">User</option>
                                <option value="vendor">Vendor</option>
                                <option value="collaborator">Collaborator</option>
                                <option value="event">Event</option>
                                <option value="crew">Crew</option>
                            </select>
                            @error('type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-200">Status</label>
                            <select wire:model.defer="status"
                                class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                            @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex justify-end">
                            <button type="button" wire:click="hide" class="mr-2 px-4 py-2 rounded bg-gray-300 dark:bg-gray-600">Cancel</button>
                            <button type="submit" class="px-4 py-2 rounded bg-blue-500 text-white">
                                {{ $mode === 'edit' ? 'Update' : 'Save' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
