<?php
session_start();
if (isset($_POST['login'])) {
    if ($_POST['user'] == 'admin' && $_POST['pass'] == 'admin1234') {
        $_SESSION['admin'] = true;
        header("Location: admin.php");
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login | ItemTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex align-items-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow p-4">
                    <h3 class="text-center mb-4">Acceso Admin</h3>
                    <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label>Usuario</label>
                            <input type="text" name="user" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Contraseña</label>
                            <input type="password" name="pass" class="form-control" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary w-100">Entrar</button>
                    </form>
                    <div class="text-center mt-3 small">
                        <a href="index.php text-decoration-none">← Volver a la web</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>