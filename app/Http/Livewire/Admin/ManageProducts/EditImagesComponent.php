<?php

namespace App\Http\Livewire\Admin\ManageProducts;

use App\Models\Product;
use Livewire\Component;
use App\Models\ProductImage;
use Livewire\WithFileUploads;

class EditImagesComponent extends Component
{
    use WithFileUploads;

    public $pid;
    public $product;
    public $images;
    public $deleteId;

    public function mount()
    {
        $this->product = Product::with('images')->where('id', $this->pid)->first();
    }


    public function toggleImage($id)
    {
        $image = ProductImage::where('id', $id)->first();
        $image->update([
            'active' => $image->active= !$image->active,
        ]);
    }

    public function imageDeleteInit($id)
    {
        $this->deleteId = $id;
    }
    
    public function imageDelete()
    {
        ProductImage::where('id', $this->deleteId)->delete();
        $this->emit('modal', [
            'el' => '#imageDeleteModal',
            'action' => 'hide',
        ]);
    }

    public function updatePosition($items)
    {
        foreach ($items as $key => $item) {
            ProductImage::where('id', $item['value'])->update([
                'position' => $item['order'],
            ]);
        }
    }

    public function addImages()
    {
        foreach ($this->images as $key => $image) {
            $image->store('images/products' , 'public');
            $ProductImage = new ProductImage;
            $ProductImage->product_id   = $this->product->id;
            $ProductImage->image        = $image->hashName();
            $ProductImage->active       = true;
            $ProductImage->save();
        }
        $this->emit('modal', [
            'el' => '#AddMoreImagesModal',
            'action' => 'hide',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.manage-products.edit-images-component');
    }
}
