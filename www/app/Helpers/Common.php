<?php


namespace App\Helpers;


use App\Models\Category;
use App\Models\CategoryProductLink;

class Common
{
    public function getCategory($categories){
        $dropdown_data = [];
        foreach ($categories as $categorie){
            $dValue = $categorie->title;
            //dd($categorie);
            if($categorie->parent_category_id > 0){
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
        $dValue = $category->title . ' -> '. $dValue;
        if($category->parent_category_id > 0){
            // Find parent
            $dValue = $this->getParentCategory($category->parent_category_id, $dValue);
        }
        return $dValue;
    }


   public function  getCategoryProduct($id){
        $category_product = CategoryProductLink::where('product_id',$id)->first();
       $category = Category::where('id',$category_product->category_id)->first();
       $check_data = [];
           $dValue = $category->title;
           if($category->parent_category_id > 0){
               // Find parent
               $dValue = $this->getParentCategory($category->parent_category_id, $dValue);
           }
       $check_data = $dValue;
       return $check_data;
    }

}
