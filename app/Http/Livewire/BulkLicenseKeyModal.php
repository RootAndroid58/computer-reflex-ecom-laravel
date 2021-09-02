<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\ProductLicense;

use Livewire\WithFileUploads;

class BulkLicenseKeyModal extends Component
{
    use WithFileUploads;

    public $product;
    public $parse_data;


    public $form = [
        'upload_type'   => 'raw',
        'license_keys'  => '',
        'csv'           => '',
        'header'        => '',
    ];

    public function rules()
    {
        return [
            'form.upload_type' =>   ['required', 'in:raw,csv'],
            'form.license_keys' =>  ['required_if:form.upload_type,raw'],
            'form.csv'          =>  ['required_if:form.upload_type,csv'],
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function submit()
    {
        // $path = $this->form['csv']->getRealPath();
        // $data = array_map('str_getcsv', file($path));
        // $this->parse_data = array_slice($data, 0, 5);
        
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
