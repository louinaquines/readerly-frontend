<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">My Classes</h2>
        <button wire:click="$set('showForm', true)"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + New Class
        </button>
    </div>

    @if($showForm)
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="text-lg font-semibold mb-4">Create New Class</h3>

        @if($error)
            <p class="text-red-500 mb-3">{{ $error }}</p>
        @endif

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Class Name</label>
            <input wire:model="name" type="text" placeholder="e.g. Rosas"
                   class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Grade Level</label>
            <input wire:model="grade_level" type="text" placeholder="e.g. Grade 4"
                   class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            @error('grade_level') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex gap-3">
            <button wire:click="createClass"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Save
            </button>
            <button wire:click="$set('showForm', false)"
                    class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">
                Cancel
            </button>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($classes as $class)
        <a href="{{ route('classes.show', $class['id']) }}"
           class="bg-white rounded-lg shadow p-6 hover:shadow-md transition block">
            <h3 class="text-lg font-semibold text-gray-800">{{ $class['name'] }}</h3>
            <p class="text-gray-500 text-sm mt-1">{{ $class['grade_level'] }}</p>
            <p class="text-blue-600 text-sm mt-3">{{ $class['students_count'] ?? 0 }} students</p>
        </a>
        @empty
        <p class="text-gray-400 col-span-3">No classes yet. Create your first one!</p>
        @endforelse
    </div>
</div>