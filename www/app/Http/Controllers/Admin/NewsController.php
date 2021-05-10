<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use JsValidator, File, Storage;
use Carbon\Carbon;
use App\Models\News;
use App\Http\Requests\NewsRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->get('filters');
        $per_page = 10;

        $records = resolve('news')->getListing($filters, true, $per_page);
        $filters['filters'] = $filters;
        $records->appends($filters);

        $news_category = \App\Models\NewsCategory::get()->pluck('category','id');

        if($request->ajax()){
            return view('admin.news.ajax.list', [
                'records' => $records,
                'news_category' => $news_category
            ]);
        }
        return view('admin.news.list', ['news_category' => $news_category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        try{
            $user = \Auth::user();
            $filename = "";
            if($request->hasFile('news_doc')) {
                $fileDir = config('constants.NEWS_PHOTO');
                if (!File::exists($fileDir)){
                    Storage::makeDirectory($fileDir,0777);
                }

                $filename = basename($request->file('news_doc')->store($fileDir));
            }

            $data = [
                'news_category_id' => $request->get('category'),
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'news_doc' => $filename,
                'cover_type' => $request->get('cover_type'),
                'cover_video_url' => $request->get('cover_video_url', ''),
                'created_at' => Carbon::now(),
                'created_by' => $user->id
            ];

            News::insert($data);
            return response()->json(['status' => 'success', 'message' => 'News created successfully.']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => 'Something went wrong, please try again.'. $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $rules = [
                'category' => 'required',
                'title' => 'required',
                'description' => 'required',
                'news_doc' => 'required',
                'doc_type' => 'required',
            ];
            $custom_messages = [];
            $custom_attribute = ['category' => 'news category'];
            $validator = JsValidator::make($rules,$custom_messages,$custom_attribute,'#edit-news-form');

            $other_js_code = "<script src='//cdn.gaic.com/cdn/ui-bootstrap/0.58.0/js/lib/ckeditor/ckeditor.js'></script>
            <script>
                  // Replace the <textarea id='editor1'> with a CKEditor
               // instance, using default configuration.
               CKEDITOR.editorConfig = function (config) {
                  config.language = 'es';
                  config.uiColor = '#F7B42C';
                  config.height = 300;
                  config.toolbarCanCollapse = true;
                  config.removePlugins = 'toolbar';
               };
               CKEDITOR.replace('description_edit');
            </script>";

            //$record = News::with('category')->where('id', $id)->first();
			$record = News::where('id', $id)->first();
            $news_category = \App\Models\NewsCategory::get()->pluck('category','id');

            return view('admin.news.ajax.edit-modal', [
                'record' => $record,
                'news_category' => $news_category,
                'validator' => $validator,
                'other_js_code' => $other_js_code
            ]);

        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $id)
    {
        try{
            $user = \Auth::user();

            $filename = "";
            if($request->hasFile('news_doc')) {
                $fileDir = config('constants.NEWS_PHOTO');
                if (!File::exists($fileDir)){
                    Storage::makeDirectory($fileDir,0777);
                }

                $filename = basename($request->file('news_doc')->store($fileDir));
            }
            $data = [
                'news_category_id' => $request->get('category'),
                'title' => $request->get('title'),
                'description' => $request->get('description_edit'),
                'news_doc' => $filename,
                'cover_type' => $request->get('cover_type'),
                'cover_video_url' => $request->get('cover_video_url', ''),
                'updated_at' => Carbon::now(),
                'updated_by' => $user->id
            ];

            News::where('id', $id)->update($data);
            return response()->json(['status' => 'success', 'message' => 'News updated successfully.']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $news = News::find($id)->forceDelete();
            return response()->json(['status' => 'success', 'message' => 'News deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
        }
    }
}
