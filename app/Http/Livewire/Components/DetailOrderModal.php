<?php

namespace App\Http\Livewire\Components;

use App\Models\Orders;
use Livewire\Component;

class DetailOrderModal extends Component
{
    public $show = false;
    public $item;

    protected $listeners = [
        'showModal' => 'showDetailMenu'
    ];

    public function showDetailMenu(Orders $meal){
        $this->item = $meal;
        $this->show = true;
    }

    public function setSuccess(){
        $this->item->status = 'SUCCESS';
        $this->item->update();
        $this->show = false;

        redirect()->route('orders.index');
    }

    public function setPending(){
        $this->item->status = 'PENDING';
        $this->item->update();
        $this->show = false;

        redirect()->route('orders.index');
    }
    
    public function setFailed(){
        $this->item->status = 'FAILED';
        $this->item->update();
        $this->show = false;

        redirect()->route('orders.index');
    }

    public function render()
    {
        return view('livewire.components.detail-order-modal');
    }
}
