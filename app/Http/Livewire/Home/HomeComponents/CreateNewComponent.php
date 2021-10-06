<?php

namespace App\Http\Livewire\Home\HomeComponents;

use Livewire\Component;
use App\Models\HomeComponent;
use Illuminate\Support\Facades\Auth;

class CreateNewComponent extends Component
{
    public $layout="products_carousel_slider";
    public $visibility=false;
    public $marginTop=30;
    public $marginTopUnit='px';
    public $marginBottom=30;
    public $marginBottomUnit='px';

    protected function rules()
    {
        return [
            'layout'            => 'required|in:full_width_banner,three_col_banner,products_carousel_slider',
            'marginTop'         => 'required|numeric',
            'marginBottom'      => 'required|numeric',
            'marginTopUnit'     => 'required|in:px,rem,in,vh',
            'marginBottomUnit'  => 'required|in:px,rem,in,vh',
            'visibility'        => 'required|boolean',
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function create()
    {
        abort_unless(Auth::check() && Auth::user()->hasAnyPermission(['Manage UI', 'Master Admin']), '403', 'Unauthorized.');
       
        $this->validate();

        $style = '
            margin-top: '.$this->marginTop.$this->marginTopUnit.';
            margin-bottom: '.$this->marginBottom.$this->marginBottomUnit.';
        ';

        if ($this->layout == 'full_width_banner') {
            $data = [
                [
                    'id' => 1,
                    'image' => 'image-9-2.png',
                    'link' => null,
                ]
            ];
        } elseif ($this->layout == 'two_col_banner') {
            $data = [
                [
                    'id' => 1,
                    'image' => 'image-9-2.png',
                    'link' => null,
                ],
                [
                    'id' => 2,
                    'image' => 'image-9-2.png',
                    'link' => null,
                ]
            ];
        } elseif ($this->layout == 'three_col_banner') {
            $data = [
                [
                    'id' => 1,
                    'image' => 'image-8-5.png',
                    'link' => null,
                ],
                [
                    'id' => 2,
                    'image' => 'image-8-5.png',
                    'link' => null,
                ],
                [
                    'id' => 3,
                    'image' => 'image-8-5.png',
                    'link' => null,
                ]
            ];
        } else if ($this->layout == 'products_carousel_slider') {
            $data = [
                'title'     => 'Dummy Carousel',
                'caption'   => 'Caption Goes Here!',
                'products'  => [],
            ];
        }
        
        // Convert to Object & Serialize to store to DB. 
        $data = serialize(json_decode(json_encode($data)));

        // Store to DB
        HomeComponent::create([
            'type'      => $this->layout,
            'visible'   => $this->visibility,
            'data'      => $data,
            'style'     => $style,
            'position'  => HomeComponent::count()+1,
        ]);
     
        $this->emit('modal', ['el' => '#NewComponentModal', 'action' => 'hide']);
        $this->emitUp('refresh');
    }

    public function render()
    {
        return view('livewire.home.home-components.create-new-component');
    }
}
