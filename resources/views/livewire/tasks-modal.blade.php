<div x-data="{ open: @entangle('showModal') }" x-show="open"
     class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
    <div class="absolute inset-0" @click="open = false"></div>
    <div class="relative bg-white dark:bg-gray-800 p-10 rounded-lg max-w-3xl w-full mx-4" @click.stop>
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">Task Details</h2>
            <button @click="$wire.closeModal()" class="text-gray-800 dark:text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        @if($task)
            <p class="text-gray-700 dark:text-gray-300">ID: {{ $task->id }}</p>
            <p class="text-gray-700 dark:text-gray-300">Title: {{ $task->title }}</p>

            @if($task->description)
                <p class="text-gray-700 dark:text-gray-300 my-3">
                    {{ $task->description }}
                </p>
            @endif

            <div class="flex">
                @if($task->due_date)
                    <div
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white text-gray-800 me-1">
                        {{ verta($task->due_date)->format('Y/m/d') }}
                    </div>
                @endif
                <div
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 me-1">
                    {{ $task->status->name }}
                </div>
                <div
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 me-1">
                    {{ $task->priority->name }}
                </div>
            </div>

            @if($task->user->is(auth()->user()))
                <div class="flex justify-end mt-6 space-x-4">
                    <button wire:click="edit({{ $task->id }})"
                            class="px-3 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-800 text-sm">
                        Edit
                    </button>
                    <button wire:click="delete({{ $task->id }})"
                            wire:confirm="Are you sure you want to delete this task?"
                            class="px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-800 text-sm">
                        Delete
                    </button>
                </div>
            @endif

        @endif
    </div>
</div>
