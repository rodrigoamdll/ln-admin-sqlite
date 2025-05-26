<?php
include "../includes/db.php";
$identifier = $_POST['identifier'];
$stmt = $conn->prepare("SELECT * FROM users WHERE identifier = ?");
$stmt->execute([$identifier]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user) {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Error de Identificación</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background-color: rgb(86, 95, 185);
                font-family: 'Segoe UI', sans-serif;
                color: #1d1d3c;
            }

            body::before {
                content: "";
                position: fixed;
                top: -60%;
                left: -60%;
                width: 220%;
                height: 220%;
                background-image: url('../assets/img/volcano.png');
                background-repeat: repeat;
                background-size: 70px 70px;
                transform: rotate(315deg);
                opacity: 0.15;
                pointer-events: none;
                z-index: -1;
            }

            .card {
                border-radius: 1rem;
                border: none;
                background-color: white;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
                text-align: center;
            }

            h1 {
                font-size: 2rem;
                color: #f19524;
                margin-bottom: 1rem;
            }

            p {
                font-size: 1.1rem;
            }

            .btn-volver {
                background-color: #f19524;
                color: white;
                border: none;
            }

            .btn-volver:hover {
                background-color: #e0831d;
            }

            .logo-inline {
                height: 22px;
                vertical-align: middle;
                margin-left: 4px;
            }
        </style>
    </head>
    <body>
        <div class="container py-5">
            <div class="card p-5 mx-auto" style="max-width: 600px;">
                <img src="../assets/img/box.png" alt="Error" class="mx-auto d-block"
                    style="width: 80px; margin-bottom: 1rem;">
                <h1>Identificador no válido</h1>
                <p>No pudimos encontrar un estudiante con ese código.<br>Por favor, verifica que lo ingresaste
                    correctamente.</p>
                <p>Recuerda que el código debe ser entregado por tu docente.</p>
                <div class="mt-4">
                    <a href="../index.html" class="btn btn-volver">Intentar de nuevo</a>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}

$macaroon = $user['macaroon'];
$host = $user['host'];
$port = $user['port'];

$cleanHost = preg_replace('#^https?://#', '', $host);
$macaroon_bin = hex2bin($macaroon);
$macaroon_base64 = base64_encode($macaroon_bin);
$lndconnect = "lndconnect://$cleanHost:$port?macaroon=$macaroon_base64";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Credenciales de Conexión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>
    <style>
        body {
            background-color: rgb(86, 95, 185);
            font-family: 'Segoe UI', sans-serif;
            color: #1d1d3c;
        }

        body::before {
            content: "";
            position: fixed;
            top: -60%;
            left: -60%;
            width: 220%;
            height: 220%;
            background-image: url('../assets/img/volcano.png');
            background-repeat: repeat;
            background-size: 70px 70px;
            transform: rotate(315deg);
            opacity: 0.15;
            pointer-events: none;
            z-index: -1;
        }


        .card {
            border-radius: 1rem;
            border: none;
            background-color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .macaroon-input-styled {
            background-color: #f5f4ef;
            padding: 1rem;
            border-radius: 0.5rem;
            font-family: monospace;
            font-size: 0.9rem;
            white-space: pre-wrap;
            word-break: break-word;
            color: #1d1d3c;
            border: 1px solid #ddd;
            margin: 0;
        }

        h3,
        h5 {
            color: #f19524;
        }

        .section-title {
            border-bottom: 2px solid #f19524;
            padding-bottom: 0.25rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .step {
            margin-bottom: 1rem;
        }

        .btn-volver {
            background-color: #f19524;
            color: white;
            border: none;
        }

        .btn-volver:hover {
            background-color: #e0831d;
        }

        .logo-inline {
            height: 20px;
            vertical-align: middle;
            margin-left: 4px;
        }

        .macaroon-label {
            margin-bottom: 0.25rem;
            font-weight: 600;
        }

        .flex-columns {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .flex-columns>div {
            flex: 1 1 300px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="card p-4">
            <header class="mb-4 d-flex align-items-center">
                <img src="../assets/img/user2.png" alt="Estudiante"
                    style="width: 80px; height: auto; border-radius: 1rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">
                <div class="ms-3">
                    <h3 class="mb-0">Bienvenido</h3>
                    <h5 class="m-0">Estudiante #<?= htmlspecialchars($identifier) ?></h5>
                </div>
            </header>
            <p class="mb-4">
                El objetivo de esta práctica es que aprendas a usar <strong>Lightning Network</strong> para realizar
                pagos a través de <strong>Zeus Wallet</strong>, conectándote a un nodo creado en <strong>Polar</strong>.
                Posteriormente,
                podrás realizar pagos a la extensión de <strong>Alby</strong>.
            </p>
            <div class="section-title">Conexión al Nodo</div>
            <div class="flex-columns mb-4">
                <div>
                    <p><strong>Host:</strong> <?= htmlspecialchars($host) ?><br>
                        <strong>Puerto:</strong> <?= htmlspecialchars($port) ?>
                    </p>
                    <div class="mb-4">
                        <div class="macaroon-label">Macaroon:</div>
                        <div class="macaroon-input-styled"><?= htmlspecialchars($macaroon) ?></div>
                    </div>

                    <!-- Aca se puede mostrar el lndconnect -->
                    <!--
                    <div class="mb-4">
                        <div class="macaroon-label">LNDConnect:</div>
                        <div class="macaroon-input-styled" style="user-select: all; cursor: text;">
                            <?= htmlspecialchars($lndconnect) ?>
                        </div>
                    </div>
                    -->
                </div>
                <div>
                    <h5>Conexión QR para Zeus Wallet <img src="../assets/img/zeus-logo.png" alt="Zeus"
                            class="logo-inline">
                    </h5>
                    <p>Escanea este código en Zeus Wallet para conectarte a tu nodo de lightning:</p>
                    <div id="qrcode" class="my-3"></div>
                </div>
            </div>
            <div class="section-title">Pasos para conectarte en Zeus Wallet</div>
            <div class="step">1. Abre la aplicación Zeus Wallet <img src="../assets/img/zeus-logo.png" alt="Zeus"
                    class="logo-inline">.</div>
            <div class="step">2. Presiona el botón <strong>+</strong> para agregar un nuevo nodo.</div>
            <div class="step">3. Selecciona <strong>LND Connect</strong> y escanea el código QR de esta página.</div>
            <div class="step">4. Acepta y guarda la configuración.</div>
            <div class="step">5. Ya puedes enviar pagos usando <strong>Lightning Network <img
                        src="../assets/img/lightning-logo.png" alt="Lightning" class="logo-inline"></strong> hacia
                <strong>Alby</strong>.
            </div>
            <div class="mt-4">
                <a href="../index.html" class="btn btn-volver">Volver</a>
            </div>
        </div>
    </div>
    <script>
        const qrCode = new QRCodeStyling({
            width: 220,
            height: 220,
            data: "<?= $lndconnect ?>",
            dotsOptions: {
                color: "#1d1d3c",
                type: "rounded"
            },
            backgroundOptions: {
                color: "#ffffff"
            },
            cornersSquareOptions: {
                type: "extra-rounded"
            },
            cornersDotOptions: {
                type: "dot"
            }
        });
        qrCode.append(document.getElementById("qrcode"));
    </script>
</body>
</html>