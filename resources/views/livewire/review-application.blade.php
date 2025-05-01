<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Application Review ({{ ucfirst($application->type) }})</h2>

    <div class="space-y-4">
        @foreach ($fields as $field)
            <div>
                <label class="block font-semibold">{{ $field['label'] }}</label>

                @php $value = $application->data['form'][$field['name']] ?? '' @endphp

                @if ($field['type'] === 'file' && $value)
                    <a href="{{ Storage::url($value) }}" target="_blank" class="text-blue-600 underline">
                        View File
                    </a>
                @else
                    <div class="text-gray-700">{{ $value }}</div>
                @endif
            </div>
        @endforeach
    </div>

    {{-- <div class="flex gap-4">
        <button wire:click="submitReview" wire:loading.attr="disabled"
                wire:target="submitReview" wire:model="status" value="approved"
                class="bg-green-600 text-white px-4 py-2 rounded">
            Approve
        </button>

        <button wire:click="$set('status', 'rejected'); submitReview()"
                class="bg-red-600 text-white px-4 py-2 rounded">
            Reject
        </button>
    </div> --}}
</div>
