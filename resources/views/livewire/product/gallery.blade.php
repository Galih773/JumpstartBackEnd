<div>
    <div class="orders">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h4 class="box-title">Daftar Foto Barang  <small>{{ "- " . $product?->name }}</small></h4>
              </div>
              <div class="card-body--">
                <div class="table-stats order-table ov-h">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>ID#</th>
                        <th>Product Name</th>
                        <th>Photo</th>
                        {{-- <th>Default</th> --}}
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($photos as $item)
                        <tr>
                          <td>{{ $item->id }}</td>
                          <td>{{ $item->product->name }}</td>
                          <td>
                            <img src={{ asset("storage/".$item->url) }} alt="" />
                          </td>
                          {{-- <td>{{ $item->is_default ? 'Ya' : 'Tidak' }}</td> --}}
                          <td>
                            <div class="d-inline">
                              <button wire:click="destroy({{$item->id}})" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                              </button>
                            </div>
                          </td>
                        </tr>
                      @empty
                          <tr>
                            <td colspan="6" class="text-center p-5">
                              No data available
                            </td>
                          </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
