<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JsValidator, File, Storage;

class CategoryController extends Controller
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
        $filters['filters'] = $filters;


        $records = resolve('category')->getListing($filters,true, $per_page);
        $records->appends($filters);

        $rules = [
            'title' => 'required|max:100',
            'description' => 'required',
            'photo' => 'required|image',
            'slug' => 'required',
        ];


        $custom_messages = [];
        $custom_attribute = [];

        $validator = JsValidator::make($rules, $custom_messages, $custom_attribute, '#form-category');

        if ($request->ajax()) {

            return view('admin.category.ajax.list', [
                'records' => $records
            ]);
        }

        return view('admin.category.category_list', ['validator' => $validator]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = \Auth::user();
            $filename = "";
            if ($request->hasFile('photo')) {
                $fileDir = config('constants.CATEGORY_PHOTO');
                if (!File::exists($fileDir)) {
                    Storage::makeDirectory($fileDir, 0777);
                }

                $filename = basename($request->file('photo')->store($fileDir));
            }

            $data = [
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'slug' => $request->get('slug'),
                'photo' => $filename,
                'created_by' => $user->id,
                'created_at' => Carbon::now()
            ];

            Category::insert($data);
            return response()->json(['status' => 'success', 'message' => 'Category created successfully.']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => 'Something went wrong, please try again.' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $record = Category::find($id);

            $rules = [
                'title' => 'required|max:100',
                'description' => 'required',
                'photo' => 'image',
                'slug' => 'required',
            ];

            $custom_messages = [];
            $custom_attribute = [];

            $validator = JsValidator::make($rules, $custom_messages, $custom_attribute, '#edit-category-form');

            return view('admin.category.ajax.edit-modal', [
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
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $data = [];
            $user = \Auth::user();
            $filename = $request->get('photo_name');
            if ($request->hasFile('photo')) {
                $fileDir = config('constants.CATEGORY_PHOTO');
                if (!File::exists($fileDir)) {
                    Storage::makeDirectory($fileDir, 0777);
                }
                Storage::delete($fileDir.$filename);
                $filename = basename($request->file('photo')->store($fileDir));
            }

            $data = [
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'slug' => $request->get('slug'),
                'photo' => $filename,
                'updated_by' => $user->id,
                'updated_at' => Carbon::now()
            ];

            Category::find($id)->update($data);

            return response()->json(['status' => 'success', 'message' => 'Category updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category = Category::find($id)->forceDelete();
            return response()->json(['status' => 'success', 'message' => 'Category deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => $e->getMessage()]);
        }
    }
}
