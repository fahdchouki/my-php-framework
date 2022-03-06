
</div>
</div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../../dashboard/js/jquery-3.3.1.slim.min.js"></script>
<script src="../../dashboard/js/popper.min.js"></script>
<script src="../../dashboard/js/bootstrap.min.js"></script>
<script src="../../dashboard/js/jquery-3.3.1.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#sidebarCollapse").on("click", function() {
            $("#sidebar").toggleClass("active");
            $("#content").toggleClass("active");
        });

        $(".more-button,.body-overlay").on("click", function() {
            $("#sidebar,.body-overlay").toggleClass("show-nav");
        });
    });
</script>
</body>

</html>