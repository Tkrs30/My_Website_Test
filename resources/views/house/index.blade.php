<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Houses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Adresse</th>
                            <th>Prix de vente</th>
                            <th>Surface</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                            <th>Dupliquer</th>
                        </tr>
                        @foreach ($houses as $house)
                        <tr>
                            <td>{{ $house['name'] }}</td>
                            <td>{{ $house['address'] }}</td>
                            <td>{{ $house['price'] }} $</td>
                            <td>{{ $house['surface'] }} m²</td>
                            <td>
                                <form action="/houses/{{ $house['id'] }}" method="get">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-gray-500 rounded">
                                        Modifier
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="/houses/{{ $house['id'] }}/destroy" method="post">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-gray-500 rounded">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="/houses/{{ $house['id'] }}/duplicate" method="post">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-gray-500 rounded">
                                        Dupliquer
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <br />
                    <form action="/houses/sort/{{ $sortby == 'surfaceup' ? 'surfacedown' : 'surfaceup' }}" method="post">
                        @csrf
                        <button name="submitsort" type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-gray-500 rounded">
                            Trier par surface {{ $sortby == 'surfaceup' ? 'croissante' : 'décroissante' }}
                        </button>
                    </form>
                    <br />
                    <center>
                    <form action="/houses/create" method="get">
                        @csrf
                        <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-gray-500 rounded">
                            Créer une nouvelle habitation
                        </button>
                    </form>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <example-component/>
    </div>
</x-app-layout>

<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>

<script>
    const el = document.getElementsByName('submitsort');
    if (el.length){
        //el[0].classList.remove("bg-blue-500");
    }
</script>