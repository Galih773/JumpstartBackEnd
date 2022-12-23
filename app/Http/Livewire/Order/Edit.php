<?php

namespace App\Http\Livewire\Order;

use App\Models\Orders;
use Livewire\Component;

class Edit extends Component
{
    public $name;
    public $email;
    public $phone;
    public $country;
    public $state;
    public $city;
    public $order;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'country' => 'required',
        'state' => 'required',
        'city' => 'required',
    ];

    public function mount(){
        $this->order = Orders::find(request()->item);
        $this->name = $this->order->name;
        $this->email = $this->order->email;
        $this->phone = $this->order->phone;
        $this->country = $this->order->country;
        $this->state = $this->order->state;
        $this->city = $this->order->city;
    }

    public function saveOrder(){
        $this->validate();

        $this->order->name = $this->name;
        $this->order->email = $this->email;
        $this->order->phone = $this->phone;
        $this->order->country = $this->country;
        $this->order->state = $this->state;
        $this->order->city = $this->city;
        $this->order->update();

        redirect()->route('orders.index');
    }

    public function render()
    {
        return view('livewire.order.edit');
    }
}
