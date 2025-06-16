<div>
    <div class="flex flex-wrap gap-2 mb-4 w-full">
        <button
            wire:click='$dispatch("showEventForm")'
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
            + Create Event
        </button>

        <input
            type="text"
            wire:model.defer="filterInput.search"
            placeholder="Search events..."
            class="border rounded px-2 py-1 bg-white text-gray-900 placeholder-gray-400
                dark:bg-gray-700 dark:text-gray-100 dark:placeholder-gray-400 flex-1 min-w-[200px]"
        />

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
    <!-- End Filters -->

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-theme-four">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium theme-secondary dark:text-gray-300 uppercase tracking-wider">Id</th>
                    <th class="px-6 py-3 text-left text-xs font-medium theme-secondary dark:text-gray-300 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium theme-secondary dark:text-gray-300 uppercase tracking-wider">Start Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium theme-secondary dark:text-gray-300 uppercase tracking-wider">End Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium theme-secondary dark:text-gray-300 uppercase tracking-wider">Location</th>
                    <th class="px-6 py-3 text-left text-xs font-medium theme-secondary dark:text-gray-300 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium theme-secondary dark:text-gray-300 uppercase tracking-wider">Verified</th>
                    <th class="px-6 py-3 text-left text-xs font-medium theme-secondary dark:text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($events as $event)
                    <tr>
                        <td class="px-6 py-4 theme-secondary whitespace-nowrap">#{{ $event['id'] }}</td>
                        <td class="px-6 py-4 theme-secondary whitespace-nowrap">{{ $event['name'] }}</td>
                        <td class="px-6 py-4 theme-secondary whitespace-nowrap">{{ $event['start_time'] }}</td>
                        <td class="px-6 py-4 theme-secondary whitespace-nowrap">{{ $event['end_time'] }}</td>
                        <td class="px-6 py-4 theme-secondary whitespace-nowrap">{{ $event['location'] }}</td>
                        <td class="px-6 py-4 theme-secondary whitespace-nowrap">{{ ucfirst($event['type']) }}</td>
                        <td class="px-6 py-4 theme-secondary whitespace-nowrap">
                            @if($event['is_verified'])
                                <span class="text-green-600 font-bold">Yes</span>
                            @else
                                <span class="text-red-600 font-bold">No</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button
                                wire:click='$dispatch("showEventForm", { eventId: {{ $event["id"] }} })'
                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded mr-2">
                                Edit
                            </button>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded mr-2">Delete</button>
                            <!-- Feedback Link Button -->
                            <button
                                onclick="navigator.clipboard.writeText('{{ url('/event/'.$event['id'].'/feedback') }}'); alert('Feedback link copied!')"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded mr-2">
                                Copy Feedback Link
                            </button>
                            <!-- Show QR Button (opens modal with QR code) -->
                            <button
                                onclick="showQrModal('{{ url('/event/'.$event['id'].'/feedback') }}')"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
                                Show QR
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $events->links() }}
    </div>
    <!-- QR Modal -->
    <div id="qrModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded shadow-lg flex flex-col items-center">
            <canvas id="qrCodeCanvas" width="200" height="200"></canvas>
            <button onclick="closeQrModal()" class="mt-4 bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded">Close</button>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/qrious/dist/qrious.min.js"></script>
<script>
function showQrModal(link) {
    document.getElementById('qrModal').classList.remove('hidden');
    // Generate QR code in the canvas
    new QRious({
        element: document.getElementById('qrCodeCanvas'),
        value: link,
        size: 200
    });
}
function closeQrModal() {
    document.getElementById('qrModal').classList.add('hidden');
    // Optionally clear the canvas
    const canvas = document.getElementById('qrCodeCanvas');
    const ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}
</script>
