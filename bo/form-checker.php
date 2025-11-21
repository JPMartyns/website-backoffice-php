<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$sql = "SELECT * FROM contactos ORDER BY data_envio DESC";
$result = mysqli_query($connection, $sql);

?>

<?php
include "header.php";
?>

<section class="container">
    <h2 class="mb-4">Mensagens Recebidas</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Mensagem</th>
                <th>Data</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($m = $result->fetch_assoc()): ?>
                <tr class="<?= $m['lida'] ? 'table-success' : 'table-light' ?>">
                    <td><?= htmlspecialchars($m['nome']) ?></td>
                    <td><?= htmlspecialchars($m['email']) ?></td>
                    <td><?= htmlspecialchars($m['telefone']) ?></td>
                    <td><?= nl2br(htmlspecialchars($m['mensagem'])) ?></td>
                    <td><?= $m['data_envio'] ?></td>
                    <td>
                        <span class="badge bg-<?= $m['lida'] ? 'success' : 'warning text-dark' ?>">
                            <?= $m['lida'] ? 'Lida' : 'Não lida' ?>
                        </span>
                    </td>
                    <td>
                        <?php
                        $id = $m['id_contacto'];
                        $estado = $m['lida'] ? 0 : 1;
                        $texto = $m['lida'] ? 'Marcar como não lida' : 'Marcar como lida';
                        $link = "marcar_lida.php?id=$id&estado=$estado";
                        ?>
                        <a href="<?= $link ?>" class="btn btn-sm btn-secondary"><?= $texto ?></a>
                    </td>

                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</section>
<?php
include "footer.php";
?>