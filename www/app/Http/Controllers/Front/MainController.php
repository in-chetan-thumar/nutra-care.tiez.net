<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;
use App\Http\Requests\InquiryRequest;
use App\Mail\ContactUsInquiryEmail;
use App\Mail\ProductInquiryMail;
use App\Models\Category;
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
        $categories = Category::where('parent_category_id', 0)->get();
        // dd($categories);
        //dd(config('global'));
        return view('front.home', compact('categories'));
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
    public function frontProducts(Request $request, $category_id = null, $sub_category_id = null)
    {
        $filters = $request->get('filters');
        // dd($filters);
        $per_page = null;
        $filters['filters'] = $filters;

        $categories = $this->buildCategoryTree();

        if (!empty($sub_category_id) && !empty($category_id)) {

            $filters['category_id'] = [$sub_category_id];
            $products = resolve('product')->getListing($filters, false, $per_page);
        } else {
            $products = resolve('product')->getAll();
        }

        //        $rules = [
        //            'name' => 'required|max:100',
        //            'email' => 'required',
        //            'phone' => 'required|numeric',
        //            'message' => 'required',
        //            'g-recaptcha-response' => 'required|captcha'
        //        ];

        $custom_messages = [];
        $custom_attribute = [];

        // $validator = JsValidator::make($rules, $custom_messages, $custom_attribute, '#form-inquiry');

        if ($request->ajax()) {
            return view('front.layout.partials.ajax_product_list', [
                'products' => $products,
            ]);
        }

        return view('front.front-products', compact('categories', 'products'));
    }


    public function productList(Request $request)
    {
        $categories = Category::where('parent_category_id', 0)->get();

        return view('front.product-list', compact('categories'));
    }

    public function productFilter(Request $request, $category_id = null, $sub_category_id = null)
    {
        $categoriesForFilter = Category::with('subSubCategory')->where('parent_category_id', 0)->get();
        $categories = Category::with('subSubCategory')->where('parent_category_id', 0)->get();
        $uniqueArray = [];
        $selectedCat = [];

        if (($request->isMethod('post') && !empty($request->subsubcategories)) || (isset($sub_category_id))) {
            $selectedCat = $request->subsubcategories ?? [$sub_category_id];
            // dd($selectedCat, $categories);

            $categoryids = [];
            foreach ($selectedCat as $id) {
                $category = Category::find($id);
                $allIds = app('common')->getAllSubCategory($category);
                $categoryids = array_merge($categoryids, array_values($allIds));
            }

            $allParentCat = [];
            $category = Category::with('supCategory')->whereIn('id', $categoryids)->get();
            foreach ($category as $cat) {
                $allParentCat[] = array_reverse(app('common')->getAllSupCategory($cat));
            }

            $flattenedArray = array_merge(...$allParentCat);
            $uniqueArray = array_unique($flattenedArray);
            $uniqueArray = array_values($uniqueArray);
        }
        $newArrayOfProduct = app('common')->getProductForDisplay($categories, $uniqueArray);
        // dd($uniqueArray);
        // dd($newArrayOfProduct);
        // else {
        //     if (isset($sub_category_id)) {
        //         $category = Category::find($sub_category_id);
        //         $allIds = app('common')->getAllSubCategory($category);
        //         $products = CategoryProductLink::with('products')->whereIn('category_id', $allIds)->groupBy('category_id')->get();

        //         $newArrayOfProduct = [];

        //         foreach ($products as $product) {
        //             $category = Category::with('supCategory')->find($product->category_id);
        //             $allParentCat = app('common')->getAllSupCategory($category);
        //             $newArrayOfProduct[] = ["products" => [$product->products], "catArray" => array_reverse($allParentCat)];
        //         }
        //         $selectedCat = $allIds;
        //     } else {
        //         $products = resolve('product')->getAll();

        //         $newArrayOfProduct = [];

        //         foreach ($products as $product) {
        //             $category = Category::with('supCategory')->find($product->category_id);
        //             $allParentCat = app('common')->getAllSupCategory($category);
        //             $newArrayOfProduct[] = ["products" => [$product->products], "catArray" =>  array_reverse($allParentCat)];
        //         }

        //         $selectedCat = [];
        //     }
        // }

        $categoriesForFilterArray = app('common')->getAllCatForFilter($categoriesForFilter);
        $dataSubCatList = [];
        foreach ($categoriesForFilterArray as $catItem) {
            $dataSubCatList[$catItem['id']] =  $catItem['items'];
        }

        // dd($newArrayOfProduct);

        return view('front.product-filter', compact('categoriesForFilterArray', 'newArrayOfProduct', 'selectedCat','dataSubCatList'));
    }


    private function buildCategoryTree($parentId = 0)
    {
        $categories = Category::where('parent_category_id', $parentId)->get();
        $tree = [];

        foreach ($categories as $category) {
            $childCategories = $this->buildCategoryTree($category->id);

            $categoryData = [
                'id' => $category->id,
                'text' => $category->title,
                'expanded' => false,
                'items' => $childCategories,
            ];

            $tree[] = $categoryData;
        }

        return $tree;
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

                InquiryProductLink::create([
                    'inquiry_id' => $inquiry->id,
                    'product_id' => $list['name'],
                    'attribute_id' => 0,

                ]);
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

    public function getProductsByCategoryId(Request $request)
    {

        if (!empty($request->categories)) {
            $idArray = explode(',', $request->categories);
            $idArray = array_map('intval', $idArray);

            $products = Product::whereHas('category_product_links', function ($query) use ($idArray) {
                $query->whereIn('category_id', $idArray);
            })->get();
        } else {
            $products = resolve('product')->getAll();
        }

        // $products = resolve('product')->getAll();


        echo view('front.layout.partials.ajax_product_list', [
            'products' => $products
        ])->render();
    }
    public function getSelectAll(Request $request)
    {
        //        $idArray = explode(',', $request->categories);
        //  $idArray =$request->categories;
        //$idArray = array_map('intval', $request->categories);
        $products = Product::whereIn('id', $request->products)->get();


        echo view('front.layout.partials.only_selected_show', [
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
    public function searchProduct(Request $request)
    {
        $filters = $request->get('filters');

        //        $idArray = array_map('intval', $idArray);

        if (!empty($request->category)) {
            $idArray = explode(',', $request->category);

            $filters['category_id'] = $idArray;
        }
        if (!empty($request->search_by)) {
            $filters['search_by'] = $request->search_by;
        }
        $per_page = null;
        //$filters['filters'] = $filters;

        //        $category = Product::whereHas('category_product_links', function ($query) use ($idArray) {
        //            $query->whereIn('category_id', $idArray);
        //        })->get();


        $products = resolve('product')->getListing($filters, false, $per_page);

        echo view('front.layout.partials.ajax_product_list', [
            'products' => $products
        ])->render();
    }
    function selectCategory(Request $request)
    {

        //dd($request->all());


        $categories = $this->buildCategoryTree();
        //$products = resolve('product')->getListing($filters, false, $per_page);
        $products = resolve('product')->getAll();
        //$products->appends($filters);


        //        if ($request->ajax()) {
        //
        //            return view('front.layout.partials.ajax_product_list', [
        //                'products' => $products,
        //            ]);
        //        }

        return view('front.front-products', compact('categories', 'products'))->render();
    }
}
