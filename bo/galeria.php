<?php
include "header.php";
?>

<section class="container">
    <div class="row">
        <div class="col">
            <h1>BACK OFFICE - GALERIA</h1>
        </div>
    </div>

    <div class="row">
        <div class="col">

            <?php
            $titulo = $ficheiro =  $id_galeria = "";
            $action = "create";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $ficheiro = $_FILES['ficheiro']['name'];
                $titulo = htmlspecialchars($_POST['titulo']);
                $idFoto = htmlspecialchars($_POST['id-foto']);
                $action = htmlspecialchars($_POST['action']);

                // ZONA DE VALIDAÇÃO DE DADOS... VAMOS SALTAR ESSA PARTE AGORA
                $target_dir = BASE_IMAGES_GALERIA_URL;
                $target_file = $target_dir . basename($ficheiro);
                $uploadOk = true;


                if ($ficheiro != "") {
                    // Verificar se o ficheiro é uma imagem
                    $check = getimagesize($_FILES['ficheiro']['tmp_name']);
                    if ($check === false) {
                        echo "<div class='alert alert-danger'>O ficheiro não é uma imagem.</div>";
                        $uploadOk = false;
                    }

                    // Verificar se o ficheiro já existe
                    if (file_exists($target_file)) {
                        echo "<div class='alert alert-danger'>O ficheiro já existe.</div>";
                        $uploadOk = false;
                    }

                    // Verificar o tamanho do ficheiro
                    if ($_FILES['ficheiro']['size'] > 3000000) {
                        echo "<div class='alert alert-danger'>O ficheiro é demasiado grande.</div>";
                        $uploadOk = false;
                    }

                    // Permitir apenas certos formatos de imagem
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif', 'webp'])) {
                        echo "<div class='alert alert-danger'>Apenas ficheiros JPG, JPEG, PNG, GIF & WEBP são permitidos.</div>";
                        $uploadOk = false;
                    }

                    if ($uploadOk) {
                        // Tentar mover o ficheiro para o diretório de destino
                        if (!move_uploaded_file($_FILES['ficheiro']['tmp_name'], $target_file)) {
                            echo "<div class='alert alert-danger'>Erro ao carregar o ficheiro.</div>";
                            $uploadOk = false;
                        }
                    }
                }

                if ($uploadOk and $action == "create") {

                    // Inserir na base de dados
                    $sql = "INSERT INTO galeria (titulo, ficheiro) VALUES ('$titulo', '$ficheiro')";
                    $sucessText = "Imagem adicionada com sucesso!";
                    $errorText = "Erro ao adicionar imagem: ";
                } elseif ($action == "edit") {
                    // Atualizar na base de dados
                    $sql = "UPDATE galeria SET titulo='$titulo' ";
                    $sql .= ($ficheiro != "") ? ", ficheiro='$ficheiro' " : "";
                    $sql .= " WHERE id_galeria='$idFoto'";
                    $sucessText = "Foto atualizada com sucesso!";
                    $errorText = "Erro ao atualizar foto: ";
                } elseif ($action == "delete") {
                    // Eliminar da base de dados
                    $sql = "DELETE FROM galeria WHERE id_galeria='$idFoto'";
                    // Eliminar o ficheiro do servidor
                    $sqlFoto = "SELECT ficheiro FROM galeria WHERE id_galeria='$idFoto'";
                    $resultFoto = $connection->query($sqlFoto);
                    if ($resultFoto->num_rows > 0) {
                        $rowFoto = $resultFoto->fetch_assoc();
                        $ficheiro = $rowFoto['ficheiro'];
                    } else {
                        echo "<div class='alert alert-danger'>Erro ao obter o ficheiro da imagem.</div>";
                        exit;
                    }
                    $fotoPath = BASE_IMAGES_GALERIA_URL . $ficheiro;
                    if (file_exists($fotoPath)) {
                        unlink($fotoPath);
                    }
                    $sucessText = "Imagem eliminada com sucesso!";
                    $errorText = "Erro ao eliminar imagem: ";
                }

                if ($connection->query($sql) === TRUE) {
                    echo "<div class='alert alert-success'>$sucessText</div>";
                    $titulo = $ficheiro = $idFoto = "";
                    $action = "create";
                } else {
                    echo "<div class='alert alert-danger'>$errorText: " . $connection->error . "</div>";
                }
            }
            ?>


            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

                <input type="hidden" class="form-control" name="id-foto" id="id-foto" value="<?= $id_galeria ?>">
                <input type="hidden" class="form-control" name="action" id="action" value="<?= $action ?>">

                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" value="<?= $titulo ?>" class="form-control" id="titulo" name="titulo" required>
                </div>
                <div class="mb-3">
                    <label for="ficheiro" class="form-label">Ficheiro</label>
                    <input type="file" value="<?= $ficheiro ?>" class="form-control" id="ficheiro" name="ficheiro" required>
                </div>
                <button type="submit" id="btn-submit" class="btn btn-secondary">Adicionar Foto</button>
            </form>
        </div>


        <div class="col">
            <ul class="list-group">
                <?php
                $sql = "SELECT * FROM galeria ORDER BY id_galeria DESC";
                $result = $connection->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<li class='list-group-item d-flex' data-titulo='$row[titulo]' data-ficheiro='$row[ficheiro]' data-id='$row[id_galeria]'>";
                        echo "<img src='" . BASE_IMAGES_URL . "galeria/" . $row['ficheiro'] . "'  class='img-thumbnail me-2' style='width: 50px; height: 50px;'>";
                        echo "$row[titulo]";
                        echo "<div class='ms-auto'>";
                        echo "<button class='btn btn-sm btn-warning my-1' data-action='edit'>Editar</button>";
                        echo "<button class='btn btn-sm btn-danger my-1' data-action='delete'>Eliminar</button>";
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
        button.addEventListener('click', fotosEdit);
    });

    document.querySelector("form").addEventListener("submit", function(event) {
        event.preventDefault(); // Previne o envio do formulário padrão
        if (action.value == "delete") {
            if (!confirm("Tem a certeza que deseja eliminar esta imagem?")) {
                return;
            }
        } else if (action.value == "edit") {
            if (!confirm("Tem a certeza que deseja editar esta imagem?")) {
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