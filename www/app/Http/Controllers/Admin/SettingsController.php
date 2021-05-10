<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use JsValidator;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = $rules = $custom_attribute = $custom_messages = [];

        $settings = Settings::groupby('section_title')->orderBy('section_sort_no', 'asc')->get();

        foreach ($settings as $key => $list) {
            $records[$key]['section_title'] = $list->section_title;
            $records[$key]['section_data'] = Settings::select('field_title', 'input_type', 'column', 'value', 'rules')->where('section_title', $list->section_title)->orderBy('sort_no')->get();
        }


        return view('admin.setting.setting_list', compact('records'));

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
        $settings = Settings::all();
        $rules = [];

        // get rules from settings table

        foreach ($settings as $list) {
            $rules[$list->column] = $list->rules;
        }

        $this->validate($request, $rules);

        try {
            foreach ($settings as $list) {
                Settings::where('id', $list->id)->update(['value' => $request[$list->column], 'updated_by' => auth()->id()]);
            }
            return redirect()->back()->with(['success'=>true,'message'=>'Settings Updated..!']);


        } catch (\Exception $e) {
            return redirect()->back()->with(['success'=>false,'message'=>$e->getMessage()]);

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
