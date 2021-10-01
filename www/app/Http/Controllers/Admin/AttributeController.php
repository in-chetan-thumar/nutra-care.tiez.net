<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attributes;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JsValidator;

class AttributeController extends Controller
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


        $records = resolve('attribute')->getListing($filters,true, $per_page);
        $records->appends($filters);

        $rules = [
            'attribute_name' => 'required|max:100',
        ];


        $custom_messages = [];
        $custom_attribute = [];

        $validator = JsValidator::make($rules, $custom_messages, $custom_attribute, '#form-attribute');

        if ($request->ajax()) {

            return view('admin.attribute.ajax.list', [
                'records' => $records
            ]);
        }

        return view('admin.attribute.attribute_list', ['validator' => $validator]);
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
    public function store(Request $request)
    {
        try {

            $data = [
                'attribute_name' => $request->get('attribute_name'),
            ];

            Attributes::insert($data);
            return response()->json(['status' => 'success', 'message' => 'Attribute created successfully.']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => 'Something went wrong, please try again.' . $e->getMessage()]);
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
        try {

            $record = Attributes::find($id);

            $rules = [
                'attribute_name' => 'required|max:100',
            ];

            $custom_messages = [];
            $custom_attribute = [];

            $validator = JsValidator::make($rules, $custom_messages, $custom_attribute, '#edit-attribute-form');

            return view('admin.attribute.ajax.attribute-modal', [
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
    public function update(Request $request, $id)
    {
        try {

            $data = [
                'attribute_name' => $request->get('attribute_name'),
            ];

            Attributes::find($id)->update($data);

            return response()->json(['status' => 'success', 'message' => 'Attribute updated successfully.']);
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
        try {
            $attribute = Attributes::find($id)->forceDelete();
            return response()->json(['status' => 'success', 'message' => 'Attribute deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => $e->getMessage()]);
        }
    }
}
