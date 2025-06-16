import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
function loadAvailableJam() {
    const tanggalValue = document.getElementById('tanggal').value;
    const lapangan = document.getElementById('lapangan').value;
    const jamSelect = document.getElementById('jam');

    if (!tanggalValue || !lapangan) return;

    const tanggal = new Date(tanggalValue);
    const hari = tanggal.getDay(); // 0 = Minggu, 1 = Senin, ..., 6 = Sabtu

    // Atur rentang jam berdasarkan hari
    let startHour, endHour;

    if (hari >= 1 && hari <= 5) {
        startHour = 9;
        endHour = 20;
    } else if (hari === 6) {
        startHour = 8;
        endHour = 17;
    } else {
        // Minggu, tidak bisa booking
        jamSelect.innerHTML = '<option value="">Booking tidak tersedia di hari Minggu</option>';
        return;
    }

    jamSelect.innerHTML = '<option value="">Memuat jam tersedia...</option>';

    fetch(`/get-available-jam?tanggal=${tanggalValue}&lapangan=${lapangan}`)
        .then(response => response.json())
        .then(data => {
            // Filter hasil dari server berdasarkan jam yang diperbolehkan
            const jamDiperbolehkan = data.filter(jam => {
                const jamAngka = parseInt(jam.split(':')[0]);
                return jamAngka >= startHour && jamAngka <= endHour;
            });

            if (jamDiperbolehkan.length === 0) {
                jamSelect.innerHTML = '<option value="">Semua jam penuh atau tidak tersedia</option>';
                return;
            }

            jamSelect.innerHTML = '<option value="">-- Pilih Jam --</option>';
            jamDiperbolehkan.forEach(jam => {
                const option = document.createElement('option');
                option.value = jam;
                option.textContent = jam;
                jamSelect.appendChild(option);
            });
        });
}

document.getElementById('tanggal').addEventListener('change', loadAvailableJam);
document.getElementById('lapangan').addEventListener('change', loadAvailableJam);


window.showSuccessModal = function (message = 'Booking berhasil!', redirectUrl = '/dashboard') {
    // Buat elemen modal
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50';
    modal.innerHTML = `
        <div class="bg-white p-6 rounded-2xl shadow-xl max-w-lg w-1/2 text-center animate-fade-in">
            <h2 class="text-2xl font-semibold text-green-600 mb-2">Berhasil!</h2>
            <p class="text-gray-700">${message}</p>
            <button class="mt-4 px-4 py-2 bg-green-600 text-white rounded-xl hover:bg-green-700">
             OK
            </button>
        </div>
    `;

    document.body.appendChild(modal);
    const closeAndRedirect = () => {
        modal.remove();
        window.location.href = redirectUrl;
    };

    // Tombol OK untuk tutup modal
    modal.querySelector('button').addEventListener('click', closeAndRedirect);

    // Auto close dalam 3 detik
    setTimeout(closeAndRedirect, 3000);
};

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('bookingForm');
    const fileInput = document.getElementById('krs');

    if (form && fileInput) {
        form.addEventListener('submit', function (e) {
            const filePath = fileInput.value;
            const allowedExtensions = /(\.pdf)$/i;

            if (!allowedExtensions.exec(filePath)) {
                alert('Hanya file PDF yang diperbolehkan!');
                fileInput.value = '';
                e.preventDefault(); // Hentikan submit
            }
        });
    }
});
