 </div>

    <!-- Footer -->
    <footer>
        <small>&copy; <?= date("Y") ?> Inventaris Barang</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggleBtn = document.getElementById("toggleSidebar");
        const sidebar = document.getElementById("sidebar");

        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("collapsed");
        });
    </script>
</body>

</html>