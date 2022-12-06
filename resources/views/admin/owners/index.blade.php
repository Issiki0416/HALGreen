<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('オーナー一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <section class="text-gray-600 body-font">
                    <div class="container px-5 mx-auto">
                        <x-flash-message status="{{ session('status') }}" />

                        <div class="flex justify-end mb-4">
                            <button onclick="location.href='{{ route('admin.owners.create')}}'" class=" text-white bg-yellow-500 border-0 py-2 px-8 focus:outline-none hover:bg-yellow-600 rounded text-lg">登録する</button>
                        </div>
                        <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-yellow-200 rounded-tl rounded-bl">オーナー名</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-yellow-200">メールアドレス</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-yellow-200">作成日</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-yellow-200 rounded-tr rounded-br"></th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-yellow-200 rounded-tr rounded-br"></th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($owners as $owner)
                                <tr>
                                    <td class="px-4 py-3">{{ $owner->name }}</td>
                                    <td class="px-4 py-3">{{ $owner->email }}</td>
                                    <td class="px-4 py-3">{{ $owner->created_at->diffForHumans() }}</td>
                                    <td class="px-4 py-3">
                                        {{-- オーナー情報編集ボタン --}}
                                        <button onclick="location.href='{{ route('admin.owners.edit', ['owner'=> $owner->id])}} '" type="submit" class=" text-white bg-yellow-400 border-0 py-2 px-4 focus:outline-none hover:bg-yellow-500 rounded">編集</button>
                                    </td>
                                    <form id="delete_{{$owner->id}}" action="{{ route('admin.owners.destroy', ['owner'=> $owner->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <td class="px-4 py-3">
                                            {{-- オーナー情報編集ボタン --}}
                                            <a href="#" data-id="{{ $owner->id }}" onclick="deletePost(this)" type="submit" class=" text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-500 rounded">削除</a>
                                        </td>
                                    </form>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        {{ $owners->links() }}
                        </div>
                    </div>
                </section>
                    {{--  Carbonオブジェクトになっているのでメソッドが使える --}}

                    {{-- {{ $e_owner->created_at }} --}}
                    {{-- Eloquent
                    @foreach ($e_all as $e_owner)
                        {{ $e_owner->name }}
                        Carbonオブジェクトになっているのでメソッドが使える
                        {{ $e_owner->created_at->diffForHumans() }}
                        {{ $e_owner->created_at }}
                    @endforeach
                    <br>
                    Query Builder
                    @foreach ($q_get as $q_owner)
                        {{ $q_owner->name }}
                        {{-- {{ $q_owner->created_at }}
                        {{ Carbon\Carbon::parse($q_owner->created_at)->diffForHumans() }}
                    @endforeach --}}

                </div>
            </div>
        </div>
    </div>
    <script>
        function deletePost(e){
            swal({
                title: "本当に削除しますか?",
                text: "一旦削除すると復元まで時間を要します",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    document.getElementById('delete_' + e.dataset.id).submit();
                    swal("削除が完了しました", {
                    icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
        }
    </script>
</x-app-layout>
