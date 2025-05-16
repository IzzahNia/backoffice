<div>
    @if($showModal)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen">
                <div class="fixed inset-0 bg-black opacity-50" wire:click="hide"></div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 w-full max-w-md z-20" onclick="event.stopPropagation();">
                    <h3 class="text-lg font-bold mb-4">
                        @if($viewing)
                            View Application ({{ ucfirst($type) }})
                        @else
                            {{ $mode === 'edit' ? 'Edit Application' : 'Create Application' }}
                        @endif
                    </h3>
                    @if($viewing)
                        <div class="space-y-2">
                            @foreach($fields as $field)
                                <div>
                                    <span class="font-semibold">{{ $field['label'] }}:</span>
                                    <span>
                                        @php $value = $viewData['form'][$field['name']] ?? '-'; @endphp
                                        @if(is_array($value))
                                            {{ implode(', ', $value) }}
                                        @elseif(
                                            (in_array($field['type'], ['file', 'upload_file', 'image', 'upload_image']) && $value && is_string($value))
                                        )
                                            @php
                                                $url = Storage::url($value);
                                                $isImage = Str::endsWith(strtolower($value), ['.jpg', '.jpeg', '.png', '.gif', '.webp']);
                                            @endphp
                                            @if($isImage)
                                                <a href="{{ $url }}" target="_blank">
                                                    <img src="{{ $url }}" alt="Image" class="h-20 inline-block rounded shadow" />
                                                </a>
                                            @else
                                                <a href="{{ $url }}" target="_blank" class="text-blue-500 underline">View Document</a>
                                            @endif
                                        @else
                                            {{ $value }}
                                        @endif
                                    </span>
                                </div>
                            @endforeach
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="button" wire:click="hide" class="px-4 py-2 rounded bg-gray-300 dark:bg-gray-600">Close</button>
                        </div>
                    @else
                    <form wire:submit.prevent="save">
                        @foreach($fields as $field)
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-200">{{ $field['label'] }}</label>
                                @switch($field['type'])
                                    @case('text')
                                    @case('email')
                                    @case('tel')
                                    @case('url')
                                    @case('date')
                                        <input
                                            type="{{ $field['type'] }}"
                                            wire:model.defer="form.{{ $field['name'] }}"
                                            class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                        />
                                        @break

                                    @case('datetime-local')
                                        <input
                                            type="datetime-local"
                                            wire:model.defer="form.{{ $field['name'] }}"
                                            class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                        />
                                        @break

                                    @case('textarea')
                                        <textarea
                                            wire:model.defer="form.{{ $field['name'] }}"
                                            class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                        ></textarea>
                                        @break

                                    @case('select')
                                        @if($field['name'] === 'event_id')
                                            <select
                                                wire:model.defer="form.{{ $field['name'] }}"
                                                class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                            >
                                                <option value="">Select Event</option>
                                                @foreach($field['options'] as $optionValue => $optionLabel)
                                                    <option value="{{ $optionValue }}">{{ $optionLabel }}</option>
                                                @endforeach
                                            </select>
                                            {{-- You can add extra info or validation for event_id here --}}
                                        @else
                                            <select
                                                wire:model.defer="form.{{ $field['name'] }}"
                                                class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                            >
                                                <option value="">Select {{ $field['label'] }}</option>
                                                @foreach($field['options'] as $optionValue => $optionLabel)
                                                    <option value="{{ $optionValue }}">{{ $optionLabel }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        @break

                                    @case('radio')
                                        <div class="flex gap-4 mt-2">
                                            @foreach($field['options'] as $optionValue => $optionLabel)
                                                <label class="inline-flex items-center">
                                                    <input
                                                        type="radio"
                                                        wire:model.defer="form.{{ $field['name'] }}"
                                                        value="{{ is_int($optionValue) ? $optionLabel : $optionValue }}"
                                                        class="form-radio"
                                                    >
                                                    <span class="ml-2">{{ $optionLabel }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                        @break

                                    @case('checkbox')
                                        <div class="flex flex-wrap gap-4 mt-2">
                                            @foreach($field['options'] as $optionValue => $optionLabel)
                                                <label class="inline-flex items-center">
                                                    <input
                                                        type="checkbox"
                                                        wire:model.defer="form.{{ $field['name'] }}"
                                                        value="{{ is_int($optionValue) ? $optionLabel : $optionValue }}"
                                                        class="form-checkbox"
                                                    >
                                                    <span class="ml-2">{{ $optionLabel }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                        @break

                                    @case('file')
                                    @case('upload_file')
                                        <input
                                            type="file"
                                            wire:model="form.{{ $field['name'] }}"
                                            @if(isset($field['accept'])) accept="{{ $field['accept'] }}" @endif
                                            class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                        />
                                        @break

                                    @case('image')
                                    @case('upload_image')
                                        <input
                                            type="file"
                                            wire:model="form.{{ $field['name'] }}"
                                            accept="image/*"
                                            class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                        />
                                        @php $property = $field['name']; @endphp
                                        @if(isset($form[$property]) && $form[$property])
                                            <div class="mt-2">
                                                <img src="{{ $form[$property]->temporaryUrl() }}" class="h-20" />
                                            </div>
                                        @endif
                                        @break

                                    @default
                                        <input
                                            type="text"
                                            wire:model.defer="form.{{ $field['name'] }}"
                                            class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                        />
                                @endswitch
                                @error('form.' . $field['name']) <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        @endforeach
                        <div class="flex justify-end">
                            <button type="button" wire:click="hide" class="mr-2 px-4 py-2 rounded bg-gray-300 dark:bg-gray-600">Cancel</button>
                            <button type="submit" class="px-4 py-2 rounded bg-blue-500 text-white">
                                {{ $mode === 'edit' ? 'Update' : 'Save' }}
                            </button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
