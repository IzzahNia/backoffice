<div>
    <div>
        <div class="p-4 mt-4">
            <button onclick="openModal()" class="bg-blue-500 text-white px-4 py-2 rounded-md">Create Event</button>
        </div>

        @if ($errors->any())
            <div class="p-4 mt-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Modal -->
                    <div id="createEventModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-1/3">
                            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Create Event
                                </h3>
                            </div>
                            <div class="p-6">
                                <form wire:submit.prevent="create" id="createEventForm">
                                    <div class="mb-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                        <input type="text" id="name" name="name" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                    </div>
                                    <div class="mb-4">
                                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                        <textarea id="description" name="description" wire:model="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Time</label>
                                        <input type="datetime-local" id="start_time" name="start_time" wire:model="start_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                    </div>
                                    <div class="mb-4">
                                        <label for="end_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Time</label>
                                        <input type="datetime-local" id="end_time" name="end_time" wire:model="end_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                    </div>
                                    <div class="mb-4">
                                        <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                                        <input type="text" id="location" name="location" wire:model="location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                    </div>
                                    {{-- TODO: just for admin only --}}
                                    <div class="mb-4">
                                        <label for="is_verified" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Is Verified</label>
                                        <input type="checkbox" id="is_verified" name="is_verified" wire:model="is_verified" class="mt-1">
                                    </div>
                                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end">
                                        <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2">
                                            Cancel
                                        </button>
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                                            Create
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table class="min-w-full divide-y divide-gray-300">
            <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Start Time
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        End Time
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Location
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Is Verified
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr class="hover:bg-gray-300 dark:bg-gray-800 divide-y divide-gray-200">
                        <td class="px-6 py-3 text-center text-xs">{{ $event->name }}</td>
                        <td class="px-6 py-3 text-center text-xs">{{ $event->description }}</td>
                        <td class="px-6 py-3 text-center text-xs">{{ $event->start_time }}</td>
                        <td class="px-6 py-3 text-center text-xs">{{ $event->end_time }}</td>
                        <td class="px-6 py-3 text-center text-xs">{{ $event->location }}</td>
                        <td class="px-6 py-3 text-center text-xs">{{ $event->is_verified ? 'Yes' : 'No' }}</td>
                        <td class="px-6 py-3 text-center text-xs">
                            <button wire:click="delete({{ $event->id }})" class="text-red-500 hover:text-red-700">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="p-4 mt-4">
            {{ $events->links() }}
        </div>
    </div>
</div>
