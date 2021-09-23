<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3><a href="/houses/create" class="no-underline hover:underline text-blue-800">Créer une nouvelle habitation</a></h3>
                    @foreach ($houses as $house)
                        <h1 class="text-6xl font-normal leading-normal mt-0 mb-2 text-pink-800">
                            Habitation numéro {{ $house['id'] }}
                        </h1>
                        <li>Nom: {{ $house['name'] }}</li>
                        <li>Address: {{ $house['address'] }}</li>
                        <li>Prix de vente: {{ $house['price'] }} $</li>
                        <li>Surface habitable: {{ $house['surface'] }} m²</li>
                        <h3><a href="/houses/{{ $house['id'] }}" class="no-underline hover:underline text-blue-800">Modifier</a></h3>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
