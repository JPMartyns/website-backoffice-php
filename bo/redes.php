<?php
include "header.php";
?>


<section class="container">
    <div class="row">
        <div class="col">

            <h1>BACK OFFICE - REDES SOCIAIS</h1>

        </div>
    </div>

    <div class="row">
        <div class="col">

            <?php
            $site = $icon = $titulo = $id_footer = "";
            $action = "create";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $site = htmlspecialchars($_POST['site']);
                $icon = htmlspecialchars($_POST['icon']);
                $titulo = htmlspecialchars($_POST['titulo']);
                $idRede = htmlspecialchars($_POST['id-rede']);
                $action = htmlspecialchars($_POST['action']);

                // ZONA DE VALIDAÇÃO DE DADOS... VAMOS SALTAR ESSA PARTE AGORA

                if ($action == "create") {
                    // Inserir na base de dados
                    $sql = "INSERT INTO footer (titulo, icon, site) VALUES ('$titulo', '$icon', '$site')";
                    $sucessText = "Rede social adicionada com sucesso!";
                    $errorText = "Erro ao adicionar rede social: ";
                } elseif ($action == "edit") {
                    // Atualizar na base de dados
                    $sql = "UPDATE footer SET titulo='$titulo', icon='$icon', site='$site' WHERE id_footer='$idRede'";
                    $sucessText = "Rede social atualizada com sucesso!";
                    $errorText = "Erro ao atualizar rede social: ";
                } elseif ($action == "delete") {
                    // Eliminar da base de dados
                    $sql = "DELETE FROM footer WHERE id_footer='$idRede'";
                    $sucessText = "Rede social eliminada com sucesso!";
                    $errorText = "Erro ao eliminar rede social: ";
                } else {
                    echo "<div class='alert alert-danger'>Ação inválida!</div>";
                    exit;
                }

                if ($connection->query($sql) === TRUE) {
                    echo "<div class='alert alert-success'>$sucessText</div>";
                    $titulo = $icon = $site = $idRede = "";
                    $action = "create";
                } else {
                    echo "<div class='alert alert-danger'>$errorText: " . $connection->error . "</div>";
                }
            }
            ?>


            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                <input type="hidden" class="form-control" name="id-rede" id="id-rede" value="<?= $id_footer ?>">
                <input type="hidden" class="form-control" name="action" id="action" value="<?= $action ?>">

                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" value="<?= $titulo ?>" class="form-control" id="titulo" name="titulo" required>
                </div>
                <div class="mb-3">
                    <label for="icon" class="form-label">Ícone (classe Font Awesome)</label>
                    <input type="text" value="<?= $icon ?>" class="form-control" id="icon" name="icon" required>
                </div>
                <div class="mb-3">
                    <label for="site" class="form-label">Site</label>
                    <input type="text" value="<?= $site ?>" class="form-control" id="site" name="site" required>
                </div>
                <button type="submit" id="btn-submit" class="btn btn-secondary">Adicionar Rede Social</button>
            </form>
        </div>


        <div class="col">
            <ul class="list-group">
                <?php
                $sql = "SELECT * FROM footer";
                $result = $connection->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<li class='list-group-item d-flex' data-titulo='$row[titulo]' data-icon='$row[icon]' data-site='$row[site]' data-id='$row[id_footer]'>";
                        echo "<i class='fa-brands fa-xl $row[icon]'>&nbsp; &nbsp;</i> ";
                        echo "$row[titulo]";
                        
                        echo "<div class='ms-auto'>";
                        echo "<button class='btn btn-sm btn-warning my-1' data-action='edit'>Editar</button>";
                        echo "<button class='btn btn-sm btn-danger my-1' data-action='delete'>Excluir</button>";
                        echo "</div>";
                        echo "</li>";
                    }
                } else {
                    echo "<li class='list-group-item'>Nenhuma rede social registada.</li>";
                }
                ?>
            </ul>
        </div>

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[data-action="edit"],[data-action="delete"]').forEach(button => {
        button.addEventListener('click', redesEdit);
    });

    document.querySelector("form").addEventListener("submit", function(event) {
        event.preventDefault(); // Previne o envio do formulário padrão
        if (action.value == "delete") {
            if (!confirm("Tem a certeza que deseja eliminar esta rede social?")) {
                return;
            }
        } else if (action.value == "edit") {
            if (!confirm("Tem a certeza que deseja editar esta rede social?")) {
                return;
            }
        }
        this.submit(); // Envia o formulário se não for uma ação de eliminação
    });

});
</script>

<?php
include "footer.php";
?>