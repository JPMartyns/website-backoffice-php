<?php
$page_title = "Portfolio";
include "header.php";
?>

<section class="container" id="galeria">
    <div class="row">
        <div class="col">
            <h2>PORTFOLIO</h2>
        </div>
    </div>

    <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">


        <?php

        $sql = "SELECT titulo, ficheiro FROM galeria";
        $result = $connection->query($sql);
 
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
 
                echo "
                    <div class='col'>
                        <div>
                            <a href='images/galeria/$row[ficheiro]' data-fancybox='andebol' target='_blank'>
                                <img src='images/galeria/$row[ficheiro]' alt='' class='img-fluid' />
                                <h5>$row[titulo]</h5>
                            </a>
                        </div>
                    </div>";
            }
        }

        ?>


        <!-- <div class="col">
            <div>
                <a href="images/galeria/1.jpg" data-fancybox="galery" data-caption="Single image" target="_blank">
                    <img src="images/galeria/1.jpg" alt="" class="img-fluid" />
                    <h5>Título Imagem</h5>
                </a>
            </div>
        </div>

        <div class="col">
            <div>
                <a href="images/galeria/2.jpg" data-fancybox="galery" data-caption="Single image" target="_blank">
                    <img src="images/galeria/2.jpg" alt="" class="img-fluid" />
                    <h5>Título Imagem</h5>
                </a>
            </div>
        </div>

        <div class="col">
            <div>
                <a href="images/galeria/3.jpg" data-fancybox="galery" data-caption="Single image" target="_blank">
                    <img src="images/galeria/3.jpg" alt="" class="img-fluid" />
                    <h5>Título Imagem</h5>
                </a>
            </div>
        </div>

        <div class="col">
            <div>
                <a href="images/galeria/4.jpg" data-fancybox="galery" data-caption="Single image" target="_blank">
                    <img src="images/galeria/4.jpg" alt="" class="img-fluid" />
                    <h5>Título Imagem</h5>
                </a>
            </div>
        </div>

        <div class="col">
            <div>
                <a href="images/galeria/5.jpg" data-fancybox="galery" data-caption="Single image" target="_blank">
                    <img src="images/galeria/5.jpg" alt="" class="img-fluid" />
                    <h5>Título Imagem</h5>
                </a>
            </div>
        </div>

        <div class="col">
            <div>
                <a href="images/galeria/6.jpg" data-fancybox="galery" data-caption="Single image" target="_blank">
                    <img src="images/galeria/6.jpg" alt="" class="img-fluid" />
                    <h5>Título Imagem</h5>
                </a>
            </div>
        </div>

        <div class="col">
            <div>
                <a href="images/galeria/7.jpg" data-fancybox="galery" data-caption="Single image" target="_blank">
                    <img src="images/galeria/7.jpg" alt="" class="img-fluid" />
                    <h5>Título Imagem</h5>
                </a>
            </div>
        </div>

        <div class="col">
            <div>
                <a href="images/galeria/8.jpg" data-fancybox="galery" data-caption="Single image" target="_blank">
                    <img src="images/galeria/8.jpg" alt="" class="img-fluid" />
                    <h5>Título Imagem</h5>
                </a>
            </div>
        </div>

        <div class="col">
            <div>
                <a href="images/galeria/9.jpg" data-fancybox="galery" data-caption="Single image" target="_blank">
                    <img src="images/galeria/9.jpg" alt="" class="img-fluid" />
                    <h5>Título Imagem</h5>
                </a>
            </div>
        </div>

        <div class="col">
            <div>
                <a href="images/galeria/10.jpg" data-fancybox="galery" data-caption="Single image" target="_blank">
                    <img src="images/galeria/10.jpg" alt="" class="img-fluid" />
                    <h5>Título Imagem</h5>
                </a>
            </div>
        </div>

        <div class="col">
            <div>
                <a href="images/galeria/11.jpg" data-fancybox="galery" data-caption="Single image" target="_blank">
                    <img src="images/galeria/11.jpg" alt="" class="img-fluid" />
                    <h5>Título Imagem</h5>
                </a>
            </div>
        </div>

        <div class="col">
            <div>
                <a href="images/galeria/12.jpg" data-fancybox="galery" data-caption="Single image" target="_blank">
                    <img src="images/galeria/12.jpg" alt="" class="img-fluid" />
                    <h5>Título Imagem</h5>
                </a>
            </div>
        </div> -->

    </div>
</section>

<?php
include "footer.php";
?>