<div>
    <div>
        <div class="p-4 mt-4">
            <button onclick="openModal()" class="bg-blue-500 text-white px-4 py-2 rounded-md">Create Application</button>
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
                    <div id="createApplicationModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-1/3">
                            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Create Application
                                </h3>
                            </div>
                            <div class="p-6">
                                <form wire:submit.prevent="create" id="createApplicationForm">
                                    <div class="mb-4">
                                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                                        <input type="text" id="title" name="title" wire:model="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                    </div>
                                    <div class="mb-4">
                                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                        <textarea id="description" name="description" wire:model="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"></textarea>
                                    </div>
                                    {{-- Todo: display all event that related to user and pending --}}
                                    <div class="mb-4">
                                        <label for="event_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Event</label>
                                        <select id="event_id" name="event_id" wire:model="event_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                            <option value="">Select Event</option>
                                            @foreach ($events as $event)
                                                <option value="{{ $event->id }}">{{ $event->name }}</option>
                                            @endforeach
                                        </select>
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
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Event
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $application)
                    <tr class="hover:bg-gray-300 dark:bg-gray-800 divide-y divide-gray-200">
                        <td class="px-6 py-3 text-center text-xs">{{ $application->title }}</td>
                        <td class="px-6 py-3 text-center text-xs">{{ $application->description }}</td>
                        <td class="px-6 py-3 text-center text-xs">{{ $application->event->name ?? 'N/A' }}</td>
                        <td class="px-6 py-3 text-center text-xs">
                            <span class="px-2 py-1 rounded-full text-white
                                {{ $application->status === 'approved' ? 'bg-green-500' : ($application->status === 'rejected' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                {{ ucfirst($application->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-center text-xs">
                            <button wire:click="approve({{ $application->id }})" class="text-green-500 hover:text-green-700">Approve</button>
                            <button wire:click="reject({{ $application->id }})" class="text-red-500 hover:text-red-700 ml-2">Reject</button>
                            <button wire:click="delete({{ $application->id }})" class="text-gray-500 hover:text-gray-700 ml-2">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="p-4 mt-4">
            {{ $applications->links() }}
        </div>
    </div>
</div>
