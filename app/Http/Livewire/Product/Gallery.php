<?php

namespace App\Http\Livewire\Product;

use App\Models\ProductGalleries;
use App\Models\Products;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class Gallery extends Component
{
    public $product;
    public $photos;

    public function mount()
    {
        if(request()->product){
            $this->product = Products::findorFail(request()->product);
            $this->photos = $this->product->photos;
        } else {
            $this->photos = ProductGalleries::with('product')->get();
        }
        
    }

    public function destroy($id)
    {
        $photo = ProductGalleries::find($id);

        $imagePath = public_path('storage/'.$photo->url);
        
        if(File::exists($imagePath)) {
            unlink($imagePath);
        }

        $photo->delete();
        
        session()->flash('message', 'Photo successfully deleted.');

        $this->mount();
        $this->render();
    }

    public function render()
    {

        return view('livewire.product.gallery');
    }
}
