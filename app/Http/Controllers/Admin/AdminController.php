<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Tag;
use Image;
use App\Models\User;
use App\Models\Banner;
use App\Models\SmallBanner;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductTag;
use App\Models\ProductImage;
use App\Models\Specification;
use App\Models\HomeSection;
use App\Models\HomeSectionProduct;
use App\Models\Catalog;
use App\Models\CatalogProduct;
use App\Mail\AdminUserCreatedMail;



class AdminController extends Controller
{
    public function IndexDashboard()
    {
        return view('admin.dashboard');
    }
    public function IndexProfile()
    {
        $permissions = Auth()->User()->getAllPermissions();

        return view('admin.profile', ['permissions' => $permissions]);
    }
    public function AdminUserManagement()
    {
        $AdminUsers = User::permission('Admin')->get();

        return view('admin.user-management', ['AdminUsers' => $AdminUsers]);
    }
    public function ManageProducts()
    {
        $products = Product::get();

        return view('admin.manage-products', ['products' => $products]);
    }
    public function ManageUI()
    {
        return view('admin.manage-ui');
    }
    public function ManageBanners()
    {
        return view('admin.manage-banners');
    }
    public function NewBanner()
    {
        return view('admin.new-banner');
    }

    public function NewBannerSubmit(Request $req)
    {
        $req->validate([
            "banner_name"       => 'required|max:255|unique:banners,banner_name',
            "banner_header"     => 'nullable|max:50',
            "banner_header_2"   => 'nullable|max:50',
            "banner_caption"    => 'nullable|max:255',
            "banner_btn_txt"    => 'nullable|max:255',
            "banner_btn_link"   => 'required',
            "banner_img"        => 'required|mimes:jpeg,jpg,png',
        ]);

        $req->banner_img->store('images/banner' , 'public');

        $banner = new Banner;

        $banner->banner_name        = $req->banner_name;
        $banner->banner_header      = $req->banner_header;
        $banner->banner_header_2    = $req->banner_header_2;
        $banner->banner_caption     = $req->banner_caption;
        $banner->banner_btn_txt     = $req->banner_btn_txt;
        $banner->banner_btn_link    = $req->banner_btn_link;
        $banner->banner_btn_color   = '#1a1a1a';
        $banner->banner_img         = $req->banner_img->hashName();
        $banner->banner_status      = 0;
        
        $banner->save();

        return back()->with(['BannerCreatedSuccess' => $banner->banner_name]);
    }

    public function EditSmallBannerSubmit(Request $req)
    {
        $req->validate([
            'id'    => 'required',
            'image' => 'required|url',
            'link'  => 'required|url',
        ]);

        $SmallBanner = SmallBanner::where('id', $req->id)->first();

        if (isset($SmallBanner)) {
            $SmallBanner->update([
                'image' => $req->image,
                'link'  => $req->link,
            ]);
        }
        
        return redirect()->back();
        
    }

    public function EditBannerSubmit(Request $req)
    {
        $banner = Banner::where('id', $req->banner_id)->first();
        
        if (isset($req->banner_img)) {
            Storage::delete('images/banner/'.$banner->banner_img);
            $req->banner_img->store('images/banner' , 'public');
            Banner::where('id', $req->banner_id)->update([
                'banner_img' => $req->banner_img->hashName(),
            ]);
        }

        Banner::where('id', $req->banner_id)->update([
            'banner_name'       => $req->banner_name,
            'banner_header'     => $req->banner_header, 
            'banner_header_2'   => $req->banner_header_2, 
            'banner_caption'    => $req->banner_caption, 
            'banner_btn_txt'    => $req->banner_btn_txt, 
            'banner_btn_link'   => $req->banner_btn_link,
        ]);

        return redirect()->back()->with([
            'updated' => 200,
        ]);
    }

    public function PublishBanners()
    {
        $banners = Banner::get();

        return view('admin.publish-banners', ['banners' => $banners]);
    }

    public function PublishBannersSubmit(Request $req)
    {

        $req->validate([
            'banner_1'  => 'numeric|nullable|different:banner_2,banner_3,banner_4,banner_5,banner_6,banner_7,banner_8,banner_9,banner_10',
            'banner_2'  => 'numeric|nullable|different:banner_1,banner_3,banner_4,banner_5,banner_6,banner_7,banner_8,banner_9,banner_10',
            'banner_3'  => 'numeric|nullable|different:banner_2,banner_1,banner_4,banner_5,banner_6,banner_7,banner_8,banner_9,banner_10',
            'banner_4'  => 'numeric|nullable|different:banner_2,banner_3,banner_1,banner_5,banner_6,banner_7,banner_8,banner_9,banner_10',
            'banner_5'  => 'numeric|nullable|different:banner_2,banner_3,banner_4,banner_1,banner_6,banner_7,banner_8,banner_9,banner_10',
            'banner_6'  => 'numeric|nullable|different:banner_2,banner_3,banner_4,banner_5,banner_1,banner_7,banner_8,banner_9,banner_10',
            'banner_7'  => 'numeric|nullable|different:banner_2,banner_3,banner_4,banner_5,banner_6,banner_1,banner_8,banner_9,banner_10',
            'banner_8'  => 'numeric|nullable|different:banner_2,banner_3,banner_4,banner_5,banner_6,banner_7,banner_1,banner_9,banner_10',
            'banner_9'  => 'numeric|nullable|different:banner_2,banner_3,banner_4,banner_5,banner_6,banner_7,banner_8,banner_1,banner_10',
            'banner_10' => 'numeric|nullable|different:banner_2,banner_3,banner_4,banner_5,banner_6,banner_7,banner_8,banner_9,banner_1',
        ]);

        Banner::query()->update([
            'banner_status'     => 0,
            'banner_position'   => null,
        ]);

        // Set All Banner Positions
        Banner::where('id', $req->banner_1)->update([
            'banner_position'   => 1,
            'banner_status'     => 1,
        ]);
        Banner::where('id', $req->banner_2)->update([
            'banner_position'   => 2,
            'banner_status'     => 1,
        ]);
        Banner::where('id', $req->banner_3)->update([
            'banner_position'   => 3,
            'banner_status'     => 1,
        ]);
        Banner::where('id', $req->banner_4)->update([
            'banner_position'   => 4,
            'banner_status'     => 1,
        ]);
        Banner::where('id', $req->banner_5)->update([
            'banner_position'   => 5,
            'banner_status'     => 1,
        ]);
        Banner::where('id', $req->banner_6)->update([
            'banner_position'   => 6,
            'banner_status'     => 1,
        ]);
        Banner::where('id', $req->banner_7)->update([
            'banner_position'   => 7,
            'banner_status'     => 1,
        ]);
        Banner::where('id', $req->banner_8)->update([
            'banner_position'   => 8,
            'banner_status'     => 1,
        ]);
        Banner::where('id', $req->banner_9)->update([
            'banner_position'   => 9,
            'banner_status'     => 1,
        ]);
        Banner::where('id', $req->banner_10)->update([
            'banner_position'   => 10,
            'banner_status'     => 1,
        ]);

        return back()->with(['ChangesPublished' => 'Success']);
    }


    public function AdminUserRemove($UserID)
    {

        $user = User::where('id', $UserID)->first();

        if (isset($user) || $user->hasPermissionTo('Admin')) {
            
            if (auth()->user()->email == $user->email) {

                return back()->with('self_remove', $user->email);
                
            } elseif ($user->hasPermissionTo('Master Admin')) {
    
                return back()->with('master_admin_remove', $user->email);
            }
            else {
    
                $user->syncPermissions();
    
                return redirect()->route('admin-user-management')->with('admin_removed', $user->email);
            }   
        }
        
    }


    public function AdminUserEdit($user_id)
    {
        $user = User::where('id', $user_id)->first();

        if (isset($user)) {
 
            if (Auth()->user()->email == $user->email)  {

                return redirect()->route('admin-user-management')->with(['SelfEdit' => $user->email]);

            } elseif ($user->hasPermissionTo('Master Admin')) {

                return redirect()->route('admin-user-management')->with(['MasterAdminRemove' => 'Failed']);
            
            } elseif ($user->hasPermissionTo('Admin')) {
                $permissions = Permission::all();
                $userPermission = $user->getAllPermissions();

                return view('admin.admin-user-edit', ['user' => $user, 'permissions' => $permissions , 'userPermissions' => $userPermission]);
        
            } else {
                return back();
            }
        } else {
            return redirect()->route('admin-user-management');
        }
        
    }



    public function EditBanners()
    {
        $banners = Banner::get(); 
        // dd($banners);
        return view('admin.edit-banners', [
            'banners' => $banners,
        ]);
    }
    public function EditBannerPage($banner_id)
    {
        $banner = Banner::where('id', $banner_id)->first();
        
        if (!isset($banner)) {
            return redirect()->back();
        }

        // dd($banners);
        return view('admin.edit-banner-page', [
            'banner' => $banner,
        ]);
    }




    public function AdminUserEditSubmit(Request $req)
    {
        $user = User::where('id' , $req->user_id)->first();

        if (isset($user)) {
            if ($req->user_id == auth()->user()->id) {
                return back();
            } elseif ($user->hasPermissionTo('Master Admin')) {
                return redirect()->route('admin-user-management');
            }
            elseif ($user->hasPermissionTo('Admin')) {
                $req->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'mobile' => ['nullable', 'numeric', 'digits_between:10,10'],
                    'email' => ['required', 'string', 'email', 'max:255'],
                ]);
                $permissions = $req->NewPermissions;
                $user->update([
                    'name' => $req->name,
                    'mobile' => $req->mobile,
                    'email' => $req->email,
                    ]);
                $user->syncPermissions($permissions);
            
                return redirect('/admin/user-management')->with('EditSuccess', $req->email);
            } else {
                return redirect()->route('admin-user-management');
            }
        }
        else {
            return back();
        }
    }


    public function UserSearchSubmit(Request $req)
    {
        $user = User::where('email', $req->email)->first();

        if (isset($user)) {
      
            $data = array(
                'status' => 200,
                'name' => $user->name,
                'email' => $user->email,
                'mobile' => $user->mobile,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'user_id' => $user->id,
            );

         if ($user->hasPermissionTo('Admin')) {
            $data = '
            <div class="alert alert-primary" role="alert">
                User with the email you provided is already a Admin user!
            </div>';
        }
        
    } else {

        $data = '
        <div class="alert alert-danger" role="alert">
            No user found with the email id you provided.
        </div>';
    }

    return $data;

    }

    public function AdminUserCreateSubmit(Request $req)
    {

        $user = User::where('id', $req->user_id)->first();

        if (isset($user)) {
            if (!$user->can('Admin')) {
                $user->givePermissionTo('Admin');

                Mail::to($user->email)->send(new AdminUserCreatedMail($user));
    
                return back()->with(['AdminUserAdded' => $user->email]);
            }
        } else {
            return 'Failed';
        }
       
    }



    public function ManageHomeCarouselSlider()
    {
        $HomeSections = HomeSection::with(['SectionProducts.product.images', 'SectionProducts.product.category'])->get();

        return view('admin.manage-home-carousel-sliders', [
            'HomeSections' => $HomeSections,
        ]);
    }

    public function CreateHomeCarouselSlider(Request $req)
    {
        $req->validate([
            'title'             => 'required',
            'caption'           => 'required',
            'product_ids'       => 'required|exists:products,id',
        ]);

        $HomeSection            = new HomeSection;
        $HomeSection->title     = $req->title;
        $HomeSection->caption   = $req->caption;
        $HomeSection->save();

        foreach ($req->product_ids as $product_id) {
            $HomeSectionProduct                     = new HomeSectionProduct;
            $HomeSectionProduct->home_section_id    = $HomeSection->id;
            $HomeSectionProduct->product_id         = $product_id;
            $HomeSectionProduct->save();
        }
        
        return redirect()->back()->with([
            'SliderCreated' => 200
            ]);
    }

    public function EditHomeCarouselSlider($slider_id)
    {
        $HomeSection = HomeSection::with('SectionProducts.product.images')->where('id', $slider_id)->first();
        
        //  For loop lagake make own arr
        return view('admin.edit-home-carousel-slider', 
        [
            'HomeSection' => $HomeSection,
        ]);
    
    }

    public function EditHomeCarouselSliderSubmit(Request $req)
    {
        $req->validate([
            'home_section_id'   => 'required',
            'title'             => 'required',
            'caption'           => 'required',
            'product_ids'     => 'required|exists:products,id',
        ]);

        HomeSectionProduct::where('home_section_id', $req->home_section_id)->delete();

            foreach ($req->product_ids as $product_id) {
                $HomeSectionProduct                     = new HomeSectionProduct;
                $HomeSectionProduct->home_section_id    = $req->home_section_id;
                $HomeSectionProduct->product_id         = $product_id;
                $HomeSectionProduct->save();
            }

            return redirect()->route('admin-manage-home-carousel-sliders')->with([
                'SliderUpdated' => 200
            ]);
    }



    public function ManageFeaturedCatalogs()
    {
        return view('admin.catalog.manage-catalogs');
    }

    public function CreateNewCatalog()
    {
        return view('admin.catalog.create-new-catalog');
    }

    public function CreateNewCatalogSubmit(Request $req)
    {
        $req->merge([
            'slug' => strtolower(preg_replace('/\s+/', '-', $req->slug)),
        ]);

        $req->validate([
            'slug'              => 'required|unique:catalogs,slug',
            'product_ids'       => 'required',
        ]);

        $catalog = new Catalog;
        $catalog->slug = $req->slug;
        $catalog->save();

        foreach ($req->product_ids as $key => $product_id) {
            $catalogProduct = new CatalogProduct;
            $catalogProduct->product_id = $product_id;
            $catalogProduct->catalog_id = $catalog->id;
            $catalogProduct->save();
        }

        return redirect()->route('admin-manage-featured-catalogs')->with([
            'catalogCreated' => $catalog->slug,
        ]);

    }





    
}
