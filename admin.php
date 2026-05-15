<?php 
// 1. GESTIÓN DE SESIÓN Y SEGURIDAD
session_start();
if (!isset($_SESSION['admin'])) { 
    header("Location: login.php"); 
    exit(); 
}

include('db.php'); 

// 2. LÓGICA DE CERRAR SESIÓN (Corregido para evitar el 404)
if(isset($_GET['logout'])) { 
    session_destroy(); 
    header("Location: index.php"); 
    exit();
}

// 3. LÓGICA CRUD (Añadir, Editar, Borrar)
$edit_id = ""; $edit_name = ""; $edit_cat = ""; $edit_price = ""; $edit_units = "";

// Guardar (Tanto nuevo como editado)
if(isset($_POST['save'])){
    $n = mysqli_real_escape_string($conn, $_POST['name']); 
    $c = mysqli_real_escape_string($conn, $_POST['cat']); 
    $p = $_POST['price']; 
    $u = $_POST['units'];
    
    if($_POST['id'] == ""){
        // Es un nuevo registro
        mysqli_query($conn, "INSERT INTO items (name, cat, price, units) VALUES ('$n', '$c', '$p', '$u')");
    } else {
        // Es una edición
        $id = $_POST['id'];
        mysqli_query($conn, "UPDATE items SET name='$n', cat='$c', price='$p', units='$u' WHERE id=$id");
    }
    header("Location: admin.php");
    exit();
}

// Cargar datos en el formulario para editar
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $res = mysqli_query($conn, "SELECT * FROM items WHERE id=$id");
    if($data = mysqli_fetch_assoc($res)){
        $edit_id = $data['id']; 
        $edit_name = $data['name']; 
        $edit_cat = $data['cat']; 
        $edit_price = $data['price']; 
        $edit_units = $data['units'];
    }
}

// Borrar objeto
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM items WHERE id=$id");
    header("Location: admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin | ItemTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; padding-top: 70px; }
        .navbar { shadow: 0 2px 4px rgba(0,0,0,.1); }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark fixed-top px-4">
        <span class="navbar-brand fw-bold">⚙️ Panel de Gestión ItemTrack</span>
        <div class="d-flex">
            <a href="index.php" class="btn btn-outline-light btn-sm me-2">Vista Pública</a>
            <a href="admin.php?logout=1" class="btn btn-danger btn-sm">Cerrar Sesión</a>
        </div>
    </nav>

    <div class="container">
        <div class="card shadow p-4 mb-4">
            <h5 class="text-primary mb-3"><?php echo $edit_id ? "📝 Editando: $edit_name" : "➕ Añadir Nuevo Producto"; ?></h5>
            <form method="POST" class="row g-3">
                <input type="hidden" name="id" value="<?php echo $edit_id; ?>">
                
                <div class="col-md-3">
                    <label class="form-label small">Nombre del Producto</label>
                    <input type="text" name="name" value="<?php echo $edit_name; ?>" class="form-control" required>
                </div>
                
                <div class="col-md-3">
                    <label class="form-label small">Categoría</label>
                    <select name="cat" class="form-select">
                        <option value="Electrónica" <?php if($edit_cat=="Electrónica") echo "selected"; ?>>Electrónica</option>
                        <option value="Mobiliario" <?php if($edit_cat=="Mobiliario") echo "selected"; ?>>Mobiliario</option>
                        <option value="Oficina" <?php if($edit_cat=="Oficina") echo "selected"; ?>>Oficina</option>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <label class="form-label small">Precio (€)</label>
                    <input type="number" name="price" step="0.01" value="<?php echo $edit_price; ?>" class="form-control" required>
                </div>
                
                <div class="col-md-2">
                    <label class="form-label small">Stock</label>
                    <input type="number" name="units" value="<?php echo $edit_units; ?>" class="form-control" required>
                </div>
                
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" name="save" class="btn btn-success w-100 fw-bold">
                        <?php echo $edit_id ? "Actualizar" : "Guardar"; ?>
                    </button>
                </div>
            </form>
            <?php if($edit_id): ?>
                <div class="mt-2 text-end">
                    <a href="admin.php" class="text-muted small">Cancelar edición</a>
                </div>
            <?php endif; ?>
        </div>

        <div class="card shadow border-0 overflow-hidden">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = mysqli_query($conn, "SELECT * FROM items ORDER BY id DESC");
                    while($r = mysqli_fetch_assoc($res)){
                        echo "<tr>
                            <td>#{$r['id']}</td>
                            <td class='fw-bold'>{$r['name']}</td>
                            <td><span class='badge bg-secondary'>{$r['cat']}</span></td>
                            <td>{$r['price']}€</td>
                            <td>{$r['units']} unds.</td>
                            <td class='text-center'>
                                <a href='admin.php?edit={$r['id']}' class='btn btn-warning btn-sm'>Editar</a>
                                <a href='admin.php?delete={$r['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que quieres eliminar este producto?\")'>Borrar</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>