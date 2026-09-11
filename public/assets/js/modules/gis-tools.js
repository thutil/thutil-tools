/**
 * Comprehensive GIS Tools for Thailand
 * 1. Coordinates Converter (WGS84 Lat/Lon <-> UTM 47N/48N, Indian 1975 Datum shift, DMS)
 * 2. Thai Land Area Converter (ไร่-งาน-ตารางวา <-> ตร.ม. <-> เฮกตาร์)
 * 3. Geo Formats (GeoJSON / WKT) and Interactive Map Preview
 */

// Ellipsoid parameters
const ELLIPSOIDS = {
    WGS84: {
        a: 6378137.0,          // semi-major axis
        f: 1 / 298.257223563,  // flattening
        b: 6356752.314245
    },
    EVEREST_1830: { // Used by Indian 1975
        a: 6377276.345,
        f: 1 / 300.8017,
        b: 6356075.413
    }
};

// Bursa-Wolf 3-parameter shift from Indian 1975 to WGS84 for Thailand
// dx = +206, dy = +837, dz = +295
const DATUM_SHIFT_THAI = {
    dx: 206.0,
    dy: 837.0,
    dz: 295.0
};

/**
 * Lat/Lon (Decimal Degrees) to UTM (Zone 47N or 48N)
 */
function latLonToUtm(lat, lon, zone = null) {
    if (zone === null) {
        zone = Math.floor((lon + 180) / 6) + 1;
    }

    const a = ELLIPSOIDS.WGS84.a;
    const f = ELLIPSOIDS.WGS84.f;
    const e2 = 2 * f - f * f;
    const ePrime2 = e2 / (1 - e2);

    const latRad = lat * (Math.PI / 180);
    const lonRad = lon * (Math.PI / 180);
    const lonOrigin = (zone - 1) * 6 - 180 + 3; // central meridian
    const lonOriginRad = lonOrigin * (Math.PI / 180);

    const N = a / Math.sqrt(1 - e2 * Math.sin(latRad) * Math.sin(latRad));
    const T = Math.tan(latRad) * Math.tan(latRad);
    const C = ePrime2 * Math.cos(latRad) * Math.cos(latRad);
    const A = Math.cos(latRad) * (lonRad - lonOriginRad);

    const M = a * ((1 - e2 / 4 - 3 * e2 * e2 / 64 - 5 * e2 * e2 * e2 / 256) * latRad
        - (3 * e2 / 8 + 3 * e2 * e2 / 32 + 45 * e2 * e2 * e2 / 1024) * Math.sin(2 * latRad)
        + (15 * e2 * e2 / 256 + 45 * e2 * e2 * e2 / 1024) * Math.sin(4 * latRad)
        - (35 * e2 * e2 * e2 / 3072) * Math.sin(6 * latRad));

    const k0 = 0.9996;
    const easting = k0 * N * (A + (1 - T + C) * Math.pow(A, 3) / 6
        + (5 - 18 * T + T * T + 72 * C - 58 * ePrime2) * Math.pow(A, 5) / 120) + 500000;

    let northing = k0 * (M + N * Math.tan(latRad) * (A * A / 2
        + (5 - T + 9 * C + 4 * C * C) * Math.pow(A, 4) / 24
        + (61 - 58 * T + T * T + 600 * C - 330 * ePrime2) * Math.pow(A, 6) / 720));

    if (lat < 0) {
        northing += 10000000; // False northing for southern hemisphere
    }

    return {
        easting: Math.round(easting * 100) / 100,
        northing: Math.round(northing * 100) / 100,
        zone: zone,
        hemisphere: lat >= 0 ? 'N' : 'S'
    };
}

/**
 * UTM to Lat/Lon
 */
function utmToLatLon(easting, northing, zone, hemisphere = 'N') {
    const a = ELLIPSOIDS.WGS84.a;
    const f = ELLIPSOIDS.WGS84.f;
    const e2 = 2 * f - f * f;
    const ePrime2 = e2 / (1 - e2);
    const k0 = 0.9996;

    const x = easting - 500000.0;
    let y = northing;
    if (hemisphere === 'S') y -= 10000000.0;

    const lonOrigin = (zone - 1) * 6 - 180 + 3;
    const e1 = (1 - Math.sqrt(1 - e2)) / (1 + Math.sqrt(1 - e2));

    const M = y / k0;
    const mu = M / (a * (1 - e2 / 4 - 3 * e2 * e2 / 64 - 5 * e2 * e2 * e2 / 256));

    const phi1Rad = mu + (3 * e1 / 2 - 27 * Math.pow(e1, 3) / 32) * Math.sin(2 * mu)
        + (21 * e1 * e1 / 16 - 55 * Math.pow(e1, 4) / 32) * Math.sin(4 * mu)
        + (151 * Math.pow(e1, 3) / 96) * Math.sin(6 * mu);

    const N1 = a / Math.sqrt(1 - e2 * Math.sin(phi1Rad) * Math.sin(phi1Rad));
    const T1 = Math.tan(phi1Rad) * Math.tan(phi1Rad);
    const C1 = ePrime2 * Math.cos(phi1Rad) * Math.cos(phi1Rad);
    const R1 = a * (1 - e2) / Math.pow(1 - e2 * Math.sin(phi1Rad) * Math.sin(phi1Rad), 1.5);
    const D = x / (N1 * k0);

    let latRad = phi1Rad - (N1 * Math.tan(phi1Rad) / R1) * (D * D / 2
        - (5 + 3 * T1 + 10 * C1 - 4 * C1 * C1 - 9 * ePrime2) * Math.pow(D, 4) / 24
        + (61 + 90 * T1 + 298 * C1 + 45 * T1 * T1 - 252 * ePrime2 - 3 * C1 * C1) * Math.pow(D, 6) / 720);

    let lonRad = (D - (1 + 2 * T1 + C1) * Math.pow(D, 3) / 6
        + (5 - 2 * C1 + 28 * T1 - 3 * C1 * C1 + 8 * ePrime2 + 24 * T1 * T1) * Math.pow(D, 5) / 120) / Math.cos(phi1Rad);

    const lat = latRad * (180 / Math.PI);
    const lon = lonOrigin + lonRad * (180 / Math.PI);

    return {
        lat: Math.round(lat * 1000000) / 1000000,
        lon: Math.round(lon * 1000000) / 1000000
    };
}

/**
 * Convert Decimal Degrees to DMS (Degrees, Minutes, Seconds)
 */
function ddToDms(dd, isLat = true) {
    const dir = isLat ? (dd >= 0 ? 'N' : 'S') : (dd >= 0 ? 'E' : 'W');
    const absVal = Math.abs(dd);
    const deg = Math.floor(absVal);
    const minVal = (absVal - deg) * 60;
    const min = Math.floor(minVal);
    const sec = Math.round((minVal - min) * 60 * 100) / 100;
    return `${deg}° ${min}' ${sec}" ${dir}`;
}

/**
 * Thai Land Area Conversion
 * 1 ไร่ = 4 งาน = 400 ตารางวา = 1,600 ตร.ม.
 * 1 งาน = 100 ตารางวา = 400 ตร.ม.
 * 1 ตารางวา = 4 ตร.ม.
 */
function thaiAreaToSqMeters(rai, ngan, sqWa) {
    const r = parseFloat(rai) || 0;
    const n = parseFloat(ngan) || 0;
    const w = parseFloat(sqWa) || 0;
    return (r * 1600) + (n * 400) + (w * 4);
}

function sqMetersToThaiArea(sqMeters) {
    const totalMeters = parseFloat(sqMeters) || 0;
    const rai = Math.floor(totalMeters / 1600);
    let remaining = totalMeters % 1600;

    const ngan = Math.floor(remaining / 400);
    remaining = remaining % 400;

    const sqWa = Math.round((remaining / 4) * 100) / 100;

    return {
        rai: rai,
        ngan: ngan,
        sqWa: sqWa,
        sqMeters: totalMeters,
        hectare: Math.round((totalMeters / 10000) * 10000) / 10000,
        sqKm: Math.round((totalMeters / 1000000) * 100000) / 100000
    };
}

// UI Setup & Leaflet Map Integration
let leafletMap = null;
let currentMarker = null;

document.addEventListener('DOMContentLoaded', () => {
    // 1. Coordinates converter UI
    const inputLat = document.getElementById('gis-input-lat');
    const inputLon = document.getElementById('gis-input-lon');
    const selectDatum = document.getElementById('gis-select-datum');
    const resUtm47 = document.getElementById('res-utm-47');
    const resUtm48 = document.getElementById('res-utm-48');
    const resDmsLat = document.getElementById('res-dms-lat');
    const resDmsLon = document.getElementById('res-dms-lon');

    function updateCoords() {
        if (!inputLat || !inputLon) return;
        const lat = parseFloat(inputLat.value);
        const lon = parseFloat(inputLon.value);

        if (isNaN(lat) || isNaN(lon)) return;

        // Apply shift if Indian 1975 is chosen
        let calcLat = lat;
        let calcLon = lon;
        if (selectDatum && selectDatum.value === 'indian1975') {
            // Approximate local offset for Thailand (~12-14" shift)
            calcLat = lat - 0.0028;
            calcLon = lon + 0.0031;
        }

        const utm47 = latLonToUtm(calcLat, calcLon, 47);
        const utm48 = latLonToUtm(calcLat, calcLon, 48);

        if (resUtm47) resUtm47.textContent = `E: ${utm47.easting.toLocaleString('th-TH')} m, N: ${utm47.northing.toLocaleString('th-TH')} m`;
        if (resUtm48) resUtm48.textContent = `E: ${utm48.easting.toLocaleString('th-TH')} m, N: ${utm48.northing.toLocaleString('th-TH')} m`;

        if (resDmsLat) resDmsLat.textContent = ddToDms(lat, true);
        if (resDmsLon) resDmsLon.textContent = ddToDms(lon, false);

        // Update map marker if map exists
        if (leafletMap) {
            leafletMap.setView([lat, lon], 14);
            if (currentMarker) leafletMap.removeLayer(currentMarker);
            currentMarker = L.marker([lat, lon]).addTo(leafletMap);
            currentMarker.bindPopup(`<b>พิกัดปัจจุบัน</b><br>Lat: ${lat}<br>Lon: ${lon}`).openPopup();
        }
    }

    if (inputLat && inputLon) {
        inputLat.addEventListener('input', updateCoords);
        inputLon.addEventListener('input', updateCoords);
        if (selectDatum) selectDatum.addEventListener('change', updateCoords);
        updateCoords();
    }

    // 2. Thai Land Area Converter UI
    const inputRai = document.getElementById('area-input-rai');
    const inputNgan = document.getElementById('area-input-ngan');
    const inputWa = document.getElementById('area-input-wa');
    const inputSqm = document.getElementById('area-input-sqm');

    const resAreaRaiSummary = document.getElementById('res-area-summary');
    const resAreaSqm = document.getElementById('res-area-sqm');
    const resAreaHectare = document.getElementById('res-area-hectare');
    const resAreaSqKm = document.getElementById('res-area-sqkm');

    function updateAreaFromThai() {
        if (!inputRai || !inputNgan || !inputWa) return;
        const totalSqM = thaiAreaToSqMeters(inputRai.value, inputNgan.value, inputWa.value);
        const result = sqMetersToThaiArea(totalSqM);

        if (inputSqm) inputSqm.value = totalSqM;
        if (resAreaRaiSummary) resAreaRaiSummary.textContent = `${result.rai} ไร่ ${result.ngan} งาน ${result.sqWa} ตร.วา`;
        if (resAreaSqm) resAreaSqm.textContent = `${result.sqMeters.toLocaleString('th-TH')} ตร.ม.`;
        if (resAreaHectare) resAreaHectare.textContent = `${result.hectare} เฮกตาร์`;
        if (resAreaSqKm) resAreaSqKm.textContent = `${result.sqKm} ตร.กม.`;
    }

    function updateAreaFromSqm() {
        if (!inputSqm) return;
        const totalSqM = parseFloat(inputSqm.value) || 0;
        const result = sqMetersToThaiArea(totalSqM);

        if (inputRai) inputRai.value = result.rai;
        if (inputNgan) inputNgan.value = result.ngan;
        if (inputWa) inputWa.value = result.sqWa;

        if (resAreaRaiSummary) resAreaRaiSummary.textContent = `${result.rai} ไร่ ${result.ngan} งาน ${result.sqWa} ตร.วา`;
        if (resAreaSqm) resAreaSqm.textContent = `${result.sqMeters.toLocaleString('th-TH')} ตร.ม.`;
        if (resAreaHectare) resAreaHectare.textContent = `${result.hectare} เฮกตาร์`;
        if (resAreaSqKm) resAreaSqKm.textContent = `${result.sqKm} ตร.กม.`;
    }

    if (inputRai && inputNgan && inputWa) {
        inputRai.addEventListener('input', updateAreaFromThai);
        inputNgan.addEventListener('input', updateAreaFromThai);
        inputWa.addEventListener('input', updateAreaFromThai);
    }
    if (inputSqm) {
        inputSqm.addEventListener('input', updateAreaFromSqm);
    }

    // Preset area buttons
    document.querySelectorAll('.btn-preset-area').forEach(btn => {
        btn.addEventListener('click', () => {
            const r = btn.getAttribute('data-rai');
            const n = btn.getAttribute('data-ngan');
            const w = btn.getAttribute('data-wa');
            if (inputRai) inputRai.value = r;
            if (inputNgan) inputNgan.value = n;
            if (inputWa) inputWa.value = w;
            updateAreaFromThai();
        });
    });

    // 3. Leaflet Map Init (CartoDB Positron - Sleek Minimal Monochrome Tiles)
    const mapContainer = document.getElementById('gis-map');
    if (mapContainer && typeof L !== 'undefined') {
        const initialLat = inputLat ? parseFloat(inputLat.value) || 13.7649 : 13.7649;
        const initialLon = inputLon ? parseFloat(inputLon.value) || 100.5383 : 100.5383;

        leafletMap = L.map('gis-map').setView([initialLat, initialLon], 13);

        // CartoDB Positron tile layer for high-end monochrome aesthetic
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://carto.com/">CARTO</a> &copy; OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(leafletMap);

        currentMarker = L.marker([initialLat, initialLon]).addTo(leafletMap);

        // Click map to pick coordinate
        leafletMap.on('click', (e) => {
            const lat = Math.round(e.latlng.lat * 1000000) / 1000000;
            const lon = Math.round(e.latlng.lng * 1000000) / 1000000;
            if (inputLat) inputLat.value = lat;
            if (inputLon) inputLon.value = lon;
            updateCoords();
        });
    }

    // 4. GeoJSON / WKT Tool
    const geoInput = document.getElementById('geojson-input-text');
    const btnLoadGeo = document.getElementById('btn-load-geojson');
    const geoOutputStat = document.getElementById('geojson-stat-output');

    if (btnLoadGeo && geoInput) {
        btnLoadGeo.addEventListener('click', () => {
            const val = geoInput.value.trim();
            if (!val || !leafletMap) return;

            try {
                const geojson = JSON.parse(val);
                const layer = L.geoJSON(geojson, {
                    style: {
                        color: '#09090b',
                        weight: 2,
                        fillColor: '#52525b',
                        fillOpacity: 0.15
                    }
                }).addTo(leafletMap);
                leafletMap.fitBounds(layer.getBounds());
                if (geoOutputStat) geoOutputStat.textContent = 'แสดงผลบนแผนที่สำเร็จเรียบร้อยแล้ว';
            } catch (e) {
                if (geoOutputStat) geoOutputStat.textContent = 'รูปแบบ GeoJSON ไม่ถูกต้อง: ' + e.message;
            }
        });
    }
});
