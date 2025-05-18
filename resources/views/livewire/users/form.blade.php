{{-- filepath: resources/views/livewire/users/form.blade.php --}}
<div>
    @if($showModal)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen">
                <div class="fixed inset-0 bg-black opacity-50" wire:click="hide"></div>
                <div class="bg-white border-theme-secondary dark:bg-gray-800 rounded-lg shadow-lg p-8 w-full max-w-md z-20" onclick="event.stopPropagation();">
                    <h3 class="text-lg font-bold mb-4 theme-secondary">
                        {{ $mode === 'edit' ? 'Edit User' : 'Create User' }}
                    </h3>
                    <form wire:submit.prevent="save">
                        <div class="mb-4">
                            <label class="block text-black dark:text-gray-200">Name</label>
                            <input
                                type="text"
                                wire:model.defer="name"
                                class="w-full border rounded px-3 py-2 bg-theme-four text-black placeholder-gray-500"
                                placeholder="Name"
                            />
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-black dark:text-gray-200">Email</label>
                            <input
                                type="email"
                                wire:model.defer="email"
                                class="w-full border rounded px-3 py-2 bg-theme-four text-black placeholder-gray-500"
                                placeholder="Email"
                            />
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-black dark:text-gray-200">Password</label>
                            <input
                                type="password"
                                wire:model.defer="password"
                                class="w-full border rounded px-3 py-2 bg-theme-four text-black placeholder-gray-500"
                                placeholder="{{ $mode === 'edit' ? 'Leave blank to keep current password' : 'Password' }}"
                            />
                            @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-black dark:text-gray-200">Role</label>
                            <select
                                wire:model.defer="role"
                                class="w-full border rounded px-3 py-2 bg-theme-four text-black"
                            >
                                <option value="">Select Role</option>
                                @foreach($roles as $enum)
                                    <option value="{{ $enum->value }}">{{ ucfirst($enum->name) }}</option>
                                @endforeach
                            </select>
                            @error('role') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex justify-end">
                            <button type="button" wire:click="hide" class="mr-2 px-4 py-2 rounded bg-gray-300 dark:bg-gray-600">Cancel</button>
                            <button type="submit" class="px-4 py-2 rounded bg-blue-500 text-white">
                                {{ $mode === 'edit' ? 'Update' : 'Save' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
