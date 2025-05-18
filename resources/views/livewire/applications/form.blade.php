{{-- filepath: resources/views/livewire/applications/form.blade.php --}}
<div>
    @if($showModal)
        <div class="fixed z-10 inset-0 flex items-center justify-center">
            <div class="fixed inset-0 bg-black opacity-50" wire:click="hide"></div>
            <div
                class="bg-theme-four rounded-lg shadow-lg p-8 w-full max-w-md z-20 text-white relative min-h-[400px] max-h-[90vh] overflow-y-auto"
                onclick="event.stopPropagation();"
            >
                <h3 class="text-lg font-bold mb-4 theme-secondary">
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
                                <span class="font-semibold theme-secondary">{{ $field['label'] }}:</span>
                                <span class="theme-secondary">
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
                    @can('isAdmin')
                        @if($viewing && $status === 'pending')
                            <form wire:submit.prevent="review" class="mt-4 space-y-2">
                                <label class="block text-gray-100 font-semibold theme-secondary">Review Comment</label>
                                <textarea wire:model.defer="reviewComment" class="w-full border rounded px-3 py-2 bg-theme-four theme-secondary"></textarea>
                                @error('reviewComment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                                <div class="flex gap-2 mt-2">
                                    <button type="submit" wire:click="$set('reviewAction', 'approved')" class="px-4 py-2 rounded bg-green-500 text-white">Approve</button>
                                    <button type="submit" wire:click="$set('reviewAction', 'rejected')" class="px-4 py-2 rounded bg-red-500 text-white">Reject</button>
                                </div>
                            </form>
                        @endif
                    @endcan

                    @if($viewing && $status !== 'pending')
                        <div class="mt-4 p-3 bg-theme-four theme-secondary border-theme-secondary rounded">
                            <div>
                                <span class="font-semibold">Status:</span>
                                {{ ucfirst($status) }}
                            </div>
                            <div>
                                <span class="font-semibold">Reviewed By:</span>
                                {{ $application && $application->reviewBy ? optional(\App\Models\User::find($application->reviewBy))->name : '-' }}
                            </div>
                            <div>
                                <span class="font-semibold">Comment:</span>
                                {{ $application->comment ?? '-' }}
                            </div>
                        </div>
                    @endif
                    <div class="flex justify-end mt-4">
                        <button type="button" wire:click="hide" class="px-4 py-2 rounded bg-gray-300 theme-secondary">Close</button>
                    </div>
                @else
                <form wire:submit.prevent="save">
                    @foreach($fields as $field)
                        <div class="mb-4">
                            <label class="block theme-secondary">{{ $field['label'] }}</label>
                            @switch($field['type'])
                                @case('text')
                                @case('email')
                                @case('tel')
                                @case('url')
                                @case('date')
                                    <input
                                        type="{{ $field['type'] }}"
                                        wire:model.defer="form.{{ $field['name'] }}"
                                        class="w-full border rounded px-3 py-2 bg-theme-four theme-secondary"
                                    />
                                    @break

                                @case('datetime-local')
                                    <input
                                        type="datetime-local"
                                        wire:model.defer="form.{{ $field['name'] }}"
                                        class="w-full border rounded px-3 py-2 bg-theme-four theme-secondary"
                                    />
                                    @break

                                @case('textarea')
                                    <textarea
                                        wire:model.defer="form.{{ $field['name'] }}"
                                        class="w-full border rounded px-3 py-2 bg-theme-four theme-secondary"
                                    ></textarea>
                                    @break

                                @case('select')
                                    @if($field['name'] === 'event_id')
                                        <select
                                            wire:model.defer="form.{{ $field['name'] }}"
                                            class="w-full border rounded px-3 py-2 bg-theme-four theme-secondary"
                                        >
                                            <option value="">Select Event</option>
                                            @foreach($field['options'] as $optionValue => $optionLabel)
                                                <option value="{{ $optionValue }}">{{ $optionLabel }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <select
                                            wire:model.defer="form.{{ $field['name'] }}"
                                            class="w-full border rounded px-3 py-2 bg-theme-four theme-secondary"
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
                                            <label class="inline-flex items-center theme-secondary">
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
                                            <label class="inline-flex items-center theme-secondary">
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
                                    @php
                                        $existingFile = $form[$field['name']] ?? null;
                                    @endphp
                                    @if($existingFile && is_string($existingFile))
                                        <div class="mb-2">
                                            <a href="{{ Storage::url($existingFile) }}" target="_blank" class="text-blue-500 underline">View Current File</a>
                                        </div>
                                    @endif
                                    <input
                                        type="file"
                                        wire:model="form.{{ $field['name'] }}"
                                        @if(isset($field['accept'])) accept="{{ $field['accept'] }}" @endif
                                        class="w-full border rounded px-3 py-2 bg-theme-four theme-secondary"
                                    />
                                    @break

                                @case('image')
                                @case('upload_image')
                                    @php
                                        $existingImage = $form[$field['name']] ?? null;
                                    @endphp
                                    @if($existingImage && is_string($existingImage))
                                        <div class="mb-2">
                                            <a href="{{ Storage::url($existingImage) }}" target="_blank">
                                                <img src="{{ Storage::url($existingImage) }}" alt="Current Image" class="h-20 inline-block rounded shadow" />
                                            </a>
                                        </div>
                                    @endif
                                    <input
                                        type="file"
                                        wire:model="form.{{ $field['name'] }}"
                                        accept="image/*"
                                        class="w-full border rounded px-3 py-2 bg-theme-four theme-secondary"
                                    />
                                    @break

                                @default
                                    <input
                                        type="text"
                                        wire:model.defer="form.{{ $field['name'] }}"
                                        class="w-full border rounded px-3 py-2 bg-theme-four theme-secondary"
                                    />
                            @endswitch
                            @error('form.' . $field['name']) <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    @endforeach
                    <div class="flex justify-end">
                        <button type="button" wire:click="hide" class="mr-2 px-4 py-2 rounded bg-gray-300 theme-secondary">Cancel</button>
                        <button type="submit" class="px-4 py-2 rounded bg-blue-500 text-white">
                            {{ $mode === 'edit' ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('openApplicationDetails', ({id}) => {
            window.open('/applications/' + id, '_blank');
        });
    });
</script>
