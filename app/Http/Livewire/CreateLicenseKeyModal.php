<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Contracts\Validation\Rule;

use App\Models\Product;
use App\Models\ProductLicense;

class CreateLicenseKeyModal extends Component
{
    public $product;
    public $form = [
        'license_key' => '',
    ];

    protected function rules()
    {
        return [
            'form.license_key' => ['required', 'unique:product_licenses,key,NULL,id,product_id,'.$this->product->id],
        ];
    }
    
    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function submit()
    {
        $this->validate();

        $product = Product::where('id', $this->product->id)->first();

        if (isset($product) && $product->delivery_type != 'electronic') {
            abort(500);
        }
        
        $ProductLicense = ProductLicense::create([
            'key'           => $this->form['license_key'],
            'product_id'    => $this->product->id,
            'status'        => 'unused',
        ]);

        $this->emit('ProductLicenseCreated', [
            'key' => $this->form['license_key'],
            'id' => $ProductLicense->id,
        ]);
    }

    public function render()
    {
        return view('livewire.create-license-key-modal');
    }
}
