<?php

namespace App\Http\Livewire\Product;

use App\Models\Products;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $name;
    public $description;
    public $price = 1;
    public $stock = 0;
    public $category;
    public $color;
    public $brand;
    public $discount = 0;

    public $idProduct;
    public $titlePage = 'Create Product';

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric|min:1',
        'stock' => 'required|numeric|min:0',
        'category' => 'required',
        'color' => 'required',
        'brand' => 'required',
        'discount' => 'required|numeric|min:0|max:100',
    ];

    public function mount(){
        $this->idProduct = request()->product;
        
        if($this->idProduct){
            $product = Products::find($this->idProduct);
            $this->name = $product->name;
            $this->description = $product->description;
            $this->price = $product->price;
            $this->stock = $product->stock;
            $this->category = $product->category;
            $this->color = $product->color;
            $this->brand = $product->brand;
            $this->discount = $product->discount;

            $this->titlePage = 'Edit Product';
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit() 
    {
        $this->validate();

        if($this->idProduct){
            $product = Products::find($this->idProduct);
            $product->update([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'description' => $this->description,
                'price' => $this->price,
                'stock' => $this->stock,
                'category' => $this->category,
                'color' => $this->color,
                'brand' => $this->brand,
                'discount' => $this->discount,
            ]);

            return redirect()->route('products.index');

        } else {
            Products::create([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'description' => $this->description,
                'price' => $this->price,
                'stock' => $this->stock,
                'category' => $this->category,
                'color' => $this->color,
                'brand' => $this->brand,
                'discount' => $this->discount,
            ]);
        }

        return redirect()->route('products.index');
    }


    public function render()
    {
        return view('livewire.product.create');
    }
}
