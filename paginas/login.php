<h2 align=center>Admin</h2>

<form action="./?p=login&op=entrar" method="post">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div><label for="">Senha</label><input type="password" name="senha" class="form-control" required></div>
            <div class="text-center mt-4 mb-4"><button type="submit" class="btn btn-lg btn-primary">Login</div>
        </div>
        <div class="col-3"></div>
    </div>
</form>

<?php
session_start();

if (isset($_POST['senha'])) {
    $senha = $_POST['senha'];

    if ($senha == "senha") {
        session_start();
        $_SESSION["id_usuario"] = 1;
        header("Location:./?p=admin");
        exit();
    } else {
        $erro = "Senha incorreta";
    }
}
?>