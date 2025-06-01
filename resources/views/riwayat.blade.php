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

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
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
                                <th>Durasi</th>
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
                                            title="Edit Obat"
                                        >
                                            <i class="bi bi-pencil"></i> 
                                        </button>

                                        <form action="{{ route('riwayat.destroy', $medication->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus obat {{ $medication->nama_obat }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus Obat">
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

<!-- Modal Edit Obat -->
<div class="modal fade" id="editMedicationModal" tabindex="-1" aria-labelledby="editMedicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editMedicationModalLabel">
                    <i class="bi bi-pencil-square me-2"></i>Edit Obat
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editMedicationForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_nama_obat" class="form-label">Nama Obat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_nama_obat" name="nama_obat" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_jenis_obat" class="form-label">Jenis Obat <span class="text-danger">*</span></label>
                            <select class="form-select" id="edit_jenis_obat" name="jenis_obat" required>
                                <option value="">Pilih Jenis Obat</option>
                                <option value="Tablet/Kapsul">Tablet/Kapsul</option>
                                <option value="Sirup">Sirup</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="edit_jumlah_obat" class="form-label">Jumlah Obat <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="edit_jumlah_obat" name="jumlah_obat" min="0.01" step="0.01" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edit_dosis" class="form-label">Dosis <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_dosis" name="dosis" placeholder="Contoh: 500mg" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edit_durasi" class="form-label">Durasi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_durasi" name="durasi" placeholder="Contoh: 7 hari" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_dikonsumsi" class="form-label">Waktu Konsumsi <span class="text-danger">*</span></label>
                        <select class="form-select" id="edit_dikonsumsi" name="dikonsumsi" required>
                            <option value="">Pilih Waktu Konsumsi</option>
                            <option value="sebelum makan">Sebelum Makan</option>
                            <option value="sesudah makan">Sesudah Makan</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Catatan:</strong> Pastikan semua informasi yang dimasukkan sudah benar sebelum menyimpan perubahan.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-circle me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const editModal = document.getElementById("editMedicationModal");
    const editForm = document.getElementById("editMedicationForm");

    editModal.addEventListener("show.bs.modal", function(event) {
        const button = event.relatedTarget; 

        const medicationId = button.getAttribute("data-id");
        const namaObat = button.getAttribute("data-nama");
        const jenisObat = button.getAttribute("data-jenis");
        const jumlahObat = button.getAttribute("data-jumlah");
        const dosis = button.getAttribute("data-dosis");
        const durasi = button.getAttribute("data-durasi");
        const dikonsumsi = button.getAttribute("data-dikonsumsi");

        // Debug log
        console.log("Editing medication:", {
            id: medicationId,
            nama: namaObat,
            jenis: jenisObat,
            jumlah: jumlahObat,
            dosis: dosis,
            durasi: durasi,
            dikonsumsi: dikonsumsi
        });

        // Set action URL untuk form
        editForm.action = `/riwayat/${medicationId}`;

        document.getElementById("edit_nama_obat").value = namaObat || "";
        document.getElementById("edit_jenis_obat").value = jenisObat || "";
        document.getElementById("edit_jumlah_obat").value = jumlahObat || "";
        document.getElementById("edit_dosis").value = dosis || "";
        document.getElementById("edit_durasi").value = durasi || "";
        document.getElementById("edit_dikonsumsi").value = dikonsumsi || "";

        clearValidationErrors();
    });

    // Handle form submission
    editForm.addEventListener("submit", function(e) {
        e.preventDefault();

        // Clear previous validation errors
        clearValidationErrors();

        // Basic client-side validation
        if (validateForm()) {
            // Show loading state
            const submitBtn = editForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Menyimpan...';
            submitBtn.disabled = true;

            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            const csrfValue = csrfToken ? csrfToken.getAttribute('content') : 
                             document.querySelector('input[name="_token"]')?.value || '';

            // Submit form menggunakan fetch untuk AJAX
            const formData = new FormData(editForm);
            
            fetch(editForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    ...(csrfValue && { 'X-CSRF-TOKEN': csrfValue })
                }
            })
            .then(response => {
                if (response.ok) {
                    return response.json().catch(() => {
                        // Jika response bukan JSON, anggap berhasil
                        return { success: true, message: 'Data obat berhasil diperbarui!' };
                    });
                } else if (response.status === 422) {
                    // Validation error
                    return response.json();
                } else {
                    throw new Error('Network response was not ok');
                }
            })
            .then(data => {
                if (data.success !== false) {
                    // Show success message
                    showAlert('success', data.message || 'Data obat berhasil diperbarui!');
                    
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(editModal);
                    if (modal) {
                        modal.hide();
                    }
                    
                    // Reload page after short delay
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    // Handle validation errors
                    if (data.errors) {
                        showValidationErrors(data.errors);
                    } else {
                        showAlert('danger', data.message || 'Terjadi kesalahan saat menyimpan data.');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Jika AJAX gagal, submit form secara normal
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                editForm.submit();
            })
            .finally(() => {
                // Reset button state jika masih ada
                if (submitBtn && !submitBtn.disabled) {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            });
        }
    });

    // Function to validate form
    function validateForm() {
        let isValid = true;

        // Required fields validation
        const requiredFields = [
            'edit_nama_obat',
            'edit_jenis_obat', 
            'edit_jumlah_obat',
            'edit_dosis',
            'edit_durasi',
            'edit_dikonsumsi'
        ];

        requiredFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field && !field.value.trim()) {
                showFieldError(field, 'Field ini wajib diisi.');
                isValid = false;
            }
        });

        // Numeric validation
        const jumlahObat = document.getElementById('edit_jumlah_obat');
        if (jumlahObat && jumlahObat.value && parseFloat(jumlahObat.value) <= 0) {
            showFieldError(jumlahObat, 'Jumlah obat harus lebih dari 0.');
            isValid = false;
        }

        return isValid;
    }

    // Function to show field error
    function showFieldError(field, message) {
        if (field) {
            field.classList.add('is-invalid');
            const feedback = field.nextElementSibling;
            if (feedback && feedback.classList.contains('invalid-feedback')) {
                feedback.textContent = message;
            }
        }
    }

    // Function to clear validation errors
    function clearValidationErrors() {
        const invalidFields = editForm.querySelectorAll('.is-invalid');
        invalidFields.forEach(field => {
            field.classList.remove('is-invalid');
        });

        const feedbacks = editForm.querySelectorAll('.invalid-feedback');
        feedbacks.forEach(feedback => {
            feedback.textContent = '';
        });
    }

    // Function to show validation errors from server
    function showValidationErrors(errors) {
        Object.keys(errors).forEach(fieldName => {
            const field = document.getElementById(`edit_${fieldName}`);
            if (field) {
                showFieldError(field, errors[fieldName][0]);
            }
        });
    }

    // Function to show alert
    function showAlert(type, message) {
        // Remove existing alerts
        const existingAlerts = document.querySelectorAll('.alert-dynamic');
        existingAlerts.forEach(alert => alert.remove());

        // Create new alert
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show alert-dynamic`;
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;

        // Insert alert at the top of container
        const container = document.querySelector('.container');
        if (container) {
            container.insertBefore(alertDiv, container.firstChild);
        }

        // Auto dismiss after 5 seconds
        setTimeout(() => {
            if (alertDiv && alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }
});
</script>
@endsection
