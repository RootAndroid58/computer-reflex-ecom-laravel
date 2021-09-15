<?php

namespace App\Http\Livewire\Admin\Ui;

use Livewire\Component;
use App\Models\HomeSection;

class ManageHomeCarousel extends Component
{
    public $deleteSectionId;

    public function updatePosition($items)
    {
        foreach ($items as $key => $item) {
            HomeSection::where('id', $item['value'])->update([
                'position' => $item['order'],
            ]);
        }
    }

    public function deleteSectionById($sectionId)
    {
        $this->deleteSectionId = $sectionId;
    }

    public function deleteSection()
    {
        HomeSection::where('id', $this->deleteSectionId)->delete();
    }

    public function render()
    {
        return view('livewire.admin.ui.manage-home-carousel', [
            'HomeSections' => HomeSection::orderBy('position', 'asc')->get(),
        ]);
    }
}
