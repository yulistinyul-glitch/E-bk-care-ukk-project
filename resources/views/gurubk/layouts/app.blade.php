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

    <div class="modal fade" id="modalDetailSaran" tabindex="-1" style="z-index: 99999;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title text-white">Detail Saran Siswa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="fw-bold text-muted small">DITUJUKAN UNTUK:</label>
                        <p id="detailTarget" class="fw-bold text-primary"></p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold text-muted small">PENGIRIM:</label>
                        <p id="detailPengirim"></p>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="fw-bold text-muted small">ISI PESAN:</label>
                        <div class="p-3 bg-light rounded border">
                            <p id="detailPesan" style="white-space: pre-wrap; color:black;"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JS ini juga ditaruh di layout agar global
        const modalDetail = document.getElementById('modalDetailSaran');
        if(modalDetail) {
            modalDetail.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget; // Perbaikan typo di sini
                
                const pesan = button.getAttribute('data-pesan');
                const pengirim = button.getAttribute('data-pengirim');
                const target = button.getAttribute('data-target');

                modalDetail.querySelector('#detailPesan').textContent = pesan;
                modalDetail.querySelector('#detailPengirim').textContent = pengirim;
                modalDetail.querySelector('#detailTarget').textContent = target;
            });
        }
    </script>
</body>
</html>