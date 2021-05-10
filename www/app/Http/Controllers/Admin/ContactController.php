<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Mail\VirtualConsultationsMail;
use App\Models\ContactUs;
use App\Models\NewsCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use JsValidator;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = 10;

        $records = resolve('contact')->getListing(true, $per_page);

        $rules = [
            'description' => 'required|min:6|max:100',
        ];
        $custom_messages = [];
        $custom_attribute = [];
        $validator = JsValidator::make($rules,$custom_messages,$custom_attribute,'#form-contact');

        if ($request->ajax()) {
            return view('admin.contact.ajax.list', [
                'records' => $records
            ]);
        }

        return view('admin.contact.contact_list',['validator' => $validator]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        try{

            $data = [
                'replay' => $request->get('description'),
                'updated_by' => auth()->id(),
                'created_by' => auth()->id()
            ];

            ContactUs::find($id)->update($data);

            $params = [];
            $params['id'] = $id;

            Mail::send(new ContactMail($params));

            return response()->json(['status' => 'success', 'message' => 'News category updated successfully.']);

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
            $contact = ContactUs::find($id)->forceDelete();
            return response()->json(['status' => 'success', 'message' => 'contact deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => $e->getMessage()]);
        }
    }
}
