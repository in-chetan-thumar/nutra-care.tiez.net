<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryProductLink;
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
        $categories = Category::all();
        $filters = $request->get('filters');
        $per_page = 10;
        $filters['filters'] = $filters;


        $records = resolve('category')->getListing($filters, true, $per_page);
        $records->appends($filters);

        $rules = [
            'title' => 'required|max:100',
            'photo' => 'image',
            'category' => 'required|not_in:0'

        ];


        $custom_messages = [];
        $custom_attribute = [];

        $validator = JsValidator::make($rules, $custom_messages, $custom_attribute, '#form-category');

        if ($request->ajax()) {

            return view('admin.category.ajax.list', [
                'records' => $records
            ]);
        }

        return view('admin.category.category_list', ['validator' => $validator,'categories' => $categories]);
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
                'parent_category_id' => $request->category ?? 0 ,
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
            $categories = Category::whereDoesntHave('category_product_links')->get();
            $rules = [
                'title' => 'required|max:100',
                'description' => 'required',
                'photo' => 'image',
                'slug' => 'required',
                'category' => 'required|not_in:0'

            ];

            $custom_messages = [];
            $custom_attribute = [];

            $validator = JsValidator::make($rules, $custom_messages, $custom_attribute, '#edit-category-form');

            return view('admin.category.ajax.edit-modal', [
                'record' => $record,
                'validator' => $validator,
                'categories' => $categories
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
                Storage::delete($fileDir . $filename);
                $filename = basename($request->file('photo')->store($fileDir));
            }

            $data = [
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'slug' => $request->get('slug'),
                'photo' => $filename,
                'updated_by' => $user->id,
                'parent_category_id' => $request->category ?? 0 ,
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
			CategoryProductLink::where('category_id', $id)->forceDelete();
            $category = Category::find($id)->forceDelete();
            return response()->json(['status' => 'success', 'message' => 'Category deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => $e->getMessage()]);
        }
    }

    public function getCategory()
    {
        $data = [];

        $parent_category = Category::where('parent_category_id', 0)->orderBy('title', 'asc')->get();

        foreach ($parent_category as $category) {
            $parent_category_list = [];
            $parent_category_list['id'] = $category->id;
            $parent_category_list['title'] = $category->title;

            $subcategory_list[] = $this->getSubCategory($category);

            if (!empty($subcategory_list)) {
                $parentlist['sub_category'] = $subcategory_list;
            }
            $data[] = $parent_category_list;
        }

        return $data;
    }

    public function getSubCategory($category)
    {
        $data = [];

        $sub_categories = Category::where('parent_category_id', $category->id)->orderBy('title', 'asc')->get();

        if ($sub_categories->count() > 0) {
            foreach ($sub_categories as $sub_category) {
                $data[] = $sub_category;
            }
        }
        return $data;
    }

}
