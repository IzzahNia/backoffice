<form wire:submit.prevent="submit" enctype="multipart/form-data" class="space-y-4">
    @foreach ($fields as $field)
        <div>
            <label class="block mb-1">{{ $field['label'] }}</label>

            @switch($field['type'])
                @case('textarea')
                    <textarea wire:model.defer="form.{{ $field['name'] }}" class="w-full border rounded p-2"></textarea>
                    @break

                @case('file')
                    <input type="file" wire:model="form.{{ $field['name'] }}" class="w-full border rounded p-2">
                    @break

                @case('select' && $field['name'] == 'event_id')
                    <select wire:model="form.{{ $field['name'] }}" class="w-full border rounded p-2">
                        <option value="">-- Select --</option>
                        @foreach ($field['options'] as $option)
                            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                        @endforeach
                    </select>
                    @break

                @default
                    <input type="{{ $field['type'] }}"
                        wire:model.defer="form.{{ $field['name'] }}"
                        class="w-full border rounded p-2" />
            @endswitch

            @error("form.{$field['name']}") <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
    @endforeach

    {{-- <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Submit</button> --}}
    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end">
        <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2">
            Cancel
        </button>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">
            Create
        </button>
    </div>
</form>
