@extends('layouts.layout')

@section('title', '投稿画面')

@section('content')
<div class="flex justify-center items-center w-full">
    <div class=" w-[800px] bg-slate-50 shadow-md px-10 py-10 rounded-md">
        <div>
            <label for="title" class=" text-lg font-bold">タイトル</label>
            <input type="text" id="title">
        </div>
        <div class="mt-2">
            <label for="content" class=" text-lg font-bold">内容</label>
            <textarea name="" id="content" cols="30" rows="10"></textarea>
        </div>
        <div class="mt-2 text-right">
            <button type="button" class=" bg-cyan-500 text-white rounded-md px-4 py-1" onclick="post()">投稿</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function post(params) {
        if(!confirm('投稿してよろしいですか？')) {
            return;
        }
        openLoading();
        const data = {
            'title' : document.getElementById('title').value,
            'content' : document.getElementById('content').value,
        }
        axios.post("http://localhost/api/article", data)
        // thenで成功した場合の処理
        .then(response => {
            console.log(response);
            alert('投稿に成功しました。');
            window.location.href = "{{route('list')}}";
        })
        // catchでエラー時の挙動を定義
        .catch(err => {
            console.log(err);
            alert('投稿に失敗しました。');
        })
        .finally(() => {
            closeLoading();
        });
    }
</script>
@endpush