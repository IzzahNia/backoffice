<div>
    <div class="flex justify-between items-center mb-4">
        <button
            wire:click='$dispatch("showUserForm")'
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Create User
        </button>
    </div>

    <!-- Filters -->
    <div class="flex flex-wrap gap-2 mb-4 w-full">
        <input
            type="text"
            wire:model.defer="filterInput.search"
            placeholder="Search users..."
            class="border rounded px-2 py-1 bg-white text-gray-900 placeholder-gray-400
                dark:bg-gray-700 dark:text-gray-100 dark:placeholder-gray-400 flex-1 min-w-[200px]"
        />

        <select
            wire:model.defer="filterInput.role"
            class="border rounded px-2 py-1 bg-white text-gray-900 dark:bg-gray-700 dark:text-gray-100"
        >
            <option value="">All Roles</option>
            <option value="admin">Admin</option>
            <option value="user">User</option>
            <!-- Add more roles as needed -->
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
    <!-- End Filters -->

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Id</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">#{{ $user['id'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user['name'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user['email'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user['role'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button
                                wire:click='$dispatch("showUserForm", { userId: {{ $user["id"] }} })'
                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded mr-2">
                                Edit
                            </button>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
