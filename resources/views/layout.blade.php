<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

    <style>
        body {
            display: flex;
        }

        /* Estilo de la barra lateral */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #111;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            transition: 0.3s; /* Transición suave */
        }

        .sidebar.hidden {
            left: -250px; /* Ocultar la barra lateral */
        }

        .sidebar a {
            padding: 15px;
            text-decoration: none;
            font-size: 18px;
            color: #818181;
            display: block;
        }

        .sidebar a:hover {
            background-color: #575757;
            color: white;
        }

        /* Ajustar el contenido principal */
        .content {
            margin-left: 250px; /* Espacio para la barra lateral */
            padding: 20px;
            width: 100%;
            transition: 0.3s;
        }

        .content.sidebar-hidden {
            margin-left: 0; /* Sin espacio cuando la barra lateral está oculta */
        }

        /* Estilo de la barra superior */
        .topbar {
            width: 100%;
            height: 60px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            position: fixed;
            top: 0;
            left: 250px; /* Alineada con la barra lateral */
            transition: 0.3s;
        }

        .topbar.sidebar-hidden {
            left: 0; /* Cuando la barra lateral está oculta */
        }

        /* Para que el contenido se ajuste debajo de la barra superior */
        .main-content {
            margin-top: 60px;
        }

        .toggle-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        .toggle-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- Barra lateral -->
    <div class="sidebar" id="sidebar">
    <a href="{{ route('home') }}">Inicio</a>
    <a href="{{ route('device.index') }}">Dispositivos</a>
    <a href="{{ route('contacts.index') }}">Contactos</a>
    <a href="{{ route('campaigns.index') }}">Campañas</a>
    <a href="{{ route('tags.index') }}">Etiquetas</a>
    <a href="#">Ajustes</a>
</div>


    <!-- Barra superior -->
    <div class="topbar" id="topbar">
        <button class="toggle-btn" onclick="toggleSidebar()">&#9776;</button>
        <h4>Caso2Tech</h4>
        <div>
            <button class="btn btn-outline-primary">Notificaciones</button>
            <button class="btn btn-outline-secondary">Perfil</button>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="content" id="content">
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            const topbar = document.getElementById('topbar');

            sidebar.classList.toggle('hidden');
            content.classList.toggle('sidebar-hidden');
            topbar.classList.toggle('sidebar-hidden');
        }
    </script>
</body>
</html>
