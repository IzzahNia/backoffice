<div>
    <div class="flex flex-wrap gap-2 mb-4 w-full">
        <button
            wire:click='$dispatch("showReviewForm")'
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
            + Create Review
        </button>

        <input
            type="text"
            wire:model.defer="filterInput.search"
            placeholder="Search comments..."
            class="border rounded px-2 py-1 bg-white text-gray-900 placeholder-gray-400
                dark:bg-gray-700 dark:text-gray-100 dark:placeholder-gray-400 flex-1 min-w-[200px]"
        />

        <select
            wire:model.defer="filterInput.admin_id"
            class="border rounded px-2 py-1 bg-white text-gray-900 dark:bg-gray-700 dark:text-gray-100"
        >
            <option value="">All Admins</option>
            @foreach($admins as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
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
                    <th class="px-6 py-3">Application</th>
                    <th class="px-6 py-3">Admin</th>
                    <th class="px-6 py-3">Comment</th>
                    <th class="px-6 py-3">Created At</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reviews as $review)
                    <tr>
                        <td class="px-6 py-4">#{{ $review->id }}</td>
                        <td class="px-6 py-4">{{ $review->application?->title ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $review->admin?->name ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $review->comment }}</td>
                        <td class="px-6 py-4">{{ $review->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-6 py-4">
                            <button
                                wire:click='$dispatch("showReviewForm", { reviewId: {{ $review->id }} })'
                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded mr-2">
                                Edit
                            </button>
                            <!-- Add delete if needed -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $reviews->links() }}
    </div>
</div>
