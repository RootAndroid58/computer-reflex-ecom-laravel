<?php

namespace App\Http\Livewire\Admin\Ui;

use Livewire\Component;
use App\Models\Product;
use App\Models\HomeSection;

class CreateHomeCarouselForm extends Component
{
    public $product_ids=[];
    public $title;
    public $caption;

    protected function rules()
    {
        return [
            'title'         => 'required',
            'caption'       => 'required',
            'product_ids'   => 'required|exists:products,id',
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function submit()
    {
        $this->validate();

        $HomeSection            = new HomeSection;
        $HomeSection->title     = $this->title;
        $HomeSection->caption   = $this->caption;
        $HomeSection->products  = serialize($this->product_ids);
        $HomeSection->save();

        return redirect()->back()->with([
            'SliderCreated' => 200
        ]);
    }

    public function addProduct($pid)
    {
        $this->resetErrorBag('product_ids');
        
        if (!in_array($pid, $this->product_ids)) {
            $this->product_ids[] = $pid;
        } else {
            $this->emit('toastAlert', [
                'type' => 'DANGER',
                'title' => 'Already Exists',
                'caption' => 'Product already added',
            ]);
        }
    }

    public function removeProduct($pid)
    {
        if (($key = array_search($pid, $this->product_ids)) !== false) {
            unset($this->product_ids[$key]);
        }
    }

    public function render()
    {
        return view('livewire.admin.ui.create-home-carousel-form', [
            'products' => Product::whereIn('id', $this->product_ids)->get(),
        ]);
    }
}
