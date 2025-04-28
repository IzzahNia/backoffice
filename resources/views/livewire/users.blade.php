<div>
    <div class="p-4 mt-4">
        <button wire:click="openModal" class="bg-blue-500 text-white px-4 py-2 rounded-md">Create User</button>
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

    <!-- Modal -->
    @if ($showModal)
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-1/3">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ $isEditMode ? 'Edit User' : 'Create User' }}
                    </h3>
                </div>
                <div class="p-6">
                    <form wire:submit.prevent="save">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                            <input type="text" id="name" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" id="email" wire:model="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                            <input type="password" id="password" wire:model="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                            <select id="role" wire:model="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                                @endforeach
                            </select>
                            @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded-md">Cancel</button>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">{{ $isEditMode ? 'Update' : 'Save' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <table class="min-w-full divide-y divide-gray-300 mt-4">
        <thead>
            <tr>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="hover:bg-gray-300 dark:bg-gray-800 divide-y divide-gray-200">
                    <td class="px-6 py-3 text-center text-xs">{{ $user->name }}</td>
                    <td class="px-6 py-3 text-center text-xs">{{ $user->email }}</td>
                    <td class="px-6 py-3 text-center text-xs uppercase">{{ $user->role }}</td>
                    <td class="px-6 py-3 text-center text-xs">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-3 text-center text-xs">
                        <button wire:click="openModal({{ $user->id }})" class="text-blue-500 hover:text-blue-700">Edit</button>
                        @if ($user->role !== 'admin')
                            <button wire:click="delete({{ $user->id }})" class="text-red-500 hover:text-red-700">Delete</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="p-4 mt-4">
        {{ $users->links() }}
    </div>
</div>
