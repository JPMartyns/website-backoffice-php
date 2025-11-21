<?php
include "header.php";
?>


<section class="container">
    <div class="row">
        <div class="col">

            <h1>BACK OFFICE - ITEM DE MENU</h1>

        </div>
    </div>

    <div class="row">
        <div class="col">

            <?php
            $link = $titulo = $id_menu = "";
            $action = "create";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $link = htmlspecialchars($_POST['link']);
                $titulo = htmlspecialchars($_POST['titulo']);
                $idMenu = htmlspecialchars($_POST['id-menu']);
                $action = htmlspecialchars($_POST['action']);

                // ZONA DE VALIDAÇÃO DE DADOS... VAMOS SALTAR ESSA PARTE AGORA

                // Inserir na base de dados
                if ($action == "create") {
                    // Inserir na base de dados
                    $sql = "INSERT INTO menu (link, titulo) VALUES ('$link', '$titulo')";
                    $sucessText = "Item de menu adicionado com sucesso!";
                    $errorText = "Erro ao adicionar item de menu: ";
                } elseif ($action == "edit") {
                    // Atualizar na base de dados
                    $sql = "UPDATE menu SET titulo='$titulo', link='$link' WHERE id_menu='$idMenu'";
                    $sucessText = "Item de menu atualizado com sucesso!";
                    $errorText = "Erro ao atualizar item de menu: ";
                } elseif ($action == "delete") {
                    // Eliminar da base de dados
                    $sql = "DELETE FROM menu WHERE id_menu='$idMenu'";
                    $sucessText = "Item de menu eliminado com sucesso!";
                    $errorText = "Erro ao eliminar item de menu: ";
                } else {
                    echo "<div class='alert alert-danger'>Ação inválida!</div>";
                    exit;
                }

                if ($connection->query($sql) === TRUE) {
                    echo "<div class='alert alert-success'>$sucessText</div>";
                    $titulo = $link = $idMenu = "";
                    $action = "create";
                } else {
                    echo "<div class='alert alert-danger'>$errorText: " . $connection->error . "</div>";
                }
            }
            ?>


            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                <input type="hidden" class="form-control" name="id-menu" id="id-menu" value="<?= $id_menu ?>">
                <input type="hidden" class="form-control" name="action" id="action" value="<?= $action ?>">

                <div class="mb-3">
                    <label for="link" class="form-label">Link</label>
                    <input type="text" value="<?= $link ?>" class="form-control" id="link" name="link" required>
                </div>
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" value="<?= $titulo ?>" class="form-control" id="titulo" name="titulo" required>
                </div>
                <button type="submit" id="btn-submit" class="btn btn-secondary">Adicionar Item Menu</button>
            </form>
        </div>

        <div class="col">
            <ul class="list-group">
                <?php
                $sql = "SELECT * FROM menu";
                $result = $connection->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<li class='list-group-item d-flex' data-titulo='$row[titulo]' data-link='$row[link]' data-id='$row[id_menu]'>";

                        echo "$row[titulo]";
                        
                        echo "<div class='ms-auto'>";
                        echo "<button class='btn btn-sm btn-warning my-1' data-action='edit'>Editar</button>";
                        echo "<button class='btn btn-sm btn-danger my-1' data-action='delete'>Excluir</button>";
                        echo "</div>";
                        echo "</li>";
                    }
                } else {
                    echo "<li class='list-group-item'>Nenhum item de menu registado.</li>";
                }
                ?>
            </ul>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[data-action="edit"],[data-action="delete"]').forEach(button => {
        button.addEventListener('click', menuEdit);
    });

    document.querySelector("form").addEventListener("submit", function(event) {
        event.preventDefault(); // Previne o envio do formulário padrão
        if (action.value == "delete") {
            if (!confirm("Tem a certeza que deseja eliminar este item de menu?")) {
                return;
            }
        } else if (action.value == "edit") {
            if (!confirm("Tem a certeza que deseja editar este item de menu?")) {
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