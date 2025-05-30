@extends('layouts.app')

@section('title', 'Riwayat Obat - MATE')

@section('styles')
<style>
    .navbar-custom {
        background-color: #ffffff;
        border-bottom: 1px solid #e0e0e0;
        padding: 0.5rem 0;
    }
    
    .nav-link {
        color: #6c757d !important;
        font-weight: 500;
        margin: 0 1rem;
    }
    
    .nav-link.active {
        color: #28a745 !important;
        border-bottom: 2px solid #28a745;
    }
    
    .page-title {
        color: #dc3545;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }
</style>
@endsection

@section('content')
<div class="container p-4">
    <div class="row justify-content-start w-100 gap-5">
        <div class="col-lg-12">
            <h2 class="page-title text-danger mb-4">Riwayat Obat</h2>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Search Form -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <form method="GET" action="{{ route('riwayat') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" 
                                   placeholder="Cari nama obat..." 
                                   value="{{ request('search') }}">
                            <button class="btn btn-success" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('tambah-obat') }}" class="btn btn-primary">
                        <i class="bi bi-plus me-2"></i>Tambah Obat Baru
                    </a>
                </div>
            </div>
            
            @if($medications->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-danger text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Obat</th>
                                <th>Jenis Obat</th>
                                <th>Jumlah</th>
                                <th>Dosis</th>
                                <th>Durasi (Hari)</th>
                                <th>Dikonsumsi</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($medications as $index => $medication)
                                <tr>
                                    <td class="text-center">{{ $medications->firstItem() + $index }}</td>
                                    <td>{{ $medication->nama_obat }}</td>
                                    <td class="text-center">{{ $medication->jenis_obat }}</td>
                                    <td class="text-center">{{ $medication->jumlah_obat }}</td>
                                    <td class="text-center">{{ $medication->dosis }}</td>
                                    <td class="text-center">{{ $medication->durasi }}</td>
                                    <td>{{ ucfirst($medication->dikonsumsi) }}</td>
                                    <td class="text-center">{{ $medication->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <button 
                                            class="btn btn-sm btn-warning me-2 btn-edit"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editMedicationModal"
                                            data-id="{{ $medication->id }}"
                                            data-nama="{{ $medication->nama_obat }}"
                                            data-jenis="{{ $medication->jenis_obat }}"
                                            data-jumlah="{{ $medication->jumlah_obat }}"
                                            data-dosis="{{ $medication->dosis }}"
                                            data-durasi="{{ $medication->durasi }}"
                                            data-dikonsumsi="{{ $medication->dikonsumsi }}"
                                        >
                                            <i class="bi bi-pencil"></i> 
                                        </button>

                                        <form action="{{ route('obat.destroy', $medication->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus obat {{ $medication->nama_obat }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>    
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted">
                        Menampilkan {{ $medications->firstItem() }} sampai {{ $medications->lastItem() }} 
                        dari {{ $medications->total() }} data
                    </div>
                    <div>
                        {{ $medications->appends(request()->query())->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-pills fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada riwayat obat</h5>
                    <p class="text-muted">
                        @if(request('search'))
                            Tidak ditemukan obat dengan kata kunci "{{ request('search') }}"
                        @else
                            Tambahkan obat pertama Anda untuk melihat riwayat
                        @endif
                    </p>
                    <a href="{{ route('tambah-obat') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Obat
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="modal fade" id="editMedicationModal" tabindex="-1" aria-labelledby="editMedicationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editMedicationForm" method="POST" action="">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editMedicationModalLabel">Edit Obat</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="edit-nama_obat" class="form-label">Nama Obat</label>
                <input type="text" class="form-control" id="edit-nama_obat" name="nama_obat" required>
            </div>
            <div class="mb-3">
                <label for="edit-jenis_obat" class="form-label">Jenis Obat</label>
                <select class="form-select" id="edit-jenis_obat" name="jenis_obat" required>
                    <option value="Tablet/Kapsul">Tablet/Kapsul</option>
                    <option value="Sirup">Sirup</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="edit-jumlah_obat" class="form-label">Jumlah Obat</label>
                <input type="number" class="form-control" id="edit-jumlah_obat" name="jumlah_obat" required min="1">
            </div>
            <div class="mb-3">
                <label for="edit-dikonsumsi" class="form-label">Dikonsumsi</label>
                <select class="form-select" id="edit-dikonsumsi" name="dikonsumsi" required>
                    <option value="sebelum makan">Sebelum Makan</option>
                    <option value="sesudah makan">Sesudah Makan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="edit-dosis" class="form-label">Dosis</label>
                <input type="text" class="form-control" id="edit-dosis" name="dosis" required>
            </div>
            <div class="mb-3">
                <label for="edit-durasi" class="form-label">Durasi (Hari)</label>
                <input type="number" class="form-control" id="edit-durasi" name="durasi" required min="1">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var editModal = document.getElementById('editMedicationModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;

        // Ambil data dari tombol yang diklik
        var id = button.getAttribute('data-id');
        var nama = button.getAttribute('data-nama');
        var jenis = button.getAttribute('data-jenis');
        var jumlah = button.getAttribute('data-jumlah');
        var dosis = button.getAttribute('data-dosis');
        var durasi = button.getAttribute('data-durasi');
        var dikonsumsi = button.getAttribute('data-dikonsumsi');

        // Set nilai form input modal
        document.getElementById('edit-nama_obat').value = nama;
        document.getElementById('edit-jenis_obat').value = jenis;
        document.getElementById('edit-jumlah_obat').value = jumlah;
        document.getElementById('edit-dosis').value = dosis;
        document.getElementById('edit-durasi').value = durasi;
        document.getElementById('edit-dikonsumsi').value = dikonsumsi;

        // Set action form ke route update dengan ID
        var form = document.getElementById('editMedicationForm');
        form.action = `/riwayat/${id}`
    });
});

// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 500);
        }, 5000);
    });
});
</script>
@endsection