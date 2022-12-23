<div x-data="{show: @entangle('show').defer}" x-show="show" x-transition.opacity x-transition.duration.500m
 style="position: fixed;
 top: 40px;
 width: 100vw;
 height: 100vh;
 left: 0;" tabindex="-1" role="dialog">
    <div @click.outside="show = false" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span @click="show = false" aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Detail Transaksi {{$item?->uuid}}</h5>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                      <th>Name</th>
                      <td>{{ $item?->name }}</td>
                    </tr>
                    <tr>
                      <th>Email</th>
                      <td>{{ $item?->email }}</td>
                    </tr>
                    <tr>
                      <th>Phone</th>
                      <td>{{ $item?->phone }}</td>
                    </tr>
                    <tr>
                      <th>Address</th>
                      <td>{{ $item?->country }}, {{ $item?->state }}, {{ $item?->city }}</td>
                    </tr>
                    <tr>
                      <th>Total Transaction</th>
                      <td>{{ $item?->total_price }}</td>
                    </tr>
                    <tr>
                      <th>Status</th>
                      <td>{{ $item?->status }}</td>
                    </tr>
                    <tr>
                      <th>Payment Method</th>
                      <td>{{ $item?->status }}</td>
                    </tr>
                    <tr>
                      <th>Shipment Method</th>
                      <td>{{ $item?->status }}</td>
                    </tr>
                    <tr>
                      <th>Pembelian Produk</th>
                      <td>
                        <table class="tabble table-bordered w-100">
                          <tr>
                            <th>Nama</th>
                            <th>Tipe</th>
                            <th>Harga</th>
                          </tr>
                          @if ($item)
                            @foreach ($item?->order_details as $detail)
                                <tr>
                                    <td>{{ $detail->product->name }}</td>
                                    <td>{{ $detail->product->category }}</td>
                                    <td>${{ $detail->product->price }}</td>
                                </tr>
                            @endforeach
                          @endif
                        </table>
                      </td>
                    </tr>
                </table>
                  <div class="row">
                    <div class="col-4">
                      <button wire:click="setSuccess" class="btn btn-success btn-block">
                        <i class="fa fa-check"></i> Set Success
                      </button>
                    </div>
                    <div class="col-4">
                      <button wire:click="setFailed"  class="btn btn-warning btn-block">
                        <i class="fa fa-times"></i> Set Failed
                      </button>
                    </div>
                    <div class="col-4">
                      <button wire:click="setPending" class="btn btn-info btn-block">
                        <i class="fa fa-spinner"></i> Set Pending
                      </button>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>
