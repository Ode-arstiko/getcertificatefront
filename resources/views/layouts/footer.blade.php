<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <h5>More Option</h5>
        <a href="" class="btn btn-primary">My Token</a>
    </div>
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/template2/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/template2/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/template2/dist/js/adminlte.min.js"></script>

<script>
    setTimeout(function() {
        let alertElements = document.querySelectorAll('.alert');
        alertElements.forEach(function(alert) {
            // Tambahkan efek fade-out
            alert.style.transition = "opacity 0.5s ease";
            alert.style.opacity = "0";

            // Hapus elemen setelah fade-out
            setTimeout(() => alert.remove(), 500);
        });
    }, 3000); // 3000ms = 3 detik
</script>
</body>

</html>
