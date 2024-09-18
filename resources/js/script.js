document.addEventListener('DOMContentLoaded', function() {
    // Menghilangkan alert setelah 3 detik
    setTimeout(function() {
        var alert = document.getElementById('success-alert');
        if (alert) {
            alert.style.transition = "opacity 0.5s ease";
            alert.style.opacity = "0";
            setTimeout(function() {
                alert.style.display = 'none'; // Hapus elemen dari tampilan setelah transisi
            }, 500); // Waktu tambahan untuk transisi efek fade out
        }
    }, 3000); // Waktu sebelum alert mulai menghilang (3 detik)
});