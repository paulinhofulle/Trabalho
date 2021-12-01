<?php
    if(isset($_POST['logar'])) {
        $bSucess;
        try {
            $stmt = $conn->prepare('SELECT * FROM usuarios');
            $stmt->execute();
            $aResultados = $stmt->fetchAll();
 
            foreach ($aResultados as $oResultado) {
                if ($oResultado['login'] == $_POST['Usuario'] && $oResultado['password'] == md5($_POST['Senha'])) {
                    $_SESSION['login'] = true;
                    $_SESSION['usuario'] = $oResultado['nome'];
                    header('Location: index.php');
                    $bSucess = true;
                } else {
                    $bSucess = false;
                }
            }
            if ($bSucess == false) {
                echo 'Dados incorretos, verifique!';
            }
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
?>
<form method="post">
    <div class="form-group">
        <label for="nome">Login</label>
        <input type="text" class="form-control" name="Usuario" id="Usuario" placeholder="Usuario">
        <label for="nome">Senha</label>
        <input type="password" class="form-control" name="Senha" id="Senha" placeholder="Senha">
    </div>
    <input type="submit" name="logar" value="Logar">
</form>