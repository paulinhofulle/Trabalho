<?php
if (isset($_GET['id']))
    $id = $_GET['id'];

try {
    $quantidade = 5;
    $pagina = isset($_GET['paginacao']) ? $_GET['paginacao'] : 1;

    if (isset($id)) {
        $stmt = $conn->prepare('SELECT * FROM estados WHERE id = :id');
    } else {
        $stmt = $conn->prepare('SELECT * FROM estados');
    }
    $stmt->execute();

    $result = $stmt->fetchAll();

    $total = count($result);
    $numero_pagina = ceil($total / $quantidade);
    $inicio = ($quantidade * $pagina) - $quantidade;
    $stmt = $conn->prepare("SELECT * FROM estados limit $inicio, $quantidade");
    $stmt->execute();

    $result = $stmt->fetchAll();
?>
    <table border="1" class="table table-striped">
        <tr>
            <td>Id</td>
            <td>Nome</td>
            <td>Ação</td>
        </tr>
        <?php
        if (count($result)) {
            foreach ($result as $row) {
        ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nome'] ?></td>
                    <td>
                        <a href="?modulo=estados&pagina=alterar&id=<?= $row['id'] ?>">Alterar</a> |
                        <a href="?modulo=estados&pagina=deletar&id=<?= $row['id'] ?>">Excluir</a>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "Nenhum resultado retornado.";
        }
        ?>
    </table>
    <nav aria-label="">
        <ul class="pagination">
            <?php 
                for ($i = 1; $i <= $numero_pagina; $i++) { ?>
                    <li class="page-item"><a class="page-link" href="?modulo=estados&pagina=listagem&paginacao=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php    }
            ?>
        </ul>
    </nav>
<?php
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
