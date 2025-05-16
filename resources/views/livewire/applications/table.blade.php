<div>
    <div class="flex flex-wrap gap-2 mb-4 w-full">
        <button
            wire:click='$dispatch("showApplicationForm")'
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
            + Create Application
        </button>

        <input
            type="text"
            wire:model.defer="filterInput.search"
            placeholder="Search applications..."
            class="border rounded px-2 py-1 bg-white text-gray-900 placeholder-gray-400
                dark:bg-gray-700 dark:text-gray-100 dark:placeholder-gray-400 flex-1 min-w-[200px]"
        />

        <select
            wire:model.defer="filterInput.status"
            class="border rounded px-2 py-1 bg-white text-gray-900 dark:bg-gray-700 dark:text-gray-100"
        >
            <option value="">All Status</option>
            <option value="pending">Pending</option>
            <option value="approved">Approved</option>
            <option value="rejected">Rejected</option>
        </select>

        <select
            wire:model.defer="filterInput.type"
            class="border rounded px-2 py-1 bg-white text-gray-900 dark:bg-gray-700 dark:text-gray-100"
        >
            <option value="">All Types</option>
            <option value="user">User</option>
            <option value="vendor">Vendor</option>
            <option value="collaborator">Collaborator</option>
            <option value="event">Event</option>
            <option value="crew">Crew</option>
        </select>

        <select
            wire:model="filterInput.perPage"
            class="w-32 border rounded px-2 py-1 bg-white text-gray-900 dark:bg-gray-700 dark:text-gray-100"
        >
            <option value="5">5 / page</option>
            <option value="10">10 / page</option>
            <option value="25">25 / page</option>
            <option value="50">50 / page</option>
            <option value="100">100 / page</option>
        </select>

        <button
            wire:click="applyFilters"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded"
        >
            Apply Filters
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
                <tr>
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Title</th>
                    <th class="px-6 py-3">Type</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Event</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $application)
                    <tr>
                        <td class="px-6 py-4">#{{ $application->id }}</td>
                        <td class="px-6 py-4">{{ $application->title }}</td>
                        <td class="px-6 py-4">{{ ucfirst($application->type) }}</td>
                        <td class="px-6 py-4">{{ ucfirst($application->status) }}</td>
                        <td class="px-6 py-4">{{ $application->event?->name ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <button
                                wire:click='$dispatch("showApplicationForm", { applicationId: {{ $application->id }} })'
                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded mr-2">
                                Edit
                            </button>
                            <button
                                wire:click='$dispatch("viewApplication", { applicationId: {{ $application->id }}, type: "{{ $application->type }}" })'
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">
                                View
                            </button>
                            <!-- Add delete/approve/reject as needed -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $applications->links() }}
    </div>
</div>
