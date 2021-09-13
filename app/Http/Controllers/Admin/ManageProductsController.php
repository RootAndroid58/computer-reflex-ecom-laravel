<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Specification;
use App\Models\ProductComission;
use Storage;

class ManageProductsController extends Controller
{
    public function NewProductListing()
    {
        $categories = Category::get();

       return view('admin.new-product-listing', ['categories' => $categories]);
    }

    public function NewProductListingSubmit(Request $req)
    {
        $req->validate([
            'delivery_type'         => 'required|in:electronic,physical',
            'product_name'          => 'required|max:120|',
            'product_brand'         => 'required|max:255|',
            'category'              => 'required|numeric|exists:categories,id',
            'product_mrp'           => 'required|numeric|min:1|gte:product_price',
            'product_price'         => 'required|numeric|min:1',
            'product_description'   => 'required',
        ]);

        $product = new Product;

        $product->delivery_type         = $req->delivery_type;
        $product->product_name          = $req->product_name;
        $product->product_brand         = $req->product_brand;
        $product->product_category_id   = $req->category;
        $product->product_status        = 0;
        $product->product_stock         = 0;
        $product->product_published     = 0;
        $product->product_mrp           = $req->product_mrp;
        $product->product_price         = $req->product_price;
        $product->product_description   = $req->product_description;

        $product->save();

        return redirect()->route('admin-manage-products')->with(['listing_created' => $req->product_name]);
    }



    public function ProductPublish()
    {
        return view('admin.product-publish');
    }


    // Product Publish For Handler
    public function ProductPublishFormHandler($product_id)
    {
        $product = Product::where('id', $product_id)->first();
        $specification = Specification::where('product_id', $product_id)->first();
        $image = ProductImage::where('product_id', $product_id)->first();

        if (!isset($specification)) {
            // return 'Specification';
            return $this->SpecificationForm($product_id);
        } 
        elseif (!isset($product->tags) || !isset($image)) {
            return $this->TagForm($product_id);
        } else {
            return redirect()->route('admin-manage-products');
        }

    }
    
    // Tags Specifications - Publish Products
    public function SpecificationForm($product_id)
    {
        $product = Product::where('id', $product_id)->first();

        return view('admin.product-specification-form', ['product' => $product]);
    }

    public function ProductPublishFormSpecification(Request $req)
    {
        $req->validate([
            'product_id' => 'required|numeric',
        ]);

        foreach ($req->value as $key => $value) {
            $data = new Specification();
            $data->product_id = $req->product_id;
            $data->specification_value = $value;
            $data->specification_key = $req->key[$key];
            $data->save();
        }

        return redirect()->route('ProductPublishFormHandler', $req->product_id);
    }

    // Tags Add - Publish Products
    public function TagForm($product_id)
    {
        $product = Product::where('id', $product_id)->first();

        return view('admin.product-tag-form', ['product' => $product]);
    }
    public function ProductPublishFormTag(Request $req)
    {
        $req->validate([
            'product_id'        => 'required|numeric',
            'tags'              => 'required',
            'images'            => 'required',
            'product_stock'     => 'required|numeric',
            'product_status'    => 'required|numeric|in:0,1',
        ]);

        foreach ($req->images as $req->image) {
            $req->image->store('images/products' , 'public');

            $db = new ProductImage;
            $db->product_id = $req->product_id;
            $db->image = $req->image->hashName();
            $db->save();
        }
        
        Product::where('id', $req->product_id)->update([
            'tags' => serialize($req->tags),
            'product_published' => 1,
            'product_stock'     => $req->product_stock,
            'product_status'    => $req->product_status,
        ]);

        return redirect()->route('admin-manage-products')->with(['product_published' => 'success']);
    }


    public function EditProduct($product_id)
    {
        $product = Product::where('id', $product_id)->first();

        $specifications = Specification::where('product_id', $product_id)->get();

        return view('admin.edit-product', [
                'product'           => $product, 
                'specifications'    => $specifications,
            ]);
    }

    public function EditProductSubmit(Request $req)
    {
        $req->validate([
            'product_name'                  => 'required',
            'product_status'                => 'required|numeric|in:0,1',
            'product_stock'                 => 'required|numeric',
            'product_mrp'                   => 'required|numeric|gte:product_price',
            'product_price'                 => 'required|numeric',
            'product_description'           => 'required',
            'product_long_description'      => 'nullable',
            'comission'                     => 'nullable|max:100|min:1',
            'tags'                          => 'required',
        ]);

        $comission = ProductComission::where('product_id', $req->product_id)->first();

        if (isset($req->comission)) {
            if (!isset($comission)) {
                $ProductComission = new ProductComission;
                $ProductComission->product_id   = $req->product_id;
                $ProductComission->comission    = $req->comission;
                $ProductComission->save();
            } else {
                $comission->update([
                    'comission' => $req->comission,
                ]);
            }
    
        }
        
        
        Product::where('id', $req->product_id)->update([
            'tags'                      => serialize($req->tags),
            'product_name'              => $req->product_name,
            'product_stock'             => $req->product_stock, 
            'product_mrp'               => $req->product_mrp, 
            'product_price'             => $req->product_price, 
            'product_status'            => $req->product_status, 
            'product_description'       => $req->product_description, 
            'product_long_description'  => $req->product_long_description, 
        ]);


        Specification::where('product_id', $req->product_id)->delete();

        foreach ($req->value as $key => $value) {
            $data = new Specification();
            $data->product_id = $req->product_id;
            $data->specification_value = $value;
            $data->specification_key = $req->key[$key];
            $data->save();
        }

        return redirect()->back()->with(['ProductEdited' => $req->product_id]);
    }

    public function RemoveProduct($product_id)
    {
        
        Product::where('id', $product_id)->delete();
       
        return redirect()->route('admin-manage-products')->with(['ProductRemoved' => 200]);
    }



    public function EditProductImages($product_id)
    {
        $product = Product::where('id', $product_id)->first();

        $images = ProductImage::where('product_id', $product_id)->orderBy('id', 'desc')->get();

        return view('admin.edit-product-images',[
            'images' => $images,
            'product' => $product,
        ]);
    }

    public function AddMoreImages(Request $req)
    {               
        // dd($req);
        $req->validate([
            'images' => 'required',
            'product_id' => 'required|exists:products,id',
        ]);

        foreach ($req->images as $req->image) {

            $req->image->store('images/products' , 'public');

            $data = new ProductImage;
            $data->product_id   = $req->product_id;
            $data->image        = $req->image->hashName();
            $data->save();
        }

        return back()->with(['ImagesAdded' => 200]);
    }
    
    public function EditProductImagesSubmit(Request $req)
    {
        $req->validate([
            'new_image' => 'required|mimes:jpeg,jpg,png|max:10000',
            'image_id' => 'required|numeric|exists:product_images,id'
        ]);
        
       $image = ProductImage::where('id', $req->image_id)->first();

       Storage::delete('/public/images/products/'.$image->image);

       $req->new_image->store('images/products' , 'public');
       
        ProductImage::where('id', $req->image_id)->update([
            'image' => $req->new_image->hashName(),
        ]);

        return redirect()->back()->with(['ImageUpdated' => 200]);
    }

    public function RemoveImage($image_id)
    {
        ProductImage::where('id', $image_id)->delete();

        return back()->with(['ImageRemoved' => 200]);
    }

    public function EditProductLicenses($pid)
    {
        $product = Product::where('id', $pid)->first();
        
        if ($product->delivery_type != 'electronic') {
            abort(500);
        }

        return view('admin.edit-product-licenses', [
            'product' => $product,
        ]);
    }

}
