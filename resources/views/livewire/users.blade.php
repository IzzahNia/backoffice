<div>
    <div>
        <div class="p-4 mt-4">
            {{-- <input type="text" wire:model="search" placeholder="Search users..." class="border border-gray-300 rounded-md p-2"> --}}
            {{-- <select wire:model="perPage" class="border border-gray-300 rounded-md p-2">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select> --}}
            {{-- <select wire:model="sortBy" class="border border-gray-300 rounded-md p-2">
                <option value="name">Name</option>
                <option value="email">Email</option>
                <option value="created_at">Created At</option>
            </select> --}}
            {{-- <select wire:model="sortDirection" class="border border-gray-300 rounded-md p-2">
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select> --}}
            {{-- <button wire:click="resetFilters" class="bg-blue-500 text-white rounded-md p-2">Reset Filters</button> --}}
            {{-- <button wire:click="export" class="bg-green-500 text-white rounded-md p-2">Export</button> --}}
            <!-- Button to open the modal -->
            <button onclick="openModal()" class="bg-blue-500 text-white px-4 py-2 rounded-md">Create User</button>
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
                    <div id="createUserModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-1/3">
                            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Create User
                                </h3>
                            </div>
                            <div class="p-6">
                                <form wire:submit.prevent="create" id="createUserForm">
                                    <div class="mb-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                        <input type="text" id="name" name="name" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                    </div>
                                    <div class="mb-4">
                                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                        <input type="email" id="email" name="email" wire:model="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                                        <input type="password" id="password" name="password" wire:model="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
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
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Created At
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-300 dark:bg-gray-800 divide-y divide-gray-200">
                        <td class="px-6 py-3 text-center text-xs">{{ $user->name }}</td>
                        <td class="px-6 py-3 text-center text-xs">{{ $user->email }}</td>
                        <td class="px-6 py-3 text-center text-xs uppercase"> {{ $user->role }} </td>
                        <td class="px-6 py-3 text-center text-xs">{{ $user->created_at->format('d/m/Y') }} || {{ $user->created_at->diffForHumans() }} </td>
                        <td class="px-6 py-3 text-center text-xs">
                            {{-- <button wire:click="edit({{ $user->id }})" class="text-blue-500 hover:text-blue-700">Edit</button> --}}
                            @if ($user->role !== 'admin')
                                <button wire:click="delete({{ $user->id }})" class="text-red-500 hover:text-red-700">Delete</button>
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="p-4 mt-4">
            {{ $users->links(data: ['scroll' => false]) }}
        </div>
    </div>
</div>
