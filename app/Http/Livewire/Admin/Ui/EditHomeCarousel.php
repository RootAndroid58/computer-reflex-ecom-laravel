<?php

namespace App\Http\Livewire\Admin\Ui;

use App\Models\Product;
use Livewire\Component;
use App\Models\HomeSection;

class EditHomeCarousel extends Component
{
    public $sectionId;
    public $title;
    public $caption;
    public $section;
    public $product_ids=[];

    public function mount()
    {
        $this->section = HomeSection::where('id', $this->sectionId)->first();
        $this->product_ids = $this->section->products->pluck('id')->toArray();
        $this->title = $this->section->title;
        $this->caption = $this->section->caption;
    }

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
    
    public function addProduct($pid)
    {
        $this->resetErrorBag('product_ids');
        // dd($this->product_ids);
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

    public function submit()
    {
        $this->validate();

        HomeSection::where('id', $this->sectionId)->update([
            'title'     => $this->title,
            'caption'   => $this->caption,
            'products'   => serialize($this->product_ids),
        ]);

        $this->emit('toastAlert', [
            'title' => 'Carousel Updated',
            'caption' => 'Home Carousel Updated.',
            'type' => 'SUCCESS',
        ]);

    }
    
    public function render()
    {
        return view('livewire.admin.ui.edit-home-carousel', [
            'products' => Product::whereIn('id', $this->product_ids)->get(),
        ]);
    }
}
