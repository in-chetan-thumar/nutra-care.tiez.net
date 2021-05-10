<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JsValidator;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = 10;

        $records = resolve('pages')->getListing(true, $per_page);

        $rules = [
            'page_title' => 'required|max:100',
            'page_slug' => 'required|max:30',
            'page_text' => 'required',
            'meta_tag' => 'required',
            'meta_description' => 'required',
        ];

        $custom_messages = [];
        $custom_attribute = [];

        $validator = JsValidator::make($rules, $custom_messages, $custom_attribute, '#form-page');

        if ($request->ajax()) {
            return view('admin.page.ajax.list', [
                'records' => $records
            ]);
        }

        return view('admin.page.page_list', ['validator' => $validator]);
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

            $data = [
                'page_title' => $request->get('page_title'),
                'page_slug' => $request->get('page_slug'),
                'meta_tag' => $request->get('meta_tag'),
                'meta_description' => $request->get('meta_description'),
                'page_text' => $request->get('page_text'),
                'updated_by' => auth()->id(),
                'created_by' => auth()->id(),
                'created_at' => Carbon::now()
            ];

            Page::create($data);

            return response()->json(['status' => 'success', 'message' => 'Page Created successfully.']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
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

            $record = Page::find($id);

            $rules = [
                'page_title' => 'required|max:100',
                'page_slug' => 'required|max:30',
                'meta_tag' => 'required',
                'meta_description' => 'required',
                'page_text' => 'required',
            ];

            $custom_messages = [];
            $custom_attribute = [];

            $validator = JsValidator::make($rules, $custom_messages, $custom_attribute, '#edit-page-form');

            return view('admin.page.ajax.edit-modal', [
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

            $data = [
                'page_title' => $request->get('page_title'),
                'page_slug' => $request->get('page_slug'),
                'meta_tag' => $request->get('meta_tag'),
                'meta_description' => $request->get('meta_description'),
                'page_text' => $request->get('page_text'),
                'updated_by' => auth()->id(),
                'created_by' => auth()->id(),
                'updated_at' => Carbon::now()
            ];

            Page::find($id)->update($data);

            return response()->json(['status' => 'success', 'message' => 'Page updated successfully.']);

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
            $page = Page::find($id)->forceDelete();
            return response()->json(['status' => 'success', 'message' => 'Page deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => $e->getMessage()]);
        }
    }
}
