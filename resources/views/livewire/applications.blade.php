<div>
    <div>
        @canany(['isUser', 'isVendor'])
            <div class="p-4 mt-4">
                <button onclick="openModal()" class="bg-blue-500 text-white px-4 py-2 rounded-md">Create Application</button>
            </div>
        @endcanany

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
                            <div class="p-6" id="createApplicationForm">
                                @livewire('application-form', ['type' => Auth::user()->role->value])
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
                        Reviewed By
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Review Date
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Comment
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
                            {{ $application->review->admin->name ?? 'N/A' }}
                        </td>
                        @if ($application->review)
                            <td class="px-6 py-3 text-center text-xs">
                                {{ $application->review->created_at->format('Y-m-d H:i:s') }}
                            </td>
                        @else
                            <td class="px-6 py-3 text-center text-xs">
                                N/A
                            </td>
                        @endif
                        <td class="px-6 py-3 text-center text-xs">
                            {{ $application->review->comment ?? 'N/A' }}
                        </td>
                        @if ($application->status === 'pending')
                            <td class="px-6 py-3 text-center text-xs">
                                {{-- <button wire:click="approve({{ $application->id }})" class="text-green-500 hover:text-green-700">Approve</button> --}}
                                {{-- <button wire:click="reject({{ $application->id }})" class="text-red-500 hover:text-red-700 ml-2">Reject</button> --}}
                            </td>
                        @else
                            <td class="px-6 py-3 text-center text-xs">
                                {{-- <button wire:click="delete({{ $application->id }})" class="text-gray-500 hover:text-gray-700">Delete</button> --}}
                                {{-- add modal to open the view --}}
                                <a href="{{ route('viewApplication', $application) }}" class="text-blue-500 hover:text-blue-700">View</a>
                            </td>
                        @endif
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
