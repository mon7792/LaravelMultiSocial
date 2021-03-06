<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Category;
use App\Product;
use App\ProductImages;
class StaffAdminController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware(['auth','checkstaffadmin']);
  }
  /**
   * Show the available categories and form to add category.
   *
   * @return \Illuminate\Http\Response
   */
   public function showCategories()
   {
     // Get a instance of category
     $cat = Category::all();
    return view('staffadmin.pages.categories')->with('cat',$cat);
   }

   /**
    * Add new Category to the database.
    *
    * @return \Illuminate\Http\Response
    */
    public function addNewCategories(Request $request)
    {
      // Get a instance of category
      $this->validate($request,[
        'category' => 'required',
      ]);
      $cat = new Category();
      $cat->category = $request->input('category');
      $cat->save();
      return redirect()->route('adminstaff.newcategories');
    }
    /**
     * Remove Category from the database.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyCategories($id)
    {
        //delete categories
        $cat = Category::find($id);
        $cat->delete();

        return redirect()->route('adminstaff.newcategories');
    }

    /**
     * Show the products page.
     * consideration that all the Product will be stored with the image
     * @return \Illuminate\Http\Response
     */
     public function showProducts(Request $request)
     {
       // Get a instance of category
      $cat = Category::all();
      // check if the request is AJAX
      if(request()->ajax() and $request->has('categoryId'))
      {
        $cat_id = $request->categoryId;
        $products = Product::where('category', $cat_id)
              //  ->orderBy('name', 'desc')
              //  ->take(10)
               ->get();

        //single product
        // $prod = Product::find(2);
        // return $prod->productID;
        // $productImg = Product::find(2)->ProductImages->where('product_id', $prod->productID)->first()->cover_image;
        // ->where('product_id', $prod->productID)->cover_image->;
        // $productImg = $prod->ProductImages()->where('product_id', $prod->productID)->firstOrFail();
        // ()->where('product_id',$prod->productID)->first();
        // return $productImg;
        // return $products;
        // $productImage = ProductImages::where('product_id', '=', $product->productID)->firstOrFail();
        return view('staffadmin.ajax.productTable', compact('products'));
      }
      if(request()->ajax() and $request->has('productID'))
      {
        $prodID = $request->productID;
        $products = Product::find($prodID);
        $productImg = $products->ProductImages->where('product_id', $products->productID)->first();
        // ->first()->cover_image;
        // $prod->ProductImages->where('product_id', $prod->productID)->first()->cover_image

        // ->where('product_id', $request->productID)->first()->cover_image;
        // ->where('product_id', $prod->productID)->first()->cover_image;
        return json_encode(array($products, $productImg));
      }
      return view('staffadmin.pages.Product')->with('cat', $cat);
     }
     public function editProduct(Request $request)
     {

       $category = Category::all();
       if(request()->ajax() and $request->has('productID'))
       {
         $product = Product::find($request->productID);
         $categorySelected = Category::find($product->category)->category;
         return json_encode(array($product, $categorySelected));
       }

         $product = Product::find($id);
         // categorySelected: is to find the category a particular product belongs to
         $categorySelected = Category::find($product->category)->category;
         return view('products.edit', compact('product','category', 'categorySelected'));
     }


}
