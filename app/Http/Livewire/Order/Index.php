<?php

namespace App\Http\Livewire\Order;

use App\Models\Orders;
use Livewire\Component;

class Index extends Component
{

    public function setSuccess($orderId)
    {
        $order = Orders::find($orderId);
        $order->status = 'SUCCESS';
        $order->update();
        $this->emit('orderUpdated');
    }

    public function setFailed($orderId)
    {
        $order = Orders::find($orderId);
        $order->status = 'FAILED';
        $order->update();
        $this->emit('orderUpdated');
    }

    public function destroy($orderId)
    {
        $order = Orders::find($orderId);
        $order->delete();
        $this->emit('orderUpdated');
    }

    public function render()
    {
        return view('livewire.order.index', [
            'orders' => Orders::all(),
        ]);
    }
}
