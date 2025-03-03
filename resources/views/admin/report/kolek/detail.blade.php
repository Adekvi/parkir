@foreach ($parker as $item)
    <div class="modal fade text-left" id="setuju{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title white" id="myModalLabel160">Informasi</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table">
                        <div class="table-responsive">
                            @foreach ($parker->groupBy('id_lokasiParkir') as $lokasiParkir => $logs)
                                <div class="header">
                                    <h5>
                                        <strong>Lokasi Parkir : </strong>
                                        @foreach ($logs as $log)
                                            @if($log->jam) <!-- Pastikan ada relasi 'jam' -->
                                                {{ $log->jam->tmptParkir }} <!-- Menampilkan nama tempat parkir dari JamLokasi -->
                                            @endif
                                        @endforeach
                                    </h5>
                                </div>
                                <table class="table table-bordered" style="width: 100%; overflow-y: auto">
                                    <thead class="table-primary text-center" style="white-space: nowrap">
                                        <tr>
                                            <th>No.</th>
                                            <th>Hari, Tanggal dan Jam</th>
                                            <th>Nama Petugas</th>
                                            <th>Plat Nomor</th>
                                            <th>Jumlah Motor</th>
                                            <th>Tarif Motor</th>
                                            <th>Jumlah Mobil</th>
                                            <th>Tarif Mobil</th>
                                            <th>Total</th>
                                            <th>Setor</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center" style="white-space: nowrap">
                                        @foreach ($logs as $log)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($log->shift)
                                                        {{ \Carbon\Carbon::parse($log->shift->created_at)->timezone('Asia/Jakarta')->translatedFormat('l, d F Y / H:i:s') }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ $log->user->namaLengkap ?? 'Tidak Diketahui' }}</td>
                                                <td>{{ $log->nopol_list }}</td>
                                                <td>{{ $log->jumlahMotor }}</td>
                                                <td>{{ Rupiah($log->nilaiMotor) }}</td>
                                                <td>{{ $log->jumlahMobil }}</td>
                                                <td>{{ Rupiah($log->nilaiMobil) }}</td>
                                                <td>{{ Rupiah($log->total_nominal) }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-check-circle"></i> 
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach