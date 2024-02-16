    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script defer src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script defer src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- SweetAlert --->
    <script defer src="../vendor/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script async src="../js/sb-admin-2.min.js"></script>

    <!-- HARRS Script -->
    <script defer src="../js/src/sign-out.js"></script>
    <?php if ($_SERVER['REQUEST_URI'] == "/harrs/admin/dashboard.php") {?>
    <!-- Page level plugins -->
    <script defer src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script defer src="../js/demo/chart-area-demo.js"></script>
    <script defer src="../js/demo/chart-pie-demo.js"></script>
    <?php } else if ($_SERVER['REQUEST_URI'] == "/harrs/admin/accounts.php") {?>
    <script defer src="../js/admin/accounts.js"></script>
    <?php } else if ($_SERVER['REQUEST_URI'] == "/harrs/admin/rooms.php") {?>
    <script defer src="../js/admin/rooms.js"></script>
    <?php } else if ($_SERVER['REQUEST_URI'] == "/harrs/admin/tenants.php") {?>
    <script defer src="../js/admin/tenants.js"></script>
    <?php } else if ($_SERVER['REQUEST_URI'] == "/harrs/admin/tables.php") {?>
    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script async src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script async src="../js/demo/datatables-demo.js"></script>
    <?php } ?>

    <noscript>
        <br>
        <span>We are facing <strong>Script</strong> issues. Kindly enable <strong>JavaScript</strong>!!!</span>
        <br>
        <span>Call IT Personnel Immediately!!! They will fix it right away.</span>
    </noscript>

</body>
</html>