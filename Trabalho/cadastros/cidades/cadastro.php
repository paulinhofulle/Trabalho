<?php
    if (isset($_POST['gravar'])) {
        try {
            $stmt = $conn->prepare('INSERT INTO cidades (codigo, estado, nome) values (:codigo, :estado, :nome)');
            $stmt->execute(array('nome' => $_POST['nome'],
                                 'codigo' => $_POST['codigo'],
                                 'estado' => $_POST['estado']));
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
?>
<form method="post">
    <div class="form-group">
        <label for="codigo">Código</label>
        <input type="number" class="form-control" name="codigo" id="codigo" placeholder="Código">
    </div>
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome">
    </div>
    <div class="form-group">
        <label for="estado">Estado</label>
        <input type="number" class="form-control" name="estado" id="estado" placeholder="Código do Estado">
    </div>

    <input type="submit" name="gravar" value="Gravar">
</form>
