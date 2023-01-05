<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="md:flex md:justify-around">
                        <div class="md:w-1/2 pt-6">
                            {{-- <x-thumbnail filename="{{ $product->imageFirst->filename ?? '' }}" type="products" /> --}}
                            <div class="swiper-container">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <!-- Slides -->
                                    <div class="swiper-slide">
                                        @if ($product->imageFirst->filename !== null)
                                            <img
                                                src="{{ asset('storage/products/' . $product->imageFirst->filename) }}">
                                        @else
                                            <img src="">
                                        @endif
                                    </div>
                                    <div class="swiper-slide">
                                        @if ($product->imageSecond->filename !== null)
                                            <img
                                                src="{{ asset('storage/products/' . $product->imageSecond->filename) }}">
                                        @else
                                            <img src="">
                                        @endif
                                    </div>
                                    <div class="swiper-slide">
                                        @if ($product->imageThird->filename !== null)
                                            <img
                                                src="{{ asset('storage/products/' . $product->imageThird->filename) }}">
                                        @else
                                            <img src="">
                                        @endif
                                    </div>
                                    <div class="swiper-slide">
                                        @if ($product->imageFourth->filename !== null)
                                            <img
                                                src="{{ asset('storage/products/' . $product->imageFourth->filename) }}">
                                        @else
                                            <img src="">
                                        @endif
                                    </div>

                                </div>
                                <!-- If we need pagination -->
                                <div class="swiper-pagination"></div>

                                <!-- If we need navigation buttons -->
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>

                                <!-- If we need scrollbar -->
                                <div class="swiper-scrollbar"></div>
                            </div>
                        </div>
                        <div class="md:w-1/2 ml-5">
                            <h2 class="text-sm mb-4 title-font text-gray-500 tracking-widest">
                                {{ $product->category->name }}
                            </h2>
                            <h1 class="text-gray-900 text-3xl title-font font-medium mb-4">{{ $product->name }}</h1>
                            <p class="mb-4 leading-relaxed">{{ $product->information }}</p>
                            <div class="pb-5 border-b-2 border-gray-100">
                                <div class="mr-7 flex items-center">
                                    <span class="mr-3">数量</span>
                                    <div class="relative">
                                        <select
                                            class="rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base pl-3 pr-10">
                                            <option>SM</option>
                                            <option>M</option>
                                            <option>L</option>
                                            <option>XL</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center mt-7">
                                <div class="mr-7">
                                    <span
                                        class="title-font font-medium text-2xl text-gray-900">{{ number_format($product->price) }}<span
                                            class="text-sm text-gray-700">円(税込み)</span></span>
                                </div>
                                <div class="flex items-center">
                                    <button
                                        class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">カートに入れる
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="{{ asset('js/swiper.js') }}"></script>
</x-app-layout>
