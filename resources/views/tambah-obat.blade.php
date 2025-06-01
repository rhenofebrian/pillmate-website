@extends('layouts.app')

@section('title', 'Tambah Obat - Pillmate')

@section('content')
<div class="container m-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card" style="background-color: #f8f9fa;">
                <div class="card-body p-4">
                    <form action="{{ route('tambah-obat.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="medicationType" class="form-label fw-medium text-danger">
                                Pilih jenis obat :
                            </label>
                            <select name="jenis_obat" class="form-select border-danger" id="medicationType" style="border-color: #dc3545 !important;">
                                <option value="Tablet/Kapsul">Tablet / Kapsul</option>
                                <option value="Sirup">Sirup</option>
                            </select>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="medicineName" class="form-label fw-medium">
                                    Nama Obat
                                </label>
                                <input 
                                    name="nama_obat"
                                    type="text" 
                                    class="form-control border-warning" 
                                    id="medicineName" 
                                    placeholder="Masukkan nama obat"
                                    style="border-color: #ffc107 !important;"
                                >
                            </div>
                            <div class="col-md-6">
                                <label for="consumptionTime" class="form-label fw-medium">
                                    Dikonsumsi
                                </label>
                                <select name="dikonsumsi" class="form-select border-warning" id="consumptionTime" style="border-color: #ffc107 !important;">
                                    <option value="sesudah makan">Sesudah Makan</option>
                                    <option value="sebelum makan">Sebelum Makan</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="form-label fw-medium">
                                Jumlah Obat
                            </label>
                            <div class="input-group">
                                <input 
                                    name="jumlah_obat"
                                    type="text" 
                                    class="form-control border-warning" 
                                    id="quantity" 
                                    placeholder="Masukkan jumlah obat"
                                    style="border-color: #ffc107 !important;"
                                >
                                <span id="unitLabel" class="input-group-text bg-transparent border-warning" style="border-color: #ffc107 !important;">
                                    buah
                                </span>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-medium">
                                Dosis
                            </label>
                            <div class="d-flex align-items-center gap-2">
                                <input 
                                    name="dosis"
                                    type="text" 
                                    class="form-control border-warning" 
                                    placeholder="1/2/3/..." 
                                    style="max-width: 100px; border-color: #ffc107 !important;"
                                >
                                <span class="text-muted">kali</span>
                                <span class="text-warning mx-2" style="font-size: 1.2em;">×</span>
                                <input 
                                    name="durasi"
                                    type="text" 
                                    class="form-control border-warning" 
                                    placeholder="1/2/3/..." 
                                    style="max-width: 100px; border-color: #ffc107 !important;"
                                >
                                <span class="text-muted">hari</span>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning fw-medium py-2" style="background-color: #ffc107; border-color: #ffc107;">
                                Lanjutkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const medicationType = document.getElementById('medicationType');
        const unitLabel = document.getElementById('unitLabel');

        function updateUnitLabel() {
            if (medicationType.value === 'Sirup') {
                unitLabel.textContent = 'ml';
            } else {
                unitLabel.textContent = 'buah';
            }
        }
        updateUnitLabel();

        medicationType.addEventListener('change', updateUnitLabel);
    });
</script>

@endsection
