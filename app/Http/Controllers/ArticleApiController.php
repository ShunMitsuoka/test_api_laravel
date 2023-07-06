<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleApiController extends Controller
{

    public function index(){
        $articles = Article::get();
        return response()->json($articles, 200);
    }

    public function show($id){
        $article = Article::where('id', $id)->first();
        return response()->json($article, 200);
    }

    public function store(Request $request){
        Article::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        return response()->json([],200);
    }

    public function update($id, Request $request){
        $article = Article::where('id', $id)->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        return response()->json($article, 200);
    }

    public function delete($id){
        Article::where('id', $id)->delete();
        return response()->json([],200);
    }
}
