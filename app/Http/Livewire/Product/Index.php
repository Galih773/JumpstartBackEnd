<?php

namespace App\Http\Livewire\Product;

use App\Models\Products;
use Livewire\Component;

class Index extends Component
{
    public function destroy($id)
    {
        $product = Products::find($id);
        $product->delete();

        session()->flash('message', 'Product successfully deleted.');
    }

    public function render()
    {
        return view('livewire.product.index', [
            'products' => Products::all()]);
    }
}
