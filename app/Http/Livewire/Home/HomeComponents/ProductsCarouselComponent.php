<?php

namespace App\Http\Livewire\Home\HomeComponents;

use App\Models\Product;
use Livewire\Component;
use MeiliSearch\Endpoints\Indexes;
use Illuminate\Support\Facades\Auth;

class ProductsCarouselComponent extends Component
{
    public $component;
    public $visibility;

    public $search;
    public $title;
    public $editTitle=false;

    public $editMarginTop=false;
    public $marginTop;
    public $marginTopUnit;
    public $editMarginBottom=false;
    public $marginBottom;
    public $marginBottomUnit;

    public $caption;
    public $editCaption=false;
    public $searchedProducts=[];
    public $addedProducts=[];
    public $addedProductIds=[];
    
    public function updated($field)
    {
        $this->validateOnly($field);
    }

    protected function rules()
    {
        return [
            'visibility'        => 'nullable|boolean',
            'caption'           => 'nullable|string',
            'editCaption'       => 'nullable|boolean',

            'editTitle'         => 'nullable|boolean',
            'title'             => 'nullable|string',

            'editMarginTop'     => 'nullable|boolean',
            'editMarginBottom'  => 'nullable|boolean',
            'marginTop'         => 'nullable|numeric',
            'marginBottom'      => 'nullable|numeric',
            'marginTopUnit'     => 'nullable|in:px,rem,in,vh',
            'marginBottomUnit'  => 'nullable|in:px,rem,in,vh',
        ];
    }

    public function finalValidation()
    {
        $arr = [];
        if ($this->editTitle) {
            $arr += [
                'title' => 'required',
            ];
        }
        if ($this->editCaption) {
            $arr += [
                'caption' => 'required',
            ];
        }
      
        if ($this->editMarginTop) {
            $arr += [
                'marginTop'     => 'required',
                'marginTopUnit' => 'required',
            ];
        }
        if ($this->editMarginBottom) {
            $arr += [
                'marginBottom'      => 'required',
                'marginBottomUnit'  => 'required',
            ];
        }
        if (count($arr)) {
            $this->validate($arr);
        }
        
    }

    public function mount()
    {
        // dd($this->component->data);
        $this->marginTop = $this->component->style->marginTop->value;
        $this->marginTopUnit = $this->component->style->marginTop->unit;
        $this->marginBottom = $this->component->style->marginBottom->value;
        $this->marginBottomUnit = $this->component->style->marginBottom->unit;

        if (count($this->component->data->products)) {
            $this->addedProductIds = $this->component->data->products->pluck('id')->toArray(); 
            $this->syncAddedProducts();
        }
        $this->title    = $this->component->data->title;
        $this->caption    = $this->component->data->caption;
    }

    public function UpdatedEditTitle()
    {
        $this->title    = $this->component->data->title;
    }

    public function UpdatedEditCaption()
    {
        $this->caption    = $this->component->data->caption;
    }

    public function UpdatedSearch()
    {
        $this->searchedProducts = Product::search($this->search, function (Indexes $meilisearch, $query, $options) {
            $options['filter'] = 'product_status=1';
            return $meilisearch->search($query, $options);
        })->get();

        // ['filter' => ['product_status = 1']]
    }

    public function addProduct($pid)
    {
        if (!array_search($pid, $this->addedProductIds)) { 
            $this->addedProductIds[] = $pid;
            $this->syncAddedProducts();
        }
    }

    public function syncAddedProducts()
    {
        $this->addedProducts = Product::whereIn('id', $this->addedProductIds)->get();
    }

    public function removeProduct($pid)
    {
        if (($key = array_search($pid, $this->addedProductIds)) !== false) {
            unset($this->addedProductIds[$key]);
        }
        $this->syncAddedProducts();
    }

    public function edit()
    {
        abort_unless(Auth::check() && Auth::user()->hasAnyPermission(['Manage UI', 'Master Admin']), '403', 'Unauthorized.');
        
        $this->validate();
        
        $this->finalValidation();

        if ($this->editMarginTop) {
            $marginTop = $this->marginTop;
            $marginTopUnit = $this->marginTopUnit;
        } else {
            $marginTop = $this->component->style->marginTop->value;
            $marginTopUnit = $this->component->style->marginTop->unit;
        }

        if ($this->editMarginBottom) {
            $marginBottom = $this->marginBottom;
            $marginBottomUnit = $this->marginBottomUnit;
        } else {
            $marginBottom = $this->component->style->marginBottom->value;
            $marginBottomUnit = $this->component->style->marginBottom->unit;
        }

        $style = [
            'marginTop' => [
                'value' => $marginTop,
                'unit' => $marginTopUnit,
            ],
            'marginBottom' => [
                'value' => $marginBottom,
                'unit' => $marginBottomUnit,
            ],
        ];

        $data = $this->component->data;

        if ($this->editTitle) {
            $data->title = $this->title;
        }

        if ($this->editCaption) {
            $data->caption = $this->caption;
        }

        $data->products = $this->addedProductIds;
     
        $this->component->update([
            'data' => serialize(json_decode(json_encode($data))),
            'style' => serialize(json_decode(json_encode($style))),
            'visible' => $this->visibility,
        ]);

        $this->emit('modal', [
            'el'        => '#EditComponentModal-'.$this->component->id,
            'action'    => 'hide',
        ]);
    }

    public function render()
    {
        $this->emit('initProductCarousel', [
            'component_id' => $this->component->id,
        ]);
        return view('livewire.home.home-components.products-carousel-component');
    }
}
