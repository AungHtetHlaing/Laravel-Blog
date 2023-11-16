<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Photo;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::when(request()->has("keyword"), function($query) {
            $query->where(function (Builder $builder) {
                $keyword = request()->keyword;
                $builder->where("title", "like", "%" . $keyword . "%");
                $builder->orWhere("description", "like", "%" . $keyword . "%");
            });
        })->when(request()->has('title'), function($query) {
            $sortType = request()->title ?? 'asc';
            $query->orderBy('title', $sortType);
        })->when(request()->trash, fn($q)=> $q->onlyTrashed())->with(['category','user','photos','comments'])->paginate(7)->withQueryString();

        return view('article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {

        try{

            DB::beginTransaction();
        $article = new Article();

        if($request->hasFile('featured_image')) {
            $fileName = uniqid() . "_featured_image." . $request->file('featured_image')->getClientOriginalExtension();
            $request->file('featured_image')->storeAs('public', $fileName);
            $article->featured_image = $fileName;
        }

        $article->title =$request->title;
        $article->slug = Str::slug($request->title);
        $article->description = $request->description;
        $article->excerpt = Str::words($request->description, 30, "...");
        $article->category_id = $request->category;
        $article->user_id = Auth::id();
        $article->save();

        // saving multiple photos
        $savedPhotos = [];
        foreach ($request->photos as $key => $photo) {
            $newName = uniqid() . "_article_image." . $photo->getClientOriginalExtension();
            $photo->storeAs('public', $newName);

            $savedPhotos[$key] = [
                "article_id" => $article->id,
                "name" => $newName
            ];
            // $photo = new Photo();
            // $photo->article_id = $article->id;
            // $photo->name = $newName;
            // $photo->save();
        }


        Photo::insert($savedPhotos); // for performence
        DB::commit();
    } catch(Exception $e) {
        DB::rollBack();
    }
    return redirect()->route('article.index')->with('message', $article->title . "is created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {

        Gate::authorize('article-update', $article);



        if($request->hasFile('featured_image')) {

            Storage::delete('public/'.$article->featured_image); // if you want to delete old image

            $fileName = uniqid() . "_featured_image." . $request->file('featured_image')->getClientOriginalExtension();
            $request->file('featured_image')->storeAs('public', $fileName);
            $article->featured_image = $fileName;

        }
        $article->title =$request->title;
        $article->slug = Str::slug($request->title);
        $article->description = $request->description;
        $article->excerpt = Str::words($request->description, 30, "...");
        $article->category_id = $request->category;
        $article->update();

        // saving multiple photos
        if($request->hasFile('photos')) {
        foreach ($request->photos as $photo) {
            $newName = uniqid() . "_article_image." . $photo->getClientOriginalExtension();
            $photo->storeAs('public', $newName);

            $photo = new Photo();
            $photo->article_id = $article->id;
            $photo->name = $newName;
            $photo->save();
        }
    }

        return redirect()->route('article.index')->with('message', $article->title . "is updated");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $article = Article::withTrashed()->where('id',$id)->first();

        Gate::authorize('article-delete', $article);

        if(request('delete') === 'force') :

            if(isset($article->featured_image)) {
                Storage::delete('public/'.$article->featured_image); // if you want to delete old image
            }

            foreach($article->photos as $photo) {
                // remove from storage
                Storage::delete('public/'. $photo->name);

                // remove from table
                // $photo->delete();
            }
            // remove from table
            Photo::where('article_id', $article->id)->delete(); // for performence
            // Photo::destroy($article->photos->pluck('id'));

            Article::withTrashed()->where('id',$id)->forceDelete();
            $message = "Permented Deleted";

        elseif(request('delete') === 'restore') :
            Article::withTrashed()->where('id',$id)->restore();
            $message = "Restored";

        else:
            Article::withTrashed()->where('id',$id)->delete();
            $message = "Deleted";

        endif;
        return redirect()->route('article.index')->with('message',$message);
    }
}
