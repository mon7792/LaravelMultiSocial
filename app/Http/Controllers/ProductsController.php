<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Category;
use App\ProductImages;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkstaffadmin', ['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     // Page to display all or part of the product
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // controller to get the view to add/create product
    public function create()
    {
        $category = Category::all();
        return view('products.create')->with('category',$category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // controller to handle the request before adding product to the database
    public function store(Request $request)
    {
      // Validate
      $this->validate($request,[
        'productName' => 'required',
        'cover_image' => 'image|nullable|max:1999'
      ]);
      //





      if($request->hasFile('cover_image'))
      {
        //get file name with extension
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        //get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //get just ext
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        //Filename to Store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //Upload image
        $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
      }
      else {
        $fileNameToStore = 'noimage.jpg';
      }

      // deal with the product category and change it to number
      $productCategoryId = Category::where('category',$request->input('productCategory'))->get();
      //add
      $product = new Product();
      $product->name = $request->input('productName');
      $product->description = $request->input('productDescription');
      $product->category = $productCategoryId[0]->id;
      // net to think of mechanism to include the required item
      $product->requiredItem = "primary";
      $product->productID = $request->input('productID');
      $product->save();
      //
      $productImages = new productImages();
      $productImages->product_id =  $request->input('productID');
      $productImages->cover_image = $fileNameToStore;
      $productImages->save();
      //redirect  to adminstaff dashboard
      return redirect()->route('adminstaff.products') ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //return $id;
      $product = Product::find($id);
      $productImage = ProductImages::where('product_id', '=', $product->productID)->firstOrFail();
      return view('products.show', compact('product','productImage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::all();
        $product = Product::find($id);
        // categorySelected: is to find the category a particular product belongs to
        $categorySelected = Category::find($product->category)->category;
        return view('products.edit', compact('product','category', 'categorySelected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request,[
        'productName' => 'required',

      ]);
      // Deal with images
      //Handle the File Upload
      if($request->hasFile('cover_image'))
      {
        //get file name with extension
          $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
          //get just filename
          $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
          //get just ext
          $extension = $request->file('cover_image')->getClientOriginalExtension();
          //Filename to Store
          $fileNameToStore = $filename.'_'.time().'.'.$extension;
          //Upload image
          $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
      }





      // deal with the product category and change it to number
      $productCategoryId = Category::where('category',$request->input('productCategory'))->get();
      //add

      $product = Product::find($id);
      //store the productID
      $productID = $product->productID;
      $product->name = $request->input('productName');
      $product->description = $request->input('productDescription');
      $product->category = $productCategoryId[0]->id;
      // net to think of mechanism to include the required item
      $product->save();

      #Update the product of the Image
      $productImage = ProductImages::where('product_id',$productID)->firstOrFail();
      // return $productImage;
      // handling product database
      // return 1;
      if($request->hasFile('cover_image'))
      {
       $productImage->cover_image = $fileNameToStore;
      }
      $productImage->save();
      // here handle for the photo update if the cover_image changes

      return redirect()->route('adminstaff.products') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete Products
        $product = Product::find($id);
        $productImage = ProductImages::where('product_id',$product->productID)->firstOrFail();
        $product->delete();
        if($productImage->cover_image != 'noimage.jpg')
        {
        Storage::delete('public/cover_images/'.$productImage->cover_image);
        }
        $productImage->delete();
        return redirect('/products');
    }
}
