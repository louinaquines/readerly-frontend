<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Students</h2>
        <button wire:click="$set('showForm', true)"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Add Student
        </button>
    </div>

    @if($showForm)
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="text-lg font-semibold mb-4">Add New Student</h3>

        @if($error)
            <p class="text-red-500 mb-3">{{ $error }}</p>
        @endif

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Student Name</label>
            <input wire:model="name" type="text" placeholder="e.g. Maria Santos"
                   class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Grade</label>
            <input wire:model="grade" type="text" placeholder="e.g. Grade 4"
                   class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            @error('grade') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex gap-3">
            <button wire:click="addStudent"
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

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Grade</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reading Level</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($students as $student)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $student['name'] }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $student['grade'] }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Level {{ $student['reading_level'] }}</td>
                    <td class="px-6 py-4 text-sm">
                        <button wire:click="deleteStudent({{ $student['id'] }})"
                                wire:confirm="Remove {{ $student['name'] }}?"
                                class="text-red-600 hover:text-red-800">
                            Remove
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-400">No students yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>