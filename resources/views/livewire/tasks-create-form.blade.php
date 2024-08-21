<div x-data="{ open: false }" class="px-6 pt-4">
    <!-- Button to open the drawer -->
    <button @click="open = true" class="px-4 py-2 bg-blue-600 text-white rounded-md">
        Add New Task
    </button>


    <!-- Drawer -->
    <div x-show="open" @click.away="open = false"
         x-transition:enter="transform transition ease-in-out duration-300 sm:duration-500"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transform transition ease-in-out duration-300 sm:duration-500"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         class="fixed inset-y-0 right-0 max-w-full flex z-50">
        <div class="w-screen max-w-md">
            <div class="h-full flex flex-col bg-white shadow-xl overflow-y-auto">
                <div class="py-6 px-4 bg-blue-600">
                    <h2 class="text-lg font-medium text-white">New Task</h2>
                </div>
                <div class="p-6 flex-grow">
                    <form wire:submit.prevent="addTask">
                        <div class="mb-4">
                            <label for="taskTitle" class="block text-sm font-medium text-gray-700">Task Title</label>
                            <input type="text" wire:model="title" id="taskTitle"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="taskDescription" class="block text-sm font-medium text-gray-700">Task
                                Description</label>
                            <textarea wire:model="description" id="taskDescription"
                                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Task Status</label>
                            <div class="mt-2 space-y-4">
                                @foreach($statuses as $status)
                                    <div class="flex items-center">
                                        <input id="status_{{ $status->id }}" name="status" type="radio"
                                               wire:model="status_id" value="{{ $status->id }}"
                                               class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                        <label for="status_{{ $status->id }}"
                                               class="ml-3 block text-sm font-medium text-gray-700">
                                            {{ $status->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('status_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Task Priority</label>
                            <div class="mt-2 space-y-4">
                                @foreach($priorities as $priority)
                                    <div class="flex items-center">
                                        <input id="priority_{{ $priority->id }}" name="priority" type="radio"
                                               wire:model="priority_id" value="{{ $priority->id }}"
                                               class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                        <label for="priority_{{ $priority->id }}"
                                               class="ml-3 block text-sm font-medium text-gray-700">
                                            {{ $priority->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('priority_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="dueDate" class="block text-sm font-medium text-gray-700">Due Date</label>
                            <input type="date" wire:model="dueDate" id="dueDate"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error('dueDate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Save Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
