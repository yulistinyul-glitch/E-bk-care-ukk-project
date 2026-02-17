<header class="nxl-header">
    <div class="header-wrapper">
        <div class="header-left d-flex align-items-center gap-4">
            <a href="javascript:void(0);" class="nxl-head-mobile-toggler" id="mobile-collapse">
                <div class="hamburger hamburger--arrowturn">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
            </a>
            <div class="nxl-navigation-toggle">
                <a href="javascript:void(0);" id="menu-mini-button"><i class="feather-align-left"></i></a>
                <a href="javascript:void(0);" id="menu-expend-button" style="display: none"><i class="feather-arrow-right"></i></a>
            </div>

            <div class="d-none d-md-flex align-items-center gap-2 ms-3">
                <div class="bg-soft-warning text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                    <i id="weather-icon" class="feather-cloud-sun fs-5"></i>
                </div>
                <div style="line-height: 1.2;">
                    <span id="temp-val" class="fw-bolder d-block text-light fs-14">--°C</span>
                    <span id="weather-desc" class="text-muted fw-bold" style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Memuat...</span>
                </div>
            </div>
        </div>

        <div class="header-right ms-auto">
            <div class="d-flex align-items-center">
                
                <div class="nxl-h-item d-none d-sm-flex me-2">
                    <div class="d-flex align-items-center bg-light rounded-pill px-3 py-1 shadow-sm border" style="height: 42px;">
                        <i class="feather-clock text-primary me-2 fs-6"></i>
                        <span id="real-time-clock" class="fw-bolder text-dark fs-14" style="letter-spacing: 0.5px; white-space: nowrap;">
                            00:00:00 AM
                        </span>
                    </div>
                </div>

                <div class="dropdown nxl-h-item nxl-header-search">
                    <a href="javascript:void(0);" class="nxl-head-link me-0" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                        <i class="feather-search"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-search-dropdown">
                        <div class="input-group search-form">
                            <span class="input-group-text"><i class="feather-search fs-6 text-muted"></i></span>
                            <input type="text" class="form-control search-input-field" placeholder="Search...." />
                        </div>
                        <div class="dropdown-divider mt-0"></div>
                    </div>
                </div>

                <div class="nxl-h-item d-none d-sm-flex">
                    <div class="full-screen-switcher">
                        <a href="javascript:void(0);" class="nxl-head-link me-0" onclick="$('body').fullScreenHelper('toggle');">
                            <i class="feather-maximize maximize"></i>
                            <i class="feather-minimize minimize"></i>
                        </a>
                    </div>
                </div>

                <div class="nxl-h-item dark-light-theme">
                    <a href="javascript:void(0);" class="nxl-head-link me-0 dark-button"><i class="feather-moon"></i></a>
                    <a href="javascript:void(0);" class="nxl-head-link me-0 light-button" style="display: none"><i class="feather-sun"></i></a>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    function updateClock() {
        const now = new Date();
        let hours = now.getHours();
        let minutes = String(now.getMinutes()).padStart(2, '0');
        let seconds = String(now.getSeconds()).padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';
        
        hours = hours % 12 || 12;
        hours = String(hours).padStart(2, '0');
        
        const clockElement = document.getElementById('real-time-clock');
        if (clockElement) {
            clockElement.textContent = `${hours}:${minutes}:${seconds} ${ampm}`;
        }
    }
    setInterval(updateClock, 1000);
    updateClock();

    // Cuaca Otomatis
    async function getWeatherData(lat, lon) {
        try {
            const res = await fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true`);
            const data = await res.json();
            
            const tempVal = document.getElementById('temp-val');
            const weatherIcon = document.getElementById('weather-icon');
            const weatherDesc = document.getElementById('weather-desc');

            if (tempVal) tempVal.textContent = Math.round(data.current_weather.temperature) + "°C";
            
            let icon = "feather-sun", desc = "Cerah";
            const code = data.current_weather.weathercode;
            
            if (code >= 1 && code <= 3) { icon = "feather-cloud"; desc = "Berawan"; }
            else if (code >= 45) { icon = "feather-wind"; desc = "Berkabut"; }
            else if (code >= 51) { icon = "feather-cloud-rain"; desc = "Hujan"; }
            
            if (weatherIcon) weatherIcon.className = icon + " fs-5";
            if (weatherDesc) weatherDesc.textContent = desc;
        } catch (e) {
            if (document.getElementById('weather-desc')) {
                document.getElementById('weather-desc').textContent = "Offline";
            }
        }
    }

    function fetchWeather() {
        const defaultLat = -6.2088; 
        const defaultLon = 106.8456;

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (pos) => getWeatherData(pos.coords.latitude, pos.coords.longitude),
                () => {
                    console.warn("Akses lokasi ditolak, menggunakan Jakarta.");
                    getWeatherData(defaultLat, defaultLon);
                }
            );
        } else {
            getWeatherData(defaultLat, defaultLon);
        }
    }
    fetchWeather();
</script>

