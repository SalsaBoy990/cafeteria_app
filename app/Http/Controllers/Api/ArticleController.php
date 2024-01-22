<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ArticleStoreRequest;
use App\Http\Resources\ArticleResource;
use App\Http\Traits\Api\ApiResponseTrait;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    use ApiResponseTrait;

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
       // return $this->respondWithResourceCollection(ArticleResource::collection(Article::all()));
        return $this->respondWithResourceCollection(ArticleResource::collection(Article::paginate(10)));
    }


    /**
     * @param Article $article
     * @return JsonResponse
     */
    public function show(Article $article): JsonResponse
    {
        return $this->respondWithResource(new ArticleResource($article));

    }


    /**
     * @param ArticleStoreRequest $request
     * @return JsonResponse
     */
    public function store(ArticleStoreRequest $request): JsonResponse
    {
        $article = Article::create($request->all());

        return $this->respondCreated(new ArticleResource($article));
        // return response()->json($article, 201);
    }


    /**
     * @param Request $request
     * @param Article $article
     * @return JsonResponse
     */
    public function update(Request $request, Article $article): JsonResponse
    {
        $article->update($request->all());

        return response()->json($article);
    }


    /**
     * @param Article $article
     * @return JsonResponse
     */
    public function delete(Article $article): JsonResponse
    {
        $article->delete();

        return response()->json(null, 204);
    }
}
