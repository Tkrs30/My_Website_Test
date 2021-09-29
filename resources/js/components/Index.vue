<template>
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
</template>

<script>

</script>
