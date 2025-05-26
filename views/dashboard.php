<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../auth/login.php");
    exit;
}

include "../includes/db.php";
$stmt = $conn->query("SELECT * FROM users ORDER BY identifier ASC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #0c24c0;
            color: #1d1d3c;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h2,
        h4,
        .table th {
            color: #1d1d3c;
        }

        .card {
            background-color: #f5f4ef;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .form-control {
            border-radius: 0.5rem;
            border: 1px solid #d0d7e2;
            background-color: #ffffff;
        }

        .btn-orange {
            background-color: #f19524;
            border: none;
            color: white;
        }

        .btn-orange:hover {
            background-color: #d17f1b;
        }

        .btn-secondary {
            background-color: #e9b880;
            border: none;
            color: #1d1d3c;
        }

        .btn-secondary:hover {
            background-color: #d7a565;
        }

        .btn-outline-light {
            border-color: #1d1d3c;
            color: #1d1d3c;
        }

        .btn-outline-light:hover {
            background-color: #1d1d3c;
            color: #ffffff;
        }

        .table-responsive {
            border-radius: 0.0rem;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .table {
            background-color: #ffffff;
        }

        .table th {
            background-color: #1d1d3c;
            color: #ffffff;
        }

        .table td {
            color: #1d1d3c;
        }

        .table-hover tbody tr:hover {
            background-color: #f5f4ef;
        }

        .macaroon {
            color: #f19524;
            font-weight: bold;
            cursor: pointer;
        }

        .copy-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #28a745;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            opacity: 0;
            pointer-events: none;
            transform: translateY(20px);
            transition: opacity 0.3s ease, transform 0.3s ease;
            z-index: 1000;
        }

        .copy-notification.show {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
            display: block !important;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <header class="d-flex align-items-center justify-content-start mb-4">
            <img src="../assets/img/logo.jpg" alt="Logo"
                style="width: 80px; height: auto; border-radius: 1rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">
            <div class="ms-3">
                <h3 class="mb-0" style="color: white;">Node Nation</h3>
                <h5 style="color: #f5f4ef;">Bloque 5</h5>
            </div>
        </header>
        <div class="card mb-4">
            <h4 id="form-title">Agregar nuevo estudiante</h4>
            <form action="../controllers/create_user.php" method="POST" class="row g-3" id="user-form">
                <input type="hidden" name="edit_id" id="edit_id">
                <div class="col-md-3">
                    <input type="text" name="identifier" id="identifier" placeholder="Número de lista"
                        class="form-control" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="host" id="host" placeholder="Host (ej. https://192.168.1.21)"
                        class="form-control" required>
                </div>
                <div class="col-md-2">
                    <input type="text" name="port" id="port" placeholder="Puerto" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="macaroon" id="macaroon" placeholder="Macaroon en HEX" class="form-control"
                        required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-orange">Agregar Usuario</button>
                    <button type="button" id="cancel-edit" class="btn btn-secondary d-none">Cancelar edición</button>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white">
                <thead>
                    <tr>
                        <th>Número de Lista</th>
                        <th>Host</th>
                        <th>Puerto</th>
                        <th>Macaroon</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="user-table-body">
                    <?php foreach ($users as $user): ?>
                        <tr data-id="<?= $user['id'] ?>">
                            <td><?= htmlspecialchars($user['identifier']) ?></td>
                            <td><?= htmlspecialchars($user['host']) ?></td>
                            <td><?= htmlspecialchars($user['port']) ?></td>
                            <td>
                                <code class="macaroon" style="cursor:pointer;" data-full="<?= $user['macaroon'] ?>">
                                            <?= substr($user['macaroon'], 0, 12) . "..." . substr($user['macaroon'], -12) ?>
                                        </code>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary edit-btn" title="Editar">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger delete-btn" title="Eliminar">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <a href="../auth/logout.php" class="btn btn-orange mt-4" style="padding: 0.75rem 1.5rem; font-weight: bold;">
            <i class="bi bi-box-arrow-right me-1"></i> Cerrar sesión
        </a>
    </div>

    <div class="copy-notification" id="copyNotification">¡Copiado!</div>
    <script>
        document.querySelectorAll('.macaroon').forEach(el => {
            el.addEventListener('click', () => {
                const full = el.getAttribute('data-full');

                // Fallback method usando un input temporal
                const tempInput = document.createElement("input");
                tempInput.value = full;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand("copy");
                document.body.removeChild(tempInput);

                // Mostrar notificación
                const notif = document.getElementById('copyNotification');
                notif.classList.add('show');
                setTimeout(() => notif.classList.remove('show'), 2000);
            });
        });

        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const row = btn.closest('tr');
                row.style.display = 'none';
                const [identifier, host, port, macaroonEl] = row.querySelectorAll('td');
                const id = row.getAttribute('data-id');
                const macaroon = macaroonEl.querySelector('.macaroon').getAttribute('data-full');

                document.getElementById('edit_id').value = id;
                document.getElementById('identifier').value = identifier.textContent;
                document.getElementById('host').value = host.textContent;
                document.getElementById('port').value = port.textContent;
                document.getElementById('macaroon').value = macaroon;

                document.querySelector('button[type="submit"]').textContent = 'Actualizar Usuario';
                document.getElementById('cancel-edit').classList.remove('d-none');
                document.getElementById('form-title').textContent = "Editar Usuario";
            });
        });

        document.getElementById('cancel-edit').addEventListener('click', () => {
            document.getElementById('user-form').reset();
            document.getElementById('edit_id').value = '';
            document.getElementById('form-title').textContent = "Agregar Nuevo Usuario";
            document.querySelector('button[type="submit"]').textContent = 'Agregar Usuario';
            document.getElementById('cancel-edit').classList.add('d-none');

            document.querySelectorAll('#user-table-body tr').forEach(row => row.style.display = '');
        });

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
                    const id = btn.closest('tr').getAttribute('data-id');
                    window.location.href = '../controllers/delete_user.php?id=' + id;
                }
            });
        });
    </script>
</body>
</html>
