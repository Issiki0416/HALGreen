<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            カート
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (count($products) > 0)
                        @foreach ($products as $product)
                            <div class="md:flex md:items-center mb-3">
                                <div class="md:w-3/12">
                                    @if ($product->imageFirst->filename !== null)
                                        <img src="{{ asset('storage/products/' . $product->imageFirst->filename) }}">
                                    @else
                                        <img src="">
                                    @endif
                                </div>
                                <div class="md:w-4/12 md:ml-2">{{ $product->name }}</div>
                                <div class="md:w-3/12 flex justify-around">
                                    <div>{{ $product->pivot->quantity }}</div>
                                    <div>{{ number_format($product->pivot->quantity * $product->price) }}<span
                                            class="text-sm text-gray-700">円(税込み)</span></div>
                                </div>
                                <div class="md:w-2/12">
                                    <form method="POST"
                                        action="{{ route('user.cart.delete', ['item' => $product->id]) }}">
                                        @csrf
                                        <button>
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        <div class="my-2">
                            小計: {{ number_format($total_price) }}<span
                                class="text-sm
                            text-gray-700">円(税込)</span> </div>
                        <div>
                            <button onclick="location.href='{{ route('user.cart.checkout') }}'" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">購入する
                            </button>
                        </div>
                    @else
                        カートに商品がありません
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
