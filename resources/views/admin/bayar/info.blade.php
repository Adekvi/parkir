@foreach ($parker as $item)
<div class="modal fade text-left" id="info{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialogmodal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">Informasi Parkir</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('admin/harga-tambah') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="table">
                        <div class="table-responsive">
                            <table class="table table-bordered" style="width: 100%; overflow-y: auto">
                                <thead class="table-primary text-center" style="white-space: nowrap">
                                    <tr>
                                        <th>No.</th>
                                        <th>Hari, Tanggal dan Jam</th>
                                        <th>Nama Petugas</th>
                                        <th>Nominal</th>
                                        <th>Potongan 30%</th>
                                        <th>Plat Nomor</th>
                                        <th>Jenis Kendaraan</th>
                                        {{-- <th>Stok</th> --}}
                                    </tr>
                                </thead>
                                <tbody class="text-center" style="white-space: nowrap">
                                    <?php  
                                        if (!function_exists('Rupiah')) {
                                            function Rupiah($angka)
                                            {
                                                return "Rp " . number_format($angka, 2, ',', '.');
                                            }
                                        }
                                    ?>
                                    @foreach ($parker as $log)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($log->created_at)->translatedFormat('l, d F Y / H:i:s') }}</td>
                                            <td>{{ $log->user->namaLengkap }}</td>
                                            <td>{{ $log->nominal ? Rupiah($log->nominal) : '0' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endforeach