<section>
    <div class="py-6 px-6 max-h-[65vh] overflow-y-auto mt-3">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach($tasks as $task)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between items-center">
                            <div>
                                {{ $task->title }}
                                |
                                #{{ $task->id }}
                            </div>
                            <div class="flex space-x-2">
                                @if($task->due_date)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white text-gray-800">
                                    {{ verta($task->due_date)->format('Y/m/d') }}
                                </span>
                                @endif
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ $task->status->name }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $task->priority->name }}
                                </span>
                            </div>
                        </div>
                        <div class="flex pt-1 text-gray-600 dark:text-gray-400">
                            {{ $task->description }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mt-4 px-6">
        {{ $tasks->links() }}
    </div>

</section>
