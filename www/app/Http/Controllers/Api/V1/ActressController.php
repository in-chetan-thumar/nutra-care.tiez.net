<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
//use GuzzleHttp\Client;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

//use App\User;
use App\Models\Wallpaper;
use App\Models\WallpaperCategory;
use App\Models\UserAccessToken;
use App\Models\UserFavoriteWallpaper;
use App\Models\WallpaperComment;

use App\Http\Requests\Api\V1\AddToFavoriteRequest;
use App\Http\Requests\Api\V1\WallpaperCommentRequest;
use App\Events\FcmEvent;
use Carbon\Carbon;

class ActressController extends Controller {

    protected $auth;
    protected $db;
    protected $response;
    protected $response_code;

    /**
     * [__construct description]
     * @param Application $app [description]
     */
    public function __construct(Application $app) {
        $this->auth = $app->make('auth');
        $this->db = $app->make('db');
        $this->response = ['status' => 'fail'];
        $this->response_code = Response::HTTP_UNPROCESSABLE_ENTITY;
    }

    /**
     * [A to Z Actress]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function atozActress(Request $request){
        try {
            \DB::beginTransaction();
            $api_log_id = $this->generateApiLog($request);

            $pare_page = 40;
            $paginate = true;
            $actoress = resolve('wallpaper-category')->atozActressListing($paginate, $pare_page);
            
            $response = [];
            foreach($actoress as $actores){
                $response['list'][] = [
                    'title' => $actores->category,
                    'id' => $actores->id,
                ];
            }
            $response['paginate']['total'] = $actoress->total();
            $response['paginate']['per_page'] = $actoress->perPage();
            $response['paginate']['current_page'] = $actoress->currentPage();
            $response['paginate']['last_page'] = $actoress->lastPage();

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
     * [Latest Actress]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function latestActressWallpaperCategory(Request $request){
        try {
            \DB::beginTransaction();
            $api_log_id = $this->generateApiLog($request);

            $pare_page = 20;
            $paginate = true;
            $actoress = resolve('wallpaper-category')->latestWallpaperUploadedActressCategoryListing($paginate, $pare_page);

            $response = [];
            foreach($actoress as $actoress_category){
                $actoress_category_obj = WallpaperCategory::where('parent_id', $actoress_category->parent_id)
                ->orderBy('last_wallpaper_uploaded_at', 'DESC')
                ->first();

                $response['list'][] = [
                    'title' => $actoress_category_obj->parent_category_title,
                    'id' => $actoress_category_obj->parent_id,
                    'image' => $actoress_category_obj->category_thumbnail_url,
                ];
            }
            $response['paginate']['total'] = $actoress->total();
            $response['paginate']['per_page'] = $actoress->perPage();
            $response['paginate']['current_page'] = $actoress->currentPage();
            $response['paginate']['last_page'] = $actoress->lastPage();
            
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
     * [Popular Actress]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function popularActressWallpaperCategory(Request $request){
        try {
            \DB::beginTransaction();
            $api_log_id = $this->generateApiLog($request);

            $pare_page = 20;
            $paginate = true;
            $actoress = resolve('wallpaper-category')->popularWallpaperUploadedActressCategoryListing($paginate, $pare_page);

            $response = [];
            foreach($actoress as $actoress_category){
                $actoress_category_obj = WallpaperCategory::where('parent_id', $actoress_category->parent_id)
                ->orderBy('last_wallpaper_uploaded_at', 'DESC')
                ->first();

                $response['list'][] = [
                    'title' => $actoress_category_obj->parent_category_title,
                    'id' => $actoress_category_obj->parent_id,
                    'image' => $actoress_category_obj->category_thumbnail_url,
                ];
            }
            $response['paginate']['total'] = $actoress->total();
            $response['paginate']['per_page'] = $actoress->perPage();
            $response['paginate']['current_page'] = $actoress->currentPage();
            $response['paginate']['last_page'] = $actoress->lastPage();
            
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
     * [Actress Category]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function actressWallpaperCategory($actress_id, Request $request){
        try {
            \DB::beginTransaction();
            $api_log_id = $this->generateApiLog($request);

            $pare_page = 20;
            $filters['category'] = $actress_id;
            $paginate = true;
            $actoress = resolve('wallpaper-category')->getListing($filters, $paginate, $pare_page);

            $response = [];
            foreach($actoress as $actoress_category){
                $response['list'][] = [
                    'title' => $actoress_category->category,
                    'id' => $actoress_category->id,
                    'image' => $actoress_category->wallpaper->last()->wallpaper_thumb_url,
                ];
                $actoress_category->increment('views');
            }
            $response['paginate']['total'] = $actoress->total();
            $response['paginate']['per_page'] = $actoress->perPage();
            $response['paginate']['current_page'] = $actoress->currentPage();
            $response['paginate']['last_page'] = $actoress->lastPage();
            
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
     * [Wallpaper List]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function wallpaperList($actress_sub_category_id, Request $request){
        try {
            \DB::beginTransaction();
            $api_log_id = $this->generateApiLog($request);

            $pare_page = 10;
            $filters['sub_category'] = $actress_sub_category_id;
            $paginate = true;
            $wallpapers = resolve('wallpaper')->getListing($filters, $paginate, $pare_page);

            $response = [];
            foreach($wallpapers as $wallpaper){
                $response['list'][] = [
                    'title' => $wallpaper->title,
                    'id' => $wallpaper->id,
                    'image' => $wallpaper->wallpaper_thumb_url,
                    'org_image' => $wallpaper->wallpaper_url,
                ];

                $wallpaper->increment('views');
            }
            $response['paginate']['total'] = $wallpapers->total();
            $response['paginate']['per_page'] = $wallpapers->perPage();
            $response['paginate']['current_page'] = $wallpapers->currentPage();
            $response['paginate']['last_page'] = $wallpapers->lastPage();

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
     * [Wallpaper Download]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateWallpaperDownloads($wallpaper_id, Request $request){
        try {
            \DB::beginTransaction();
            $api_log_id = $this->generateApiLog($request);

            $wallpaper = Wallpaper::find($wallpaper_id);
            $wallpaper->increment('downloads');

            $this->response_code = Response::HTTP_OK;
            $this->response['status'] = 'success';
            $this->response['data'] = [];
            $this->response['message'] = "Wallpaper download uppdateded successfully";

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
     * [Wallpaper Share]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateWallpaperShares($wallpaper_id, Request $request){
        try {
            \DB::beginTransaction();
            $api_log_id = $this->generateApiLog($request);

            $wallpaper = Wallpaper::find($wallpaper_id);
            $wallpaper->increment('shares');

            $this->response_code = Response::HTTP_OK;
            $this->response['status'] = 'success';
            $this->response['data'] = [];
            $this->response['message'] = "Wallpaper share uppdateded successfully";

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
     * [Wallpaper Add To Favorite]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function addToFavorite(Request $request){
        try {
            \DB::beginTransaction();
            $api_log_id = $this->generateApiLog($request);

            $access_token = $request->get('access_token');
            $wallpaper_id = $request->get('wallpaper_id');

            $access_token_obj = UserAccessToken::where('access_token', $access_token)->first();
            
            if (!empty($access_token_obj)) {

                $user_favorite_wallpaper = UserFavoriteWallpaper::where('user_id', $access_token_obj->user_id)->where('wallpaper_id', $wallpaper_id)->first();

                if(empty($user_favorite_wallpaper)){
                    $user_favorite_wallpaper = new UserFavoriteWallpaper();
                    $user_favorite_wallpaper->user_id = $access_token_obj->user_id;
                    $user_favorite_wallpaper->wallpaper_id = $wallpaper_id;
                    $user_favorite_wallpaper->save();
                }
                
                $this->response['data'] = [];
                $this->response['status'] = 'success';
                $this->response['message'] = "Wall paper added to favorite list.";
                $this->response_code = Response::HTTP_OK;
            } else {
                $this->response['message'] = 'Invalid of access token';
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

    /**
     * [Wallpaper Add To Favorite]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function removeFromFavorite(Request $request){
        try {
            \DB::beginTransaction();
            $api_log_id = $this->generateApiLog($request);

            $access_token = $request->get('access_token');
            $wallpaper_id = $request->get('wallpaper_id');

            $access_token_obj = UserAccessToken::where('access_token', $access_token)->first();
            
            if (!empty($access_token_obj)) {

                $user_favorite_wallpaper = UserFavoriteWallpaper::where('user_id', $access_token_obj->user_id)->where('wallpaper_id', $wallpaper_id)->first();

                if(!empty($user_favorite_wallpaper)){
                    $user_favorite_wallpaper->forceDelete();
                }
                
                $this->response['data'] = [];
                $this->response['status'] = 'success';
                $this->response['message'] = "Wallpaper removed from favorite list";
                $this->response_code = Response::HTTP_OK;
            } else {
                $this->response['message'] = 'Invalid of access token';
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

    /**
     * [Wallpaper Add Wallpaper Comment]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function addWallpaperComment(WallpaperCommentRequest $request){
        try {
            \DB::beginTransaction();
            $api_log_id = $this->generateApiLog($request);

            $access_token = $request->get('access_token');
            $wallpaper_id = $request->get('wallpaper_id');
            $comment = $request->get('comment');
            $parent_comment_id = $request->get('parent_comment_id', 0);


            $access_token_obj = UserAccessToken::where('access_token', $access_token)->first();
            
            if (!empty($access_token_obj)) {

                    $wallpaper_comment = new WallpaperComment();
                    $wallpaper_comment->wallpaper_id = $wallpaper_id;
                    $wallpaper_comment->comment = $comment;
                    $wallpaper_comment->parent_comment_id = $parent_comment_id;
					$wallpaper_comment->created_at = date("Y-m-d H:i:s");
					$wallpaper_comment->created_by = $access_token_obj->user_id;
                    $wallpaper_comment->save();
                
                $this->response['data'] = [];
                $this->response['status'] = 'success';
                $this->response['message'] = "Wallpaper comment saved successfully!";
                $this->response_code = Response::HTTP_OK;
            } else {
                $this->response['message'] = 'Invalid of access token';
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

    /**
     * [Wallpaper Wallpaper Comment List]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function wallpaperCommentList(Request $request){
        try {
            //\DB::beginTransaction();
            $api_log_id = $this->generateApiLog($request);

            $wallpaper_id = $request->get('wallpaper_id');


            $filters['wallpaper_id'] = $wallpaper_id;
            $filters['parent_comment_id'] = '0';
            $pare_page = 20;
            $paginate = true;
            $wallpaper_comment = resolve('wallpaper-comment')->getListing($filters, $paginate, $pare_page);
    
            $response = [];
            foreach($wallpaper_comment as $comment){
                $comment_reply = WallpaperComment::where('parent_comment_id', $comment->id)->orderBy('id', 'DESC')->get();
                $comment_reply_list = [];
                if(!empty($comment_reply)){
                    foreach($comment_reply As $reply){
                        $comment_reply_list[] = ['name' => $reply->user->name, 
												'comment' => $reply->comment, 
												'age' => Carbon::parse($reply->created_at)->diffForHumans(), 
												'created_at' => $comment->created_at];
                    }
                }
                $response['list'][] = [
                    'id' => $comment->id,
					'name' => $comment->user->name,
                    'comment' => $comment->comment,
                    'age' => Carbon::parse($comment->created_at)->diffForHumans(),
                    'no_of_reply' => $comment_reply->count(),
                    'reply_list' => $comment_reply_list
                ];
            }
            
            $response['paginate']['total'] = $wallpaper_comment->total();
            $response['paginate']['per_page'] = $wallpaper_comment->perPage();
            $response['paginate']['current_page'] = $wallpaper_comment->currentPage();
            $response['paginate']['last_page'] = $wallpaper_comment->lastPage();

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

}
