<div>
    <div class="card">
        <div class="card-header">
          <strong>{{$titlePage}}</strong>
        </div>
        <div class="card-body card-block">
          <form wire:submit.prevent="submit">
            <div class="form-group">
              <label for="name" class="form-control-label">Product Name</label>
              <input  type="text"
                      name="name" 
                      wire:model="name" 
                      class="form-control @error('name') is-invalid @enderror"/>
              @error('name') <div class="text-muted">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
              <label for="type" class="form-control-label">Product Category</label>
              <input  type="text"
                      name="type" 
                      wire:model="category" 
                      class="form-control @error('category') is-invalid @enderror"/>
              @error('category') <div class="text-muted">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
              <label for="type" class="form-control-label">Brand</label>
              <input  type="text"
                      name="type" 
                      wire:model="brand" 
                      class="form-control @error('brand') is-invalid @enderror"/>
              @error('brand') <div class="text-muted">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
              <label for="type" class="form-control-label">Color</label>
              <input  type="text"
                      name="type" 
                      wire:model="color" 
                      class="form-control @error('color') is-invalid @enderror"/>
              @error('color') <div class="text-muted">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
              <label for="description" class="form-control-label">Product Description</label>
              <textarea name="description" 
                        wire:model="description"
                        class="ckeditor form-control @error('description') is-invalid @enderror"></textarea>
              @error('description') <div class="text-muted">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
              <label for="price" class="form-control-label">Product Price ( $ )</label>
              <input  type="number"
                      name="price" 
                      wire:model="price" 
                      class="form-control @error('price') is-invalid @enderror"/>
              @error('price') <div class="text-muted">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
              <label for="quantity" class="form-control-label">Kuantitas Barang</label>
              <input  type="number"
                      name="quantity" 
                      wire:model="stock" 
                      class="form-control @error('stock') is-invalid @enderror"/>
              @error('stock') <div class="text-muted">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
              <label for="quantity" class="form-control-label">Discount ( % )</label>
              <input  type="number"
                      name="quantity" 
                      wire:model="discount" 
                      class="form-control @error('discount') is-invalid @enderror"/>
              @error('discount') <div class="text-muted">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-block" type="submit">
                Add Product
              </button>
            </div>
          </form>
        </div>
      </div>
</div>
