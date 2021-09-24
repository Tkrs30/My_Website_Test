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
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Error :</strong>
                            <span class="block sm:inline">{{ $error }}</span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                            </span>
                            </div>
                        @endforeach
                    @endif
                    <h3 class="text-3xl font-normal leading-normal mt-0 mb-2 text-pink-800">
                        Nouvelle Habitation
                    </h3>
                    <form action="/houses" method="post">
                        @csrf
                        <h3 class="text-1xl font-normal leading-normal mt-0 mb-2 text-black">
                            Entrez le Nom
                        </h3>
                        <div class="mb-3 pt-0">
                            <input name="name" type="text" value="{{ old('name') }}" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full"/>
                        </div>
                        <h3 class="text-1xl font-normal leading-normal mt-0 mb-2 text-black">
                            Entrez l'adresse
                        </h3>
                        <div class="mb-3 pt-0">
                            <textarea name="address" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4"></textarea>
                        </div>
                        <h3 class="text-1xl font-normal leading-normal mt-0 mb-2 text-black">
                            Entrez le prix affiché
                        </h3>
                        <div class="mb-3 pt-0">
                            <input name="price" type="number"  class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full"/>
                        </div><h3 class="text-1xl font-normal leading-normal mt-0 mb-2 text-black">
                            Entrez la supericie
                        </h3>
                        <div class="mb-3 pt-0">
                            <input name="surface" type="number"  class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full"/>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-gray-500 rounded">
                            Valider
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
