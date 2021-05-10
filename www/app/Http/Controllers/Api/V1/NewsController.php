<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\News;
use App\Models\NewsCategory;

class NewsController extends Controller {

    protected $db;
    protected $response;
    protected $response_code;

    /**
     * [__construct description]
     * @param Application $app [description]
     */
    public function __construct(Application $app) {
        $this->db = $app->make('db');
        $this->response = ['status' => 'fail'];
        $this->response_code = Response::HTTP_UNPROCESSABLE_ENTITY;
    }

    /**
     * [News]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function newsCategory(Request $request){
        try {
            \DB::beginTransaction();
            $api_log_id = $this->generateApiLog($request);

            $filters = [];
			$paginate = true;
            $news_category = resolve('news-category')->getListing($filters, $paginate);
            
            $response = [];
            foreach($news_category as  $category){
                $response['list'][] = [
                    'category_title' => $category->category,
                    'category_id' => $category->id,
                ];
            }
            $response['paginate']['total'] = $news_category->total();
            $response['paginate']['per_page'] = $news_category->perPage();
            $response['paginate']['current_page'] = $news_category->currentPage();
            $response['paginate']['last_page'] = $news_category->lastPage();

            $this->response_code = Response::HTTP_OK;
            $this->response['status'] = 'success';
            $this->response['data'] = $response;
            $this->response['message'] = "";
        

            \DB::commit();

        } catch (\Exception $e) {
            \DB::rollback();
            $this->response['message'] = $e->getMessage();
        }

        $params = ['status_code' => $this->response_code, 'response' => $this->response];
        $this->updateApiLog($api_log_id, $params);
        return response()->json($this->response, $this->response_code);
    }
	
	/**
     * [News]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function newsList(Request $request){
        try {
            \DB::beginTransaction();
            $api_log_id = $this->generateApiLog($request);

            //$filters['category'] = $news_category_id;
            $filters = [];
            $per_page = 20;
			$paginate = true;
            $news_list = resolve('news')->getListing($filters, $paginate, $per_page);

            $response = [];
            foreach($news_list as  $news){
                if($news->cover_type == "IMAGE"){
                    $news_cover_image = $news->news_doc_url;
                } else {
                    $news_cover_image = $news->cover_video_url;
                }
                $response['list'][] = [
                    'title' => $news->title,
                    'news_id' => $news->id,
                    'news_cover_image' => $news_cover_image,
                    'cover_type' => $news->cover_type
                ];
            }
            $response['paginate']['total'] = $news_list->total();
            $response['paginate']['per_page'] = $news_list->perPage();
            $response['paginate']['current_page'] = $news_list->currentPage();
            $response['paginate']['last_page'] = $news_list->lastPage();

            $this->response_code = Response::HTTP_OK;
            $this->response['status'] = 'success';
            $this->response['data'] = $response;
            $this->response['message'] = "";
        

            \DB::commit();

        } catch (\Exception $e) {
            \DB::rollback();
            $this->response['message'] = $e->getMessage();
        }

        $params = ['status_code' => $this->response_code, 'response' => $this->response];
        $this->updateApiLog($api_log_id, $params);
        return response()->json($this->response, $this->response_code);
    }

	/**
     * [News Detail]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function newsDetail($news_id, Request $request){
        try {
            \DB::beginTransaction();
            $api_log_id = $this->generateApiLog($request);

            $news = News::find($news_id);

            if(!empty($news)){
                $response = [
                    'id' => $news->id,
                    'title' => $news->title,
                    'description' => $news->description,
                    'cover_type' => $news->cover_type
                ];
                
                if($news->cover_type == "IMAGE"){
                    $response['news_cover_image'] =  $news->news_doc_url;
                } else {
                    $response['cover_video_url'] =  $news->cover_video_url;
                }
                $this->response_code = Response::HTTP_OK;
                $this->response['status'] = 'success';
                $this->response['data'] = $response;
                $this->response['message'] = "";
            
            } else {

                $this->response['message'] = "Invalid news id";
            }

            \DB::commit();

        } catch (\Exception $e) {
            \DB::rollback();
            $this->response['message'] = $e->getMessage();
        }

        $params = ['status_code' => $this->response_code, 'response' => $this->response];
        $this->updateApiLog($api_log_id, $params);
        return response()->json($this->response, $this->response_code);
    }
	
}
