<!-- base:js -->
<script src="{{ asset('admin/vendors/base/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{ asset('admin/js/template.js') }}"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<!-- End plugin js for this page -->
<script src="{{ asset('admin/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('admin/vendors/progressbar.js/progressbar.min.js') }}"></script>
<script src="{{ asset('admin/vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js') }}"></script>
<script src="{{ asset('admin/vendors/justgage/raphael-2.1.4.min.js') }}"></script>
<script src="{{ asset('admin/vendors/justgage/justgage.js') }}"></script>
<script src="{{ asset('admin/js/jquery.cookie.js') }}" type="text/javascript"></script>
<!-- Custom js for this page-->
<script src="{{ asset('admin/js/dashboard.js') }}"></script>
<!-- End custom js for this page-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.getElementById("toggleMenu").addEventListener("click", function(event) {
        event.preventDefault();
        let bottomNavbar = document.getElementById("bottomNavbar");
        if (bottomNavbar.style.maxHeight === "0px" || bottomNavbar.style.maxHeight === "") {
            bottomNavbar.style.maxHeight = "300px"; // Adjust the height as needed
        } else {
            bottomNavbar.style.maxHeight = "0px";
        }
    });
</script>
