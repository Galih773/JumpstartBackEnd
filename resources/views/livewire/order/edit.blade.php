<div>
    <div class="card">
      <div class="card-header">
        <strong>Ubah Transaksi</strong>
        <small>{{ $order->uuid }}</small>
      </div>
      <div class="card-body card-block">
        <form wire:submit.prevent="saveOrder">
          <div class="form-group">
            <label for="name" class="form-control-label">Nama Pemesan</label>
            <input  type="text"
                    name="name" 
                    wire:model="name" 
                    class="form-control @error('name') is-invalid @enderror"/>
            @error('name') <div class="text-muted">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label for="email" class="form-control-label">Email</label>
            <input  type="email"
                    wire:model="email"
                    class="form-control @error('email') is-invalid @enderror"/>
            @error('email') <div class="text-muted">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label for="number" class="form-control-label">Nomor HP</label>
            <input  type="text"
                    wire:model="phone"  
                    class="form-control @error('phone') is-invalid @enderror"/>
            @error('phone') <div class="text-muted">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label for="address" class="form-control-label">Country</label>
            <input  type="text"
                    wire:model="country" 
                    class="form-control @error('country') is-invalid @enderror"/>
            @error('country') <div class="text-muted">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label for="address" class="form-control-label">State</label>
            <input  type="text"
                    wire:model="state" 
                    class="form-control @error('state') is-invalid @enderror"/>
            @error('state') <div class="text-muted">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label for="address" class="form-control-label">City</label>
            <input  type="text"
                    wire:model="city" 
                    class="form-control @error('city') is-invalid @enderror"/>
            @error('city') <div class="text-muted">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">
              Ubah Transaksi
            </button>
          </div>
        </form>
      </div>
    </div>
</div>
