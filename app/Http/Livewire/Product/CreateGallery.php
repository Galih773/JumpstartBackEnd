<?php

namespace App\Http\Livewire\Product;

use App\Models\ProductGalleries;
use App\Models\Products;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateGallery extends Component
{
    use WithFileUploads;
    
    public $product_id;
    public $photos;
    public $products;

    protected $rules = [
        'product_id' => 'required',
        'photos.*' => 'image|max:1024', // 1MB Max
    ];

    public function mount()
    {
        $this->products = Products::all();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function savePhotos()
    {
        $this->validate();
        
        foreach ($this->photos as $photo) {
            ProductGalleries::create([
                'product_id' => $this->product_id,
                'url' => $photo->store('products', 'public'),
            ]);
        }

        return redirect()->route('product-galleries.index');
    }

    public function render()
    {
        return view('livewire.product.create-gallery');
    }
}
