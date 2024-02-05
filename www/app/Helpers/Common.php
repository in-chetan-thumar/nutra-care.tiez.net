<?php


namespace App\Helpers;


use App\Models\Category;
use App\Models\CategoryProductLink;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;


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

    public function getProductForDisplay(&$categoryCollection, $catIds, $productTitle = '')
    {
        // dump("before", $categoryCollection);
        foreach ($categoryCollection as $key => $cat) {
            if (!empty($catIds) && !in_array($cat->id, $catIds)) {
                unset($categoryCollection[$key]);
            } else {
                if ($cat->subSubCategory->count() > 0) {
                    $cat->subSubCategory = $this->getProductForDisplay($cat->subSubCategory, $catIds, $productTitle);
                } else {
                    $products = Product::whereIn('id', function ($query) use ($cat) {
                        $query->select('product_id')
                            ->from('category_product_links')
                            ->where('category_id', $cat->id);
                    });

                    if (!empty($productTitle)) {
                        $products->where('title', 'LIKE', '%' . $productTitle . '%');
                    }

                    $cat['products'] = $products->get();
                }
            }
        }

        return $categoryCollection;
    }

    public function getAllCatForFilter($categoriesForFilter)
    {
        $catArray = [];
        foreach ($categoriesForFilter as $catItem) {
            $subArray = [];
            if ($catItem->subSubCategory->count() > 0) {
                $subArray = $this->getAllCatForFilter($catItem->subSubCategory);
            }

            $catArray[] = [
                "id" => $catItem->id,
                "text" => $catItem->title,
                "expanded" => false,
                "items" => $subArray
            ];
        }

        return $catArray;
    }

    public function getTitleForAccordion($subCats, $subCatId)
    {
        $leafCats = $this->getLeafCategories($subCats);
        $leafCats = Arr::flatten($leafCats);
        $memorizationOfleafCatsWithParentTree = [];
        $leafCatsCollection = new Collection();
        foreach ($leafCats as $key => $leafCat) {
            $leafCatsWithParentTree = $leafCat->supCategory()->first();
            if (!isset($memorizationOfleafCatsWithParentTree[$leafCatsWithParentTree->id])) {
                $leafCatsWithParentTreeName = '';
                if ($leafCatsWithParentTree->id != $subCatId) {
                    $leafCatsWithParentTreeName = $this->getParentTreeName($leafCatsWithParentTree, $subCatId) . ' > ';
                }
                // dump($leafCatsWithParentTree, $leafCatsWithParentTreeName,$leafCatsWithParentTree->id);
                $memorizationOfleafCatsWithParentTree[$leafCatsWithParentTree->id] = $leafCatsWithParentTreeName;
            }
            $collectLeafCat = collect($leafCat);
            $collectLeafCat->put('parentTreeTitle', $memorizationOfleafCatsWithParentTree[$leafCatsWithParentTree->id] . $leafCat->title);
            $leafCatsCollection->push($collectLeafCat);
            // dump( $collectLeafCat, $leafCat,$leafCatsWithParentTree,$subCatId,$memorizationOfleafCatsWithParentTree[$leafCatsWithParentTree->id]);
            // dump( $collectLeafCat, $leafCatsWithParentTree,$subCatId);

        }
        // dd('finally');
        return $leafCatsCollection;
    }

    public function getLeafCategories($subCats)
    {
        $arr = [];
        foreach ($subCats as $cat) {
            // $tempTitle = $item->getAttribute('title');
            if ($cat->subSubCategory->count() > 0) {
                $arr[] =  $this->getLeafCategories($cat->subSubCategory);
            } else {
                $arr[] = $cat;
            }
            // $arr[] =  $tempTitle;
        }
        return $arr;
    }

    public function getParentTreeName($cat, $parentCategoryId)
    {
        try {
            $title = $cat->title;
            if ($cat->supCategory != null && $parentCategoryId != $cat->parent_category_id && $parentCategoryId != $cat->id) {
                $title = $this->getParentTreeName($cat->supCategory, $parentCategoryId) . ' > ' . $title;
            }
            return $title;
        } catch (Exception $e) {
            dd($cat);
        }
    }

    public function getDirectProducts(&$subCat)
    {
        $products = Product::whereIn('id', function ($query) use ($subCat) {
            $query->select('product_id')
                ->from('category_product_links')
                ->where('category_id', $subCat->id);
        })->get();
        $subCat['products'] = $products;
        return collect($subCat);
    }
}
