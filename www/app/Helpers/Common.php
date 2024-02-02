<?php


namespace App\Helpers;


use App\Models\Category;
use App\Models\CategoryProductLink;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class Common
{
    public function getCategory($categories)
    {
        $dropdown_data = [];
        foreach ($categories as $categorie) {
            $dValue = $categorie->title;
            //dd($categorie);
            if ($categorie->parent_category_id > 0) {
                // Find parent
                $dValue = $this->getParentCategory($categorie->parent_category_id, $dValue);
            }
            $dropdown_data[$categorie->id] = $dValue;
        }
        return $dropdown_data;
    }

    function getParentCategory($pId, $dValue)
    {
        $category = resolve('category')->findByID($pId);
        $dValue = $category->title . ' -> ' . $dValue;
        if ($category->parent_category_id > 0) {
            // Find parent
            $dValue = $this->getParentCategory($category->parent_category_id, $dValue);
        }

        return $dValue;
    }


    public function  getCategoryProduct($id)
    {
        $category_product = CategoryProductLink::where('product_id', $id)->first();
        $check_data = [];
        $dValue = $category_product->categories->title;
        if ($category_product->categories->parent_category_id > 0) {
            // Find parent
            $dValue = $this->getParentCategory($category_product->categories->parent_category_id, $dValue);
        }
        $check_data = $dValue;
        return $check_data;
    }

    public function getAllProductCount($category)
    {
        $allCategory = $this->getAllSubCategory($category);

        $productCount = CategoryProductLink::whereIn('category_id', $allCategory)->count();

        return $productCount;
    }

    public   function getAllSubCategory($category)
    {
        $categoryIds = [];

        if ($category instanceof \App\Models\Category) {

            $categoryIds[] = $category->getAttribute('id');

            if ($category->subSubCategory->count() != 0) {
                foreach ($category->subSubCategory as $subCompany) {
                    $categoryIds = array_merge(
                        $categoryIds,
                        $this->getAllSubCategory($subCompany)
                    );
                }
            }
        }

        return $categoryIds;
    }

    public function getAllSupCategory($category)
    {
        $categoryNames = [];


        if ($category instanceof \App\Models\Category) {
            $categoryNames[] = $category->getAttribute('id');

            if ($category->supCategory != null) {

                $categoryNames = array_merge(
                    $categoryNames,
                    $this->getAllSupCategory($category->supCategory)
                );
            }
        }

        return array_unique($categoryNames);
    }

    public function getProductForDisplay(&$categoryCollection, $catIds)
    {
        // dump("before", $categoryCollection);
        foreach ($categoryCollection as $key => $cat) {
            if (!in_array($cat->id, $catIds)) {
                unset($categoryCollection[$key]);
                // $categoryCollection = $categoryCollection->reject(function ($cat) use ($catIds) {
                //     return !in_array($cat->id, $catIds);
                // })->values();
                // dump("after", $cat->id, $catIds, $categoryCollection);
            } else {
                if ($cat->subSubCategory != null) {
                    $cat->subSubCategory = $this->getProductForDisplay($cat->subSubCategory, $catIds);
                }
            }
        }

        return $categoryCollection;
    }
}
