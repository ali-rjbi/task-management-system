<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks List') }}
        </h2>
    </x-slot>

    <livewire:tasks-create-form></livewire:tasks-create-form>

    <livewire:tasks-edit-form></livewire:tasks-edit-form>

    <livewire:tasks-list></livewire:tasks-list>

</x-app-layout>
