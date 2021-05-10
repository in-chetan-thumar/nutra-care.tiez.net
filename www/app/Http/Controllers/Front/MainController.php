<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;
use App\Mail\ContactUsInquiryEmail;
use App\Mail\ProductInquiryMail;
use App\Models\CategoryProductLink;
use App\Models\ContactUs;
use App\Models\Inquiry;
use App\Models\InquiryProductLink;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use JsValidator;

class MainController extends Controller
{
    /**
     * Show the application Home Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        //dd(config('global'));
        return view('front.home');
    }

    /**
     * Show the application About Us Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function aboutUs()
    {
        return view('front.about-us');
    }

    /**
     * Show the application Contact Us Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactUs()
    {
        return view('front.contact-us');
    }

    /**
     * Show the application Products Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function frontProducts(Request $request)
    {
        $filters = $request->get('filters');
        $per_page = null;
        $filters['filters'] = $filters;
        $categories = resolve('category')->getAll();

        $products = resolve('product')->getListing($filters, true, $per_page);
        $products->appends($filters);

        $rules = [
            'name' => 'required|max:100',
            'email' => 'required',
            'phone' => 'required|numeric',
            'message' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ];

        $custom_messages = [];
        $custom_attribute = [];

        $validator = JsValidator::make($rules, $custom_messages, $custom_attribute, '#form-inquiry');

        if ($request->ajax()) {

            return view('front.layout.partials.ajax_product_list', [
                'products' => $products,
            ]);
        }

        return view('front.front-products', compact('categories', 'validator'));
    }

    public function submitInquiry(Request $request)
    {
        $errorView = '';
        $product_lists = json_decode($request->product_list, true);

        try {

            $inquiry = Inquiry::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message,
                'created_at' => Carbon::now(),
            ]);

            foreach ($product_lists as $list) {

                if (count($list['value']['attribute_id']) != 0) {
                    foreach ($list['value']['attribute_id'] as $attribute) {
                        InquiryProductLink::create([
                            'inquiry_id' => $inquiry->id,
                            'product_id' => $list['name'],
                            'attribute_id' => $attribute
                        ]);
                    }
                } else {
                    InquiryProductLink::create([
                        'inquiry_id' => $inquiry->id,
                        'product_id' => $list['name'],
                        'attribute_id' => 0
                    ]);
                }

            }

            $params = [];
            $params['id'] = $inquiry->id;


            Mail::send(new ProductInquiryMail($params));

            $data['success'] = false;
            $data['message'] = "Inquiry Submited Successfully..!";
            $errorView = view('front.layout.partials.custom_alert_view', compact('data'))->render();

            return response()->json($errorView, 200);

        } catch (\Exception $e) {

            $data['success'] = true;
            $data['message'] = "Someting went wrong try again.!";
            $errorView = view('front.layout.partials.custom_alert_view', compact('data'))->render();
            return response()->json($errorView, 500);
        }

    }

    public function submitContactUs(ContactUsRequest $request)
    {
        try {

            $contactus = ContactUs::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'comment' => $request->message,
            ]);

            $params = [];
            $params['id'] = $contactus->id;

            Mail::send(new ContactUsInquiryEmail($params));

            return redirect()->back()->with(['status' => false, 'message' => 'Inquiry submit successfully']);

        } catch (\Exception $e) {

            return redirect()->back()->with(['status' => true, 'message' => 'Something went wrong try again.!']);
        }
    }

    public function getProductsByCategoryId($id)
    {
        $products = Product::whereHas('category_product_links', function ($query) use ($id) {
            $query->where('category_id', $id);
        })->get();

        echo view('front.layout.partials.ajax_product_list', [
            'products' => $products
        ])->render();
    }

    /**
     * Show the application Privacy Policy Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacyPolicy()
    {
        return view('front.privacy-policy');
    }

    /**
     * Show the application Terms & Conditions Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function termsConditions()
    {
        return view('front.terms-and-conditions');
    }

    public function downloadPdf($name)
    {
        $file = public_path('pdf/' . $name);
        return response()->download($file);
    }

    /**
     * Show the application Sustainability Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function sustainability()
    {
        return view('front.sustainability');
    }

    /**
     * Show the application Research & Development Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function researchDevelopment()
    {
        return view('front.research-development');
    }

}
