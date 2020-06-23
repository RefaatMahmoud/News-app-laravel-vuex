<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Http\Resources\NewsResource;
use App\News;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Response;

class NewsController extends Controller
{
    use ApiResponseTrait;


    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $news = News::where('user_id', auth()->user()->id)->latest()->get();
        $data = NewsResource::collection($news);
        return $this->returnSuccessResponse($data, Response::HTTP_OK);
    }

    public function store(NewsRequest $request)
    {
        try {
            $new_created = News::create(
                [
                    'title'   => $request->title,
                    'body'    => $request->body,
                    'user_id' => auth()->user()->id
                ]
            );
            $data = new NewsResource($new_created);
            return $this->returnSuccessResponse($data, Response::HTTP_CREATED);

        } catch (\Exception $e) {
            if (app()->environment()) {
                $message = $e->getMessage() . ' in file ' . $e->getFile() . ' in line' . $e->getLine();
            } else {
                $message = 'something went wrong !';
            }
            return $this->returnErrorResponse($message, Response::HTTP_NOT_FOUND);
        }
    }

    public function show(News $news)
    {
        $data = new NewsResource($news);
        return $this->returnSuccessResponse($data, Response::HTTP_OK);
    }

    public function update(NewsRequest $request, $id)
    {
        try {
            $news = News::find($id);
            if (!empty($news) && auth()->user()->id == $news->user_id) {
                if (count($request->all())) {
                    $data = [];
                    if ($request->has('title')) {
                        $data['title'] = $request->title;
                    }
                    if ($request->has('body')) {
                        $data['body'] = $request->body;
                    }
                    $news->update($data);
                }
                $data = new NewsResource($news);
                return $this->returnSuccessResponse($data, Response::HTTP_OK);
            } else {
                $message = 'this new not belongs to you so that you can\'t update it';
                return $this->returnErrorResponse($message, Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            if (app()->environment()) {
                $message = $e->getMessage() . ' in file ' . $e->getFile() . ' in line' . $e->getLine();
            } else {
                $message = 'something went wrong !';
            }
            return $this->returnErrorResponse($message, Response::HTTP_NOT_FOUND);
        }

    }

    public function destroy($id)
    {
        $news = News::find($id);
        if (!empty($news) && auth()->user()->id == $news->user_id) {
            $news->delete();
            return $this->returnSuccessResponse(
                [
                    'message' => 'product deleted successfully',
                ],
                Response::HTTP_OK
            );
        } else {
            $message = 'this new not belongs to you so that you can\'t delete it';
            return $this->returnErrorResponse($message, Response::HTTP_NOT_FOUND);
        }
    }
}
