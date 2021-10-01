<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Supprimer les infos de la maison
        </h2>
    </x-slot>
    <div class="py-12">
        <house-delete-component v-bind:house="{{ $house }}" />
    </div>
</x-app-layout>
