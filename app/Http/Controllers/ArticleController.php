<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Etudiant;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::paginate(20);
        return view('article.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("article.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'titre' => 'required|min:10|max:50|unique:articles',
            'titre_fr' => 'required|min:10|max:50|unique:articles',
            'contenu' => 'required|min:10|max:2000',
            'contenu_fr' => 'required|min:10|max:2000',
        ]);

        $article = new Article;
        $article->fill($request->all());
        $article->etudiant_id = Auth::User()->id;
        $article->save();

        return redirect(route('article.show', $article->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article->author = User::find($article->etudiant_id)->name;
        return view("article.show", ["article" => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        if (Auth::user()->id != $article->etudiant_id) {
            return redirect()->back();
        }

        return view('article.edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        if (Auth::user()->id != $article->etudiant_id) {
            return redirect()->back();
        }

        $request->validate([
            'titre' => 'required|min:10|max:50',
            'titre_fr' => 'required|min:10|max:50',
            'contenu' => 'required|min:10|max:2000',
            'contenu_fr' => 'required|min:10|max:2000',
        ]);

        $article->update([
            'titre' => $request->titre,
            'contenu'  => $request->contenu,
            'titre_fr' => $request->titre_fr,
            'contenu_fr'  => $request->contenu_fr
        ]);

        return redirect(route('article.show', $article->id))->withSuccess('Article mis à jour avec success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        if (Auth::user()->id != $article->etudiant_id) {
            return redirect()->back();
        }
        $article->delete();
        return redirect(route('article.index'));
    }
}
