<section>
    <div class="py-6 px-6 max-h-[65vh] min-h-[65vh] overflow-y-auto mt-3">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            @foreach($tasks as $task)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between items-center">
                            <div>
                                {{ $task->title }}
                            </div>
                            <div class="flex">
                                @if($task->due_date)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white text-gray-800 me-1">
                                    {{ verta($task->due_date)->format('Y/m/d') }}
                                </span>
                                @endif
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 me-1">
                                    {{ $task->status->name }}
                                </span>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 me-1">
                                    {{ $task->priority->name }}
                                </span>
                                <button
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 me-1 min-h-[26.5px]"
                                    wire:click="showTask({{ $task->id }})"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400"
                                         viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mt-4 px-6">
        {{ $tasks->links() }}
    </div>

    <livewire:tasks-modal></livewire:tasks-modal>

</section>
