<?php
    require('../config/database.php');

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header("Location: list_users.php");
        exit;
    }

    $id = $_GET['id'];
    $sql = 'SELECT id, firstname, lastname, email, mobile_phone, photo_url FROM users WHERE id = $1';
    $result = pg_query_params($supa_conn, $sql, array($id));
    $user = pg_fetch_assoc($result);

    if (!$user) {
        header("Location: list_users.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Combox - Editar Usuario</title>
        <link rel="icon" type="image/png" href="icons/icono.png">
        <style>
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            body {
                background-color: #E89684;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 24px 16px;
            }
            .card {
                background-color: #ffffff;
                padding: 36px 32px;
                border-radius: 12px;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
                width: 100%;
                max-width: 440px;
            }
            .header {
                text-align: center;
                margin-bottom: 24px;
            }
            .brand-icon {
                width: 52px;
                height: 52px;
                margin-bottom: 10px;
            }
            h2 {
                color: #2b2b2b;
                font-size: 24px;
                margin-bottom: 4px;
            }
            p.subtitle {
                color: #666666;
                font-size: 14px;
            }
            .form-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }
            .form-group {
                margin-bottom: 16px;
                text-align: left;
            }
            label {
                display: block;
                font-size: 13px;
                font-weight: 600;
                color: #444444;
                margin-bottom: 6px;
            }
            input[type="text"],
            input[type="tel"],
            input[type="email"],
            input[type="file"] {
                width: 100%;
                padding: 10px 12px;
                border: 1px solid #d1d5db;
                border-radius: 6px;
                font-size: 14px;
                color: #1f2937;
                outline: none;
            }
            input:focus {
                border-color: #E89684;
                box-shadow: 0 0 0 3px rgba(232, 150, 132, 0.25);
            }
            .current-photo {
                text-align: center;
                margin-bottom: 16px;
                padding: 10px;
                background: #f9fafb;
                border-radius: 8px;
                border: 1px dashed #d1d5db;
            }
            .current-photo img {
                width: 100px;
                height: 100px;
                object-fit: cover;
                border-radius: 50%;
                margin-top: 6px;
            }
            .btn-submit {
                width: 100%;
                padding: 12px;
                background-color: #E89684;
                color: #ffffff;
                border: none;
                border-radius: 6px;
                font-size: 15px;
                font-weight: 600;
                cursor: pointer;
                transition: background-color 0.2s ease;
            }
            .btn-submit:hover {
                background-color: #d67f6d;
            }
            .footer-links {
                text-align: center;
                margin-top: 16px;
                font-size: 13px;
            }
            .footer-links a {
                color: #d67f6d;
                text-decoration: none;
                font-weight: 600;
            }
        </style>
    </head>
    <body>
        <div class="card">
            <div class="header">
                <img src="icons/icono.png" alt="Combox Logo" class="brand-icon">
                <h2>Editar Usuario</h2>
                <p class="subtitle">Actualiza los datos y la fotografía de perfil</p>
            </div>

            <form action="update_user.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">

                <div class="form-grid">
                    <div class="form-group">
                        <label for="firstname">Nombre</label>
                        <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="lastname">Apellido</label>
                        <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="mobile_phone">Celular</label>
                    <input type="tel" id="mobile_phone" name="mobile_phone" value="<?php echo htmlspecialchars($user['mobile_phone']); ?>" required>
                </div>

                <?php if (!empty($user['photo_url'])) { ?>
                    <div class="current-photo">
                        <label>Foto actual:</label>
                        <img src="<?php echo htmlspecialchars($user['photo_url']) . '?v=' . time(); ?>" alt="Foto actual">
                    </div>
                <?php } ?>

                <div class="form-group">
                    <label for="photo">Nueva foto (JPG o PNG, máx. 1 MB)</label>
                    <input type="file" id="photo" name="photo" accept=".jpg, .jpeg, .png">
                </div>

                <button type="submit" class="btn-submit">Guardar cambios</button>
            </form>

            <div class="footer-links">
                <a href="list_users.php">Cancelar y volver a la lista</a>
            </div>
        </div>
    </body>
</html>