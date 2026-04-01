<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Guru Bk</title>
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/logo_ebk-careGold.png') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/vendors.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/daterangepicker.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/theme.min.css') }}" />

    <style> body { font-family: 'Poppins', sans-serif; background: #f0f2f5; } </style>

</head>

<body>
    @include('gurubk.layouts.sidebar')

    @include('gurubk.layouts.navbar')

    <main class="nxl-container">
        <div class="nxl-content">
            <div class="main-content">
                @yield('content') 
            </div>
        </div>
    </main>

    <script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/js/common-init.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme-customizer-init.min.js') }}"></script>

  {{-- pop up modal --}}
  <div class="modal fade" id="modalDetailSaran" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-header border-0 pb-0 px-4 pt-4">
                    <h5 class="fw-bold text-dark mb-0">Detail Aspirasi</h5>
                    <button type="button" class="btn-close small" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="p-3 bg-light rounded-4">
                                <label class="d-block text-muted small fw-bold text-uppercase mb-1" style="font-size: 10px; letter-spacing: 1px;">Ditujukan Ke</label>
                                <span id="detailTarget" class="fw-bold text-primary"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-light rounded-4">
                                <label class="d-block text-muted small fw-bold text-uppercase mb-1" style="font-size: 10px; letter-spacing: 1px;">Pengirim</label>
                                <span id="detailPengirim" class="fw-bold text-dark text-truncate d-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="d-block text-muted small fw-bold text-uppercase mb-2" style="font-size: 10px; letter-spacing: 1px;">Isi Pesan/Saran</label>
                        <div class="p-4 bg-white rounded-4 border shadow-sm" style="min-height: 120px; border-color: #f1f5f9 !important;">
                            <p id="detailPesan" class="mb-0 text-dark lh-base" style="white-space: pre-wrap; font-size: 0.95rem;"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 d-flex gap-2">
                    <button type="button" class="btn btn-light flex-grow-1 fw-bold py-2 shadow-sm" data-bs-dismiss="modal" style="border-radius: 12px; border: 1px solid #e2e8f0;">Tutup</button>
                    <form id="formTandaiBaca" action="" method="POST" class="flex-grow-1">
                        @csrf 
                        @method('PATCH')
                        <button type="submit" id="btnTandaiBaca" class="btn btn-primary w-100 fw-bold py-2 shadow-sm" style="border-radius: 12px; background: #4f46e5; border: none;">
                            <i class="bi bi-check2-all me-1"></i> Tandai Baca
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalDetail = document.getElementById('modalDetailSaran');
        if(modalDetail) {
            modalDetail.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                
                const id = button.getAttribute('data-id'); 
                const status = button.getAttribute('data-status');
                const pesan = button.getAttribute('data-pesan');
                const pengirim = button.getAttribute('data-pengirim');
                const target = button.getAttribute('data-target');

                this.querySelector('#detailPesan').textContent = pesan;
                this.querySelector('#detailPengirim').textContent = pengirim;
                this.querySelector('#detailTarget').textContent = target;

                const formUpdate = this.querySelector('#formTandaiBaca');
                
                if (status === 'unread') {
                    formUpdate.action = `/gurubk/saran/${id}/read`; 
                    formUpdate.style.display = 'block';
                } else {
                    formUpdate.style.display = 'none';
                }
            });
        }
    });
</script>
</body>
</html>