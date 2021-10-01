<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier une habitation
        </h2>
    </x-slot>
    <div class="py-12">
        <house-edit-component v-bind:house="{{ $house }}" />
    </div>
</x-app-layout>
