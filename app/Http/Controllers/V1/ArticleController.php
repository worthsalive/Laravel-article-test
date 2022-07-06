<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Tag;
use Illuminate\Support\Str;
/**
     * @OA\Get(
     ** path="/api/articles",
     *   tags={"Articles"},
     *   summary="Get All available articles 10 per page",
     *   operationId="Get articles",
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Articles = Article::paginate(10);
        return $Articles;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $tags = $request->input('tags');
        //lets create all the tags if not already exists in our database
        foreach($tags as $tag){
            if(!Tag::where('name','=',$tag)->first()){
                Tag::create([
                    'name' => Str::ucfirst($tag),
                    'slug' => Str::slug($tag)
                ]);
            }
        }
        //create the article with the tags
        $article = Article::create([
            'title' => $request->input('title'),
            'full_text' => $request->input('full_text'),
            'cover' => $request->input('cover'),
            'short_text' => Str::substr($request->input('full_text'), 0, 99),
            'tags' => implode(',',$request->input('tags'))

        ]);

        return response()->json($article, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return response($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $article->update($request->all());

        return response()->json($article, 200);
    }

    /**
     * Increment the like for an article
     */
    public function likeCounter(Article $article){
        $likes = $article->likes_counter;
        $likes += 1;
        $article->likes_counter = $likes;
        $article->save();
        return response(['likes' => $article->likes_counter]);
    }

    /**
     * Increment the view counter for an article
     */
    public function viewCounter(Article $article){
        $views = $article->views_counter;
        $views += 1;
        $article->views_counter = $views;
        $article->save();
        return response(['views' => $article->views_counter]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return response()->json(null, 204);
    }
}
