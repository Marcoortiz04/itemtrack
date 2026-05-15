<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ItemTrack | Catálogo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .hero { background: #212529; color: white; padding: 40px 0; margin-bottom: 30px; }
    </style>
</head>
<body>
    <div class="hero text-center shadow">
        <h1>📦 ItemTrack</h1>
        <p class="lead">Sistema de Gestión de Inventario</p>
        <a href="login.php" class="btn btn-primary btn-sm">Iniciar Sesión</a>
    </div>

    <div class="container">
        <div class="card shadow-sm p-4 mb-5">
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <input type="text" id="searchInput" class="form-control" placeholder="Buscar producto por nombre...">
                </div>
                <div class="col-md-6 text-end">
                    <select id="sortSelect" class="form-select w-auto d-inline-block">
                        <option value="name">Ordenar por Nombre</option>
                        <option value="price-high">Precio: Mayor a Menor</option>
                        <option value="price-low">Precio: Menor a Mayor</option>
                    </select>
                </div>
            </div>

            <table class="table table-hover" id="inventoryTable">
                <thead class="table-dark">
                    <tr>
                        <th data-type="string">Producto</th>
                        <th>Categoría</th>
                        <th data-type="number">Precio</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM items");
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td class='name-cell fw-bold'>{$row['name']}</td>
                                <td><span class='badge bg-info text-dark'>{$row['cat']}</span></td>
                                <td class='price-cell' data-value='{$row['price']}'>{$row['price']} €</td>
                                <td>{$row['units']} unidades</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // BUSCADOR
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#inventoryTable tbody tr");
            rows.forEach(row => {
                let name = row.querySelector('.name-cell').textContent.toLowerCase();
                row.style.display = name.includes(filter) ? "" : "none";
            });
        });

        // ORDENACIÓN
        document.getElementById('sortSelect').addEventListener('change', function() {
            let table = document.getElementById("inventoryTable");
            let tbody = table.querySelector("tbody");
            let rows = Array.from(tbody.rows);
            let val = this.value;

            rows.sort((a, b) => {
                let valA, valB;
                if (val === 'name') {
                    valA = a.querySelector('.name-cell').textContent.toLowerCase();
                    valB = b.querySelector('.name-cell').textContent.toLowerCase();
                    return valA.localeCompare(valB);
                } else {
                    valA = parseFloat(a.querySelector('.price-cell').getAttribute('data-value'));
                    valB = parseFloat(b.querySelector('.price-cell').getAttribute('data-value'));
                    return val === 'price-high' ? valB - valA : valA - valB;
                }
            });
            rows.forEach(row => tbody.appendChild(row));
        });
    </script>
</body>
</html>