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
                    <x-auth-validation-errors class="mb-4 text-center" :errors="$errors"  id="flash_message"/>
                    <form method="post" action="{{ route('owner.products.store')}}">
                        @csrf
                        <div class="-m-2">
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <select name="category">
                                        @foreach($categories as $category)
                                            <optgroup label="{{ $category->name }}">{{-- PrimaryCategoryの名前が表示される --}}
                                                @foreach($category->secondary as $secondary){{-- PrimaryCategoryモデルのsecondaryメソッドからとってくる --}}
                                                    <option value="{{ $secondary->id}}" >
                                                        {{ $secondary->name }}
                                                    </option>
                                                @endforeach
                                        @endforeach </select>
                                </div>
                            </div>

                            <div class="p-2 w-full flex justify-around mt-5">
                                <button type="button" onclick="location.href='{{ route('owner.products.index')}}'" class=" bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                                <button type="submit" class=" text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">登録する</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
