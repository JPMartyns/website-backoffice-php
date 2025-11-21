<?php
$page_title = "Contact";
include "header.php";
?>

<section class="container">
    <div class="row">
        <div class="col-12 col-md-6">
            <h2>CONTACTOS</h2>

            <p>Morada: <br>
               Ciríaco Cardoso, 186 4150-212 Porto</p>

            <p>Contacto: <br>
               226 195 200*</p>

            <p>Email <br>
               porto@cesae.pt</p>

            <iframe class="rounded"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1338.0878710358872!2d-8.65132687194265!3d41.158412027688854!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd246582de62c467%3A0x319639af8d1669e4!2sR.%20de%20Cir%C3%ADaco%20Cardoso%20186%2C%204150-212%20Porto!5e0!3m2!1spt-PT!2spt!4v1750944560172!5m2!1spt-PT!2spt"
                width="100%" height="400px" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>

        </div>

        <div class="col-12 col-md-6 md-2">
            <h3>Formulário de Contacto</h3>

            <?php
            include "form-handler.php";

            if ($_SERVER["REQUEST_METHOD"] == "POST" and $isFormValid) {
                echo "<div class='alert alert-success' role='alert'>
                            Formulário enviado com sucesso!
                                <ul>
                                    <li>Nome: $nome</li>
                                    <li>Email: $email</li>
                                    <li>Telefone: $telefone</li>
                                    <li>Mensagem: $mensagem</li>
                                </ul>
                        </div>";
            } else {
            ?>
                <form id="contactForm" novalidate action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form-group">
                        <label for="nome">Nome Completo*</label>
                        <input type="text" class="<?= ($nomeError != '') ? 'error-box' : '' ?>" id="nome" name="nome" required value="<?= $nome ?>">
                        <div class="error"><?= $nomeError ?></div>
                        <div class="error-message" id="nameError"></div>
                        <div class="success-message" id="nameSuccess"></div>
                        <div class="field-info">
                            Mínimo 2 caracteres, apenas letras e espaços
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email*</label>
                        <input type="email" class="<?= ($emailError != '') ? 'error-box' : '' ?>" id="email" name="email" value="<?= $email ?>" />
                        <div class="error"><?= $emailError ?></div>
                        <div class="error-message" id="emailError"></div>
                        <div class="success-message" id="emailSuccess"></div>
                        <div class="field-info">exemplo@dominio.com</div>
                    </div>

                    <div class="form-group">
                        <label for="telefone">Telefone*</label>
                        <input type="text" class="<?= ($telefoneError != '') ? 'error-box' : '' ?>" id="telefone" name="telefone" required value="<?= $telefone ?>" />
                        <div class="error"><?= $telefoneError ?></div>
                        <div class="error-message" id="telefoneError"></div>
                        <div class="success-message" id="telefoneSuccess"></div>
                        <div class="field-info">
                            Formato: 9 dígitos (ex: 912345678)
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mensagem">Mensagem*</label>
                        <textarea
                            class="<?= ($mensagemError != '') ? 'error-box' : '' ?>"
                            id="mensagem"
                            name="mensagem"
                            rows="5"
                            required><?= $mensagem ?></textarea>
                        <div class="error"><?= $mensagemError ?></div>
                        <div class="error-message" id="messageError"></div>
                        <div class="success-message" id="messageSuccess"></div>
                        <div class="field-info">
                            Mínimo 10 caracteres, máximo
                            <span id="remaining">500</span>
                        </div>
                    </div>

                    <button class="btn btn-secondary" type="submit" id="submitBtn">Enviar Formulário</button>
                </form>
    
                <!-- <div class="form-summary" id="formSummary">
                <h3>Resumo dos Dados:</h3>
                <div id="summaryContent"></div>
            </div>  -->

            <?php
                if (!$isFormValid) {
                    echo "<div class='alert alert-danger mt-3' role='alert'>
                            O formulário não foi enviado devido a erros. Por favor, corrija os seguintes campos:
                    <ul>";

                    echo ($nomeError != "") ? "<li>$nomeError</li>" : "";
                    echo ($emailError != "") ? "<li>$emailError</li>" : "";
                    echo ($telefoneError != "") ? "<li>$telefoneError</li>" : "";
                    echo ($mensagemError != "") ? "<li>$mensagemError</li>" : "";

                    echo "</ul>
                        </div>";
                }
            } // Fim do if do formulário   
            ?>

        </div>

    </div>

</section>

<?php
include "footer.php";
?>