<div>
    <div class="orders">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="box-title">Daftar Transaksi Masuk</h4>
            </div>
            <div class="card-body--">
              <div class="table-stats order-table ov-h">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Phone Number</th>
                      <th>Address</th>
                      <th>Total Transaction</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($orders as $item)
                      <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->country }}, {{ $item->state}}, {{ $item->city }}</td>
                        <td>${{ $item->total_price }}</td>
                        <td>
                          @if($item->status == 'PENDING')
                            <span class="badge badge-info">
                          @elseif($item->status == 'SUCCESS')
                            <span class="badge badge-success">
                          @elseif($item->status == 'FAILED')
                            <span class="badge badge-warning">
                          @else
                            <span>
                          @endif
                            {{ $item->status }}
                            </span>
                        </td>
                        <td>
                          @if($item->status == 'PENDING')
                            <button wire:click="setSuccess({{$item->id}})" class="btn btn-success btn-sm">
                              <i class="fa fa-check"></i>
                            </button>
                            <button wire:click="setFailed({{$item->id}})" class="btn btn-warning btn-sm">
                              <i class="fa fa-times"></i>
                            </button>
                          @endif
                          <a wire:click="$emit('showModal', '{{$item->id}}')"
                            class="btn btn-info btn-sm">
                            <i class="fa fa-eye"></i>
                          </a>
                          <a href="{{ route('orders.edit', $item->id) }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-pencil"></i>
                          </a>
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
                            Data Not Available
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

    <livewire:components.detail-order-modal />
</div>
