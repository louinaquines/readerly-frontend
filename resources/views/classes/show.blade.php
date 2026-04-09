<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline text-sm">
                ← Back to Classes
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Class Details
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:student-list :classId="$classId" />
        </div>
    </div>
</x-app-layout>