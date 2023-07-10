@extends('layouts.layout')

@section('title', '一覧画面')

@section('content')
<div class="px-10">
    <div class=" grid grid-cols-12 gap-5" id="table_body">
    </div>
</div>
<!-- モーダル要素 -->
<div id="modal_container" class="">
    <div id="modal">
        <div class=" text-right text-xl">
            <span onclick="closeModal()" class="close-btn">×</span>
        </div>
        <div>
            <label for="title" class=" text-lg font-bold">タイトル</label>
            <input type="text" id="title">
        </div>
        <div class="mt-2">
            <label for="content" class=" text-lg font-bold">内容</label>
            <textarea name="" id="content" cols="30" rows="10"></textarea>
        </div>
        <div class="mt-2 text-right">
            <input type="hidden" id="updated_id">
            <button type="button" onclick="update()" class=" bg-green-500 text-white rounded-md px-4 py-1">更新</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    window.onload = async () => {
        loadList();
    }

    function loadList() {
        openLoading();
        axios.get("http://localhost/api/articles")
        .then(response => {
            const articles = response.data;
            makeTableBody(articles);
        })
        .catch(err => {
            console.log(err);
        }).finally(() => {
            closeLoading();
        });
    }

    function makeTableBody(articles) {
        let html = ``;
        articles.forEach(article => {
            html += `
                <div class=" col-span-4 shadow-lg rounded-md px-4 py-4 bg-slate-50">
                    <div class="text-xl font-bold">
                        ${article.title}
                    </div>
                    <div class="mt-2 text-sm text-slate-600">
                        ${article.created_at}
                    </div>
                    <div class="mt-2">
                        ${replaceIndent(article.content)}
                    </div>
                    <div class="flex justify-between mt-4">
                        <button type="button" class=" bg-cyan-500 text-white rounded-md px-4 py-1" onclick="opneUpdateModal(${article.id})">編集</button>
                        <button type="button" class=" bg-rose-500 text-white rounded-md px-4 py-1" onclick="deleteArticle(${article.id})">削除</button>
                    </div>
                </div>
            `;
        });
        document.getElementById('table_body').innerHTML = html;
    }

    function replaceIndent(text){
        return text.replace(/\n/g, '<br>');
    }

    // 更新関連処理ここから
    function opneUpdateModal(id) {
        openModal();
        setValue(id);
    }

    function setValue(id) {
        openLoading();
        axios.get("http://localhost/api/article/" + id)
        .then(response => {
            document.getElementById('updated_id').value = id;
            document.getElementById('title').value = response.data.title;
            document.getElementById('content').value = response.data.content;
        })
        .catch(err => {
            alert('記事情報の取得に失敗しました。');
        }).finally(() => {
            closeLoading();
        });
    }

    function clearValue() {
        document.getElementById('updated_id').value = '';
        document.getElementById('title').value = '';
        document.getElementById('content').value = '';
    }

    function update(params) {
        if (!confirm('更新してよろしいですか？')) {
            return;
        }
        openLoading();
        const id = document.getElementById('updated_id').value;
        const data = {
            'title' : document.getElementById('title').value,
            'content' : document.getElementById('content').value,
        }
        axios.put("http://localhost/api/article/"+id, data)
        // thenで成功した場合の処理
        .then(response => {
            alert('更新に成功しました。');
            clearValue();
            closeModal();
            closeLoading();
            loadList();
        })
        // catchでエラー時の挙動を定義
        .catch(err => {
            console.log(err);
            alert('更新に失敗しました。');
            closeLoading();
        });
    }
    // 更新関連処理ここまで

    // 削除関連処理ここから
    function deleteArticle(id) {
        if(confirm('削除してよろしいですか？')){
            openLoading();
            axios.delete("http://localhost/api/article/" + id)
            .then(response => {
                alert('削除に成功しました。');
            })
            .catch(err => {
                alert('削除に失敗しました。');
            })
            .finally(() => {
                closeLoading();
                loadList();
            });
        }
    }
    // 削除関連処理ここまで

    // モーダル関連処理ここから
    function openModal() {
        const modal = document.getElementById('modal_container');
        modal.classList.add('open');
    }
    function closeModal() {
        const modal = document.getElementById('modal_container');
        clearValue();
        modal.classList.remove('open');
    }
    // 削除関連処理ここまで
</script>
@endpush