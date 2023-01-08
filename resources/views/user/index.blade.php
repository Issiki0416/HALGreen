<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品一覧
        </h2>
        <form action="{{ route('user.items.index') }}" method="GET">
            <div class="lg:flex lg:justify-around">
                <div class="lg:flex items-center">
                    <select name="category" class="mb-2 lg:mb-0 lg:mr-3">
                        <option value="0" @if (\Request::get('category') === 0)
                            selected
                        @endif>すべて</option>
                        @foreach ($categories as $category)
                            <optgroup label="{{ $category->name }}">{{-- PrimaryCategoryの名前が表示される --}}
                                @foreach ($category->secondary as $secondary)
                                    {{-- PrimaryCategoryモデルのsecondaryメソッドからとってくる --}}
                                    <option value="{{ $secondary->id }}" @if (\Request::get('category') == $secondary->id)
                                        selected
                                    @endif>
                                        {{ $secondary->name }}
                                    </option>
                                @endforeach
                        @endforeach
                    </select>
                    <div class="flex space-x-3 items-center">
                        <div><input name="keyword" class="border border-gray-500 py-2" placeholder=キーワードを入力></div>
                        <div><button
                                class="ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">検索する</button>
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div>
                        <span class="text-sm">表示順</span><br>
                        <select name="sort" class="mr-4" id="sort">
                            <option value="{{ \Constant::SORT_ORDER_LIST['recommend'] }}"
                                @if (\Request::get('sort') === \Constant::SORT_ORDER_LIST['recommend']) selected @endif>おすすめ順
                            </option>
                            <option value="{{ \Constant::SORT_ORDER_LIST['higherPrice'] }}"
                                @if (\Request::get('sort') === \Constant::SORT_ORDER_LIST['higherPrice']) selected @endif>料金の高い順
                            </option>
                            <option value="{{ \Constant::SORT_ORDER_LIST['lowerPrice'] }}"
                                @if (\Request::get('sort') === \Constant::SORT_ORDER_LIST['lowerPrice']) selected @endif>料金の安い順
                            </option>
                            <option value="{{ \Constant::SORT_ORDER_LIST['later'] }}"
                                @if (\Request::get('sort') === \Constant::SORT_ORDER_LIST['later']) selected @endif>新しい順
                            </option>
                            <option value="{{ \Constant::SORT_ORDER_LIST['older'] }}"
                                @if (\Request::get('sort') === \Constant::SORT_ORDER_LIST['older']) selected @endif>古い順
                            </option>
                        </select>
                    </div>

                    <div>
                        <span class="text-sm">表示件数</span><br>
                        <select name="pagination" id="pagination">
                            <option value="{{ \Constant::PAGINATION_LIST['10'] }}"
                                @if (\Request::get('pagination') === \Constant::PAGINATION_LIST['10']) selected @endif>10件
                            </option>
                            <option value="{{ \Constant::PAGINATION_LIST['20'] }}"
                                @if (\Request::get('pagination') === \Constant::PAGINATION_LIST['20']) selected @endif>20件
                            </option>
                            <option value="{{ \Constant::PAGINATION_LIST['30'] }}"
                                @if (\Request::get('pagination') === \Constant::PAGINATION_LIST['30']) selected @endif>30件
                            </option>
                            <option value="{{ \Constant::PAGINATION_LIST['40'] }}"
                                @if (\Request::get('pagination') === \Constant::PAGINATION_LIST['40']) selected @endif>40件
                            </option>
                            <option value="{{ \Constant::PAGINATION_LIST['50'] }}"
                                @if (\Request::get('pagination') === \Constant::PAGINATION_LIST['50']) selected @endif>50件
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </form>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="flex flex-wrap">
                        @foreach ($products as $product)
                            <div class="w-1/4 p-2 md:p-4">
                                <a href="{{ route('user.items.show', ['item' => $product->id]) }}">
                                    <div class="border rounded-md p-2 md:p-4">
                                        <x-thumbnail filename="{{ $product->filename ?? '' }}" type="products" />
                                        <div class="mt-4">
                                            <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">
                                                {{ $product->category }}</h3>
                                            <h2 class="text-gray-900 title-font text-lg font-medium">
                                                {{ $product->name }}</h2>
                                            <p class="mt-1">{{ number_format($product->price) }} <span
                                                    class="text-sm text-gray-700">円(税込み)</span> </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{ $products->appends([
                        'sort' => \Request::get('sort'),
                        'pagination' => \Request::get('pagination'),
                    ])->links() }}
            </div>
        </div>
    </div>
    <script>
        const sort = document.getElementById('sort');
        sort.addEventListener('change', () => {
            sort.form.submit();
        });


        const pagination = document.getElementById('pagination');
        pagination.addEventListener('change', () => {
            sort.form.submit();
        });
    </script>
</x-app-layout>
