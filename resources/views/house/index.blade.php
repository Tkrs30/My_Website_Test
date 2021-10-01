<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Houses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <house-index-component />
    </div>

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
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach ($houses as $house)
                        <tr>
                            <td>{{ $house['name'] }}</td>
                            <td>{{ $house['address'] }}</td>
                            <td>{{ $house['price'] }} $</td>
                            <td>{{ $house['surface'] }} m²</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('house-edit', ['house' => $house['id']])  }}" role="button">Modifier</a>
                            </td>
                            <td>
                                <a class="btn btn-danger" href="{{ route('house-delete', ['house' => $house['id']])  }}" role="button">Supprimer</a>
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{ route('house-duplicate', ['house' => $house['id']])  }}" role="button">Dupliquer</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <div class="p-4 container text-center">
                        <a class="btn btn-primary" href="{{ route('house-create') }}" role="button">Créer une nouvelle habitation</a>
                    </div>
                </div>
            </div>
        </div>
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