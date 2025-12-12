<?php
session_start();
if(!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - AGROTECH</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            height: 100vh;
            background: #0f0f0f;
            font-family: "Segoe UI", sans-serif;
        }

        /* ----------------------------------
           SIDEBAR
        -------------------------------------*/
        .sidebar {
            width: 260px;
            background: #111;
            border-right: 1px solid #2b2b2b;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 25px 20px;
        }

        .sidebar .logo {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 40px;
        }

        .sidebar .logo i {
            background: linear-gradient(135deg, #4fd1c5 0%, #38b2ac 100%);
            padding: 15px;
            border-radius: 12px;
            font-size: 24px;
        }

        .sidebar .logo h2 {
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .menu a {
            text-decoration: none;
            color: #bfbfbf;
            padding: 12px 15px;
            border-radius: 8px;
            transition: 0.3s;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
        }

        .menu a:hover,
        .menu a.active {
            background: #1f1f1f;
            color: #4fd1c5;
        }

        .menu a i {
            font-size: 18px;
        }

        /* ----------------------------------
           NAVBAR SUPERIOR
        -------------------------------------*/
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            color: white;
            overflow-y: auto;
        }

        .navbar {
            padding: 20px 35px;
            background: #111;
            border-bottom: 1px solid #2a2a2a;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .usuario-panel {
            text-align: right;
        }

        .usuario-panel p {
            font-size: 14px;
            color: #888;
        }

        .usuario-panel h3 {
            font-size: 16px;
            color: #4fd1c5;
        }

        .btn-logout {
            background: #e11d48;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            color: white;
            cursor: pointer;
            font-weight: bold;
            margin-left: 20px;
            transition: 0.3s;
        }

        .btn-logout:hover {
            background: #be123c;
        }

        /* ----------------------------------
           TARJETAS PRINCIPALES
        -------------------------------------*/
        .contenido {
            padding: 35px;
        }

        .titulo {
            font-size: 32px;
            margin-bottom: 10px;
            color: #4fd1c5;
        }

        .subtitulo {
            font-size: 16px;
            color: #888;
            margin-bottom: 40px;
        }

        .tarjetas-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 25px;
        }

        .tarjeta {
            background: #141414;
            border: 1px solid #252525;
            border-radius: 12px;
            padding: 30px;
            transition: 0.3s;
            cursor: pointer;
        }

        .tarjeta:hover {
            transform: translateY(-5px);
            border-color: #4fd1c5;
            box-shadow: 0px 8px 20px rgba(79,209,197,0.2);
        }

        .tarjeta-icono {
            background: linear-gradient(135deg, #4fd1c5 0%, #38b2ac 100%);
            width: 55px;
            height: 55px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .tarjeta-icono i {
            font-size: 24px;
            color: white;
        }

        .tarjeta h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #4fd1c5;
        }

        .tarjeta p {
            color: #b6b6b6;
        }

        /* ----------------------------------
           INFO DE SESIÓN
        -------------------------------------*/
        .info-section {
            background: #141414;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #252525;
            margin-top: 40px;
        }

        .info-section h3 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #4fd1c5;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        .info-item {
            background: #1b1b1b;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #2a2a2a;
        }

        .info-item label {
            font-size: 12px;
            text-transform: uppercase;
            color: #888;
        }

        .info-item p {
            font-size: 15px;
            margin-top: 5px;
            color: white;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">
            <i class="fas fa-leaf"></i>
            <h2>AGROTECH</h2>
        </div>

        <div class="menu">
            <a href="#" class="active"><i class="fas fa-home"></i> Dashboard</a>
            <a href="#"><i class="fas fa-chart-line"></i> Estadísticas</a>
            <a href="#"><i class="fas fa-seedling"></i> Cultivos</a>
            <a href="#"><i class="fas fa-cloud-sun"></i> Clima</a>
            <a href="#"><i class="fas fa-bell"></i> Alertas</a>
            <a href="#"><i class="fas fa-calendar-alt"></i> Calendario</a>
            <a href="#"><i class="fas fa-cog"></i> Configuración</a>
        </div>
    </aside>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="main">

        <!-- NAVBAR SUPERIOR -->
        <nav class="navbar">
            <div></div>

            <div class="usuario-panel">
                <p> <h2>Bienvenido NIcolas Acosta</h2></p>
                <h3>Usuario ID: <?php echo $_SESSION['usuario_id']; ?></h3>
            </div>

            <button class="btn-logout" onclick="window.location.href='logout.php'">
                <i class="fas fa-sign-out-alt"></i> Salir
            </button>
        </nav>

        <!-- CONTENIDO -->
        <section class="contenido">
            <h2 class="titulo">Panel de Control</h2>
            <p class="subtitulo">Accede rápidamente a las funciones del sistema</p>

            <div class="tarjetas-grid">
                <div class="tarjeta">
                    <div class="tarjeta-icono"><i class="fas fa-chart-line"></i></div>
                    <h3>Estadísticas</h3>
                    <p>Visualiza indicadores y gráficos avanzados.</p>
                </div>

                <div class="tarjeta">
                    <div class="tarjeta-icono"><i class="fas fa-seedling"></i></div>
                    <h3>Mis Cultivos</h3>
                    <p>Administra y monitorea tus cultivos fácilmente.</p>
                </div>

                <div class="tarjeta">
                    <div class="tarjeta-icono"><i class="fas fa-cloud-sun"></i></div>
                    <h3>Clima</h3>
                    <p>Consulta condiciones climáticas actualizadas.</p>
                </div>

                <div class="tarjeta">
                    <div class="tarjeta-icono"><i class="fas fa-bell"></i></div>
                    <h3>Alertas</h3>
                    <p>Revisa notificaciones importantes.</p>
                </div>
            </div>

            <!-- INFO SESIÓN -->
            <div class="info-section">
                <h3>Información de Sesión</h3>

                <div class="info-grid">
                    <div class="info-item">
                        <label>Usuario ID</label>
                        <p><?php echo $_SESSION['usuario_id']; ?></p>
                    </div>

                    <div class="info-item">
                        <label>Token</label>
                        <p><?php echo substr($_SESSION['token'], 0, 20) . "..."; ?></p>
                    </div>

                    <div class="info-item">
                        <label>Estado</label>
                        <p style="color:#22c55e">✔ Activa</p>
                    </div>

                    <div class="info-item">
                        <label>Último acceso</label>
                        <p><?php echo date("d/m/Y H:i"); ?></p>
                    </div>
                </div>
            </div>

        </section>
    </main>
</body>
</html>
