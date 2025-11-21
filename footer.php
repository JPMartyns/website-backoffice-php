<footer class="container">
    <div>
        <div class="row">
            <div class="col-3 d-flex align-items-center">
                <span class="d-none d-md-inline">COPYRIGHT </span><span>&copy; 2025</span>
            </div>
            <div class="col d-flex">
                <ul class="list-group list-group-horizontal ms-auto">

                    <?php

                    $sql = "SELECT site, icon, titulo FROM footer";
                    $result = $connection->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                            echo "
                            <li class='list-group-item'>
                            <a href='https://$row[site]' target='_blank'>
                                <i class='fa-brands $row[icon]'></i> 
                                <span class='d-none d-lg-inline'>
                                    $row[titulo]</span></a> 
                            </li>";
                        }
                    }

                    ?>


                    <!-- <li class=" list-group-item">
                        <a href="https://fb.com" target="_blank">
                            <i class="fa-brands fa-square-facebook"></i> <span class="d-none d-lg-inline">
                                Facebook</span></a>
                    </li>

                    <li class="list-group-item">
                        <a href="https://instagram.com" target="_blank">
                            <i class="fa-brands fa-square-instagram"></i><span class="d-none d-lg-inline">
                                Instagram</span></a>
                    </li>
                    <li class=" list-group-item">
                        <a href="https://linkedin.com" target="_blank">
                            <i class="fa-brands fa-linkedin"></i><span class="d-none d-lg-inline">
                                Linkedin</span></a>
                    </li>
                    <li class=" list-group-item">
                        <a href="https://whatsapp.com" target="_blank">
                            <i class="fa-brands fa-square-whatsapp"></i><span class="d-none d-lg-inline">
                                What'sApp</span></a>
                    </li> -->

                </ul>
            </div>
        </div>
    </div>
</footer>

<script>
    Fancybox.bind("[data-fancybox]", {
        // Your custom options
    });
</script>

</body>

</html>