
 
 <div class="container">
     <nav class="navbar navbar-expand-sm bg-body-tertiary" data-bs-theme="dark">
         <div class="container">

             <div class="navbar-collapse" id="navbarNav">
                 <ul class="navbar-nav mx-auto">


                     <?php

                        $sql = "SELECT link, titulo FROM menu";
                        $result = $connection->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                                echo "
                                    <li class='nav-item'>
                                        <a class='nav-link active' aria-current='page' href='$row[link]'>$row[titulo]</a>
                                    </li>";
                            }
                        }

                        ?>


                     <!-- <li class="nav-item">
                         <a class="nav-link active" aria-current="page" href="/site_jm_photography">Home</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="about.php">About</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="portfolio.php">Portfolio</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="contact.php">Contact</a> -->
                     </li>
                 </ul>
             </div>
         </div>
     </nav>
 </div>