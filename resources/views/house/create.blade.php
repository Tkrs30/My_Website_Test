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
                            <strong class="font-bold">{{ __('messages.error') }} :</strong>
                            <span class="block sm:inline">{{ $error }}</span>
                            </div>
                        @endforeach
                    @endif
                    <h3 class="text-3xl font-normal leading-normal mt-0 mb-2 text-pink-800">
                        {{ __('messages.house') }}
                    </h3>
                    <form action="/houses" method="post">
                        @csrf
                        <h3 class="text-1xl font-normal leading-normal mt-0 mb-2 text-black">
                            {{ __('messages.enname') }}
                        </h3>
                        <div class="mb-3 pt-0">
                            <input name="name" type="text" value="{{ old('name') }}" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full"/>
                        </div>
                        <h3 class="text-1xl font-normal leading-normal mt-0 mb-2 text-black">
                            {{ __('messages.enadd') }}
                        </h3>
                        <div class="mb-3 pt-0">
                            <textarea name="address" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4"></textarea>
                        </div>
                        <h3 class="text-1xl font-normal leading-normal mt-0 mb-2 text-black">
                            {{ __('messages.enprice') }}
                        </h3>
                        <div class="mb-3 pt-0">
                            <input name="price" type="number"  class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full"/>
                        </div><h3 class="text-1xl font-normal leading-normal mt-0 mb-2 text-black">
                            {{ __('messages.ensurf') }}
                        </h3>
                        <div class="mb-3 pt-0">
                            <input name="surface" type="number"  class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full"/>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-gray-500 rounded">
                            {{ __('messages.valid') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
