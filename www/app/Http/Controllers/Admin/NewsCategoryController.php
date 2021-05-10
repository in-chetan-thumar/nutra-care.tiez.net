<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JsValidator;
use Carbon\Carbon;
use App\Models\NewsCategory;
use App\Http\Requests\NewsCategoryRequest;

class NewsCategoryController extends Controller
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

        $records = resolve('news-category')->getListing($filters, true, $per_page);
        $filters['filters'] = $filters;
        $records->appends($filters);

        if($request->ajax()){
            return view('admin.newscategory.ajax.list', [
                'records' => $records,
            ]);
        }
        return view('admin.newscategory.list');
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
    public function store(NewsCategoryRequest $request)
    {
        try{
            $user = \Auth::user();
            $data = [
                'category' => $request->get('category'),
                'created_at' => Carbon::now(),
                'created_by' => $user->id
            ];

            NewsCategory::insert($data);
            return response()->json(['status' => 'success', 'message' => 'News category created successfully.']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
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
                'category' => 'required|min:6|max:100|unique:news_category,category,'.$id,
            ];
            $custom_messages = [];
            $custom_attribute = [];
            $validator = JsValidator::make($rules,$custom_messages,$custom_attribute,'#edit-news-category-form');

            $record = NewsCategory::where('id', $id)->first();

            return view('admin.newscategory.ajax.edit-modal', [
                'record' => $record,
                'validator' => $validator
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
    public function update(NewsCategoryRequest $request, $id)
    {
        try{
            $user = \Auth::user();
            $data = [
                'category' => $request->get('category'),
                'updated_at' => Carbon::now(),
                'updated_by' => $user->id
            ];

            NewsCategory::where('id', $id)->update($data);
            return response()->json(['status' => 'success', 'message' => 'News category updated successfully.']);

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
            $news_category = NewsCategory::find($id)->forceDelete();
            return response()->json(['status' => 'success', 'message' => 'News category deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
        }
    }
}
