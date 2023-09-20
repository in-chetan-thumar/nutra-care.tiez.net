<?php


namespace App\Helpers;


use App\Models\Category;

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
}
