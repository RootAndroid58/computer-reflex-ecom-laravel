<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use App\Models\HomeComponent;
use Illuminate\Support\Facades\Auth;

class HomeComponents extends Component
{
    protected $listeners = ['refresh' => '$refresh', 'deleteComponentInit' => 'deleteComponentInit'];
    
    public $deleteComponentId = null;

    public function deleteComponentInit($id)
    {
        $this->deleteComponentId = $id;
    }

    public function deleteComponent()
    {
        abort_unless(Auth::check() && Auth::user()->hasAnyPermission(['Manage UI', 'Master Admin']), '403', 'Unauthorized.');

        HomeComponent::where('id', $this->deleteComponentId)->delete();
        $this->emit('modal', [
            'el'        => '#DeleteComponentModal',
            'action'    => 'hide',
        ]);
    }

    public function updatePosition($items)
    {
        abort_unless(Auth::check() && Auth::user()->hasAnyPermission(['Manage UI', 'Master Admin']), '403', 'Unauthorized.');
        
        foreach ($items as $key => $item) {
            HomeComponent::where('id', $item['value'])->update([
                'position' => $item['order'],
            ]);
        }
    }

    public function render()
    {
        return view('livewire.home.home-components', [
            'components' => HomeComponent::orderBy('position', 'asc')->get(),
        ]);
    }
}
