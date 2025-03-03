@foreach ($parker as $item)
<div class="modal fade text-left" id="info{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">Informasi</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <h5><strong>Lokasi Parkir: </strong>{{ $item->jam->tmptParkir ?? 'Tidak Diketahui' }}</h5>
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
                            <tr>
                                <td>1</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y / H:i:s') }}</td>
                                <td>{{ $item->user->namaLengkap ?? 'Tidak Diketahui' }}</td>
                                <td>{{ $item->nopol_list }}</td>
                                <td>{{ $item->jumlahMotor }}</td>
                                <td>{{ Rupiah($item->nilaiMotor) }}</td>
                                <td>{{ $item->jumlahMobil }}</td>
                                <td>{{ Rupiah($item->nilaiMobil) }}</td>
                                <td>{{ Rupiah($item->total_nominal) }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach