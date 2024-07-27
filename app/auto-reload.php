<script>
    function autoReload() {
        // Menggunakan Fetch API untuk melakukan polling ke server
        fetch('/last-modified.php')
            .then(response => response.json())
            .then(data => {
                // Membandingkan waktu terakhir modifikasi dengan waktu sekarang
                if (data.lastModified > sessionStorage.getItem('lastModified')) {
                    sessionStorage.setItem('lastModified', data.lastModified);
                    location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Memanggil autoReload setiap 2 detik
    setInterval(autoReload, 2000);
</script>