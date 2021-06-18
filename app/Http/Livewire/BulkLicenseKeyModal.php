<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\ProductLicense;

class BulkLicenseKeyModal extends Component
{
    public $product;
    public $form = [
        'upload_type' => 'raw',
        'license_keys' => '',
    ];

    public function rules()
    {
        return [
            'form.upload_type' =>   ['required', 'in:raw,csv'],
            'form.license_keys' =>  ['required', 'required_if:form.upload_type,raw'],
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function submit()
    {
        $this->validate();
        $license_keys = preg_split("/\r\n|\n|\r/", $this->form['license_keys'], -1,PREG_SPLIT_NO_EMPTY);

        foreach ($license_keys as $key => $license_key) {
            ProductLicense::firstOrCreate([
                'product_id'    => $this->product->id,
                'key'           => $license_key,
                'status'        => 'unused',
            ]);
        }

        $this->emit('BulkUploaded');
    }

    public function render()
    {
        return view('livewire.bulk-license-key-modal');
    }
}
