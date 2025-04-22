<div>
    <div class="p-4">
        <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Pending Applications</h2>
    </div>

    <table class="min-w-full divide-y divide-gray-300">
        <thead>
            <tr>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Application ID
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Title
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Description
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendingApplications as $application)
                <tr class="hover:bg-gray-300 dark:bg-gray-800 divide-y divide-gray-200">
                    <td class="px-6 py-3 text-center text-xs">{{ $application->id }}</td>
                    <td class="px-6 py-3 text-center text-xs">{{ $application->title }}</td>
                    <td class="px-6 py-3 text-center text-xs">{{ $application->description }}</td>
                    <td class="px-6 py-3 text-center text-xs">
                        <button wire:click="openModal({{ $application->id }})" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Review
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination for Pending Applications --}}
    <div class="p-4 mt-4">
        {{ $pendingApplications->links() }}
    </div>

    {{-- Modal --}}
    @if ($showModal)
    <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <div class="p-4 border-b">
                <h3 class="text-lg font-semibold">Review Application</h3>
            </div>
            <div class="p-4">
                @if ($selectedApplication)
                    <p><strong>Application ID:</strong> {{ $selectedApplication->id }}</p>
                    <p><strong>Title:</strong> {{ $selectedApplication->title }}</p>
                    <p><strong>Description:</strong> {{ $selectedApplication->description }}</p>
                @else
                    <p>Loading application details...</p>
                @endif
            </div>
            <div class="p-4 border-t flex justify-end space-x-2">
                <button wire:click="approveApplication" class="bg-green-500 text-white px-4 py-2 rounded">
                    Approve
                </button>
                <button wire:click="rejectApplication" class="bg-red-500 text-white px-4 py-2 rounded">
                    Reject
                </button>
                <button wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">
                    Cancel
                </button>
            </div>
        </div>
    </div>
    @endif

    <div class="p-4 mt-8">
        <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Reviewed Applications</h2>
    </div>

    <table class="min-w-full divide-y divide-gray-300">
        <thead>
            <tr>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Application ID
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Title
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Reviewed By
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Review Date
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reviewedApplications as $application)
                <tr class="hover:bg-gray-300 dark:bg-gray-800 divide-y divide-gray-200">
                    <td class="px-6 py-3 text-center text-xs">{{ $application->id }}</td>
                    <td class="px-6 py-3 text-center text-xs">{{ $application->title }}</td>
                    <td class="px-6 py-3 text-center text-xs capitalize">{{ $application->status }}</td>
                    <td class="px-6 py-3 text-center text-xs">
                        {{ $application->review->admin->name ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-3 text-center text-xs">
                        {{ $application->review->created_at->format('Y-m-d H:i') ?? 'N/A' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination for Reviewed Applications --}}
    <div class="p-4 mt-4">
        {{ $reviewedApplications->links() }}
    </div>
</div>
