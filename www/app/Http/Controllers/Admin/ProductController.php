<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryProductLink;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JsValidator, File, Storage;

class ProductController extends Controller
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

        $records = resolve('product')->getListing($filters, true, $per_page);
        $records->appends($filters);

        $categories = resolve('category')->getAll();

        $rules = [
            'title' => 'required|max:100',
            'description' => 'required',
            'photo' => 'required|image',
            'slug' => 'required',
            'categories.*' => 'required|not_in:0',
        ];

        $custom_messages = [];
        $custom_attribute = [];

        $validator = JsValidator::make($rules, $custom_messages, $custom_attribute, '#form-product');

        if ($request->ajax()) {

            return view('admin.product.ajax.list', [
                'records' => $records
            ]);
        }

        return view('admin.product.product_list', ['validator' => $validator, 'categories' => $categories]);
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
                $fileDir = config('constants.PRODUCT_PHOTO');
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

            $products = Product::create($data);

            foreach ($request->get('categories') as $category)
            {
                CategoryProductLink::create([
                    'category_id' => $category,
                    'product_id' => $products->id
                ]);
            }

            return response()->json(['status' => 'success', 'message' => 'Product created successfully.']);

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

            $record = Product::find($id);

            $rules = [
                'title' => 'required|max:100',
                'description' => 'required',
                'photo' => 'image',
                'slug' => 'required',
                'categories.*' => 'required|not_in:0',
            ];

            $categories = resolve('category')->getAll();

            $custom_messages = [];
            $custom_attribute = [];

            $validator = JsValidator::make($rules, $custom_messages, $custom_attribute, '#edit-category-form');

            return view('admin.product.ajax.edit-modal', [
                'record' => $record,
                'validator' => $validator,
                'categories' => $categories,
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
                $fileDir = config('constants.PRODUCT_PHOTO');
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
                'created_by' => $user->id,
                'photo' => $filename,
                'updated_at' => Carbon::now()
            ];

            CategoryProductLink::where('product_id',$id)->delete();

            foreach ($request->get('categories') as $category)
            {
               CategoryProductLink::create([
                    'category_id' => $category,
                    'product_id' => $id
                ]);
            }

            Product::find($id)->update($data);

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
            $product = Product::find($id)->forceDelete();
            return response()->json(['status' => 'success', 'message' => 'Product deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => $e->getMessage()]);
        }
    }
}
