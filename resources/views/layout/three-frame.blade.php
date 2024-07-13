
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>-</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 3;
            top: 0;
            left: 0;
            background-color: #ffffff;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: black;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar .nav-link .icon {
            margin-right: 10px;
        }

        .sidebar .nav-link p {
            margin: 5px;
        }

        #main {
            transition: margin-left .5s;
            padding: 16px;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
            display: none;
        }
        
        .logo {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 2;
        }
        
        .card {
            background-color: #fff;
            border-radius: 20px;
            border: 0px;
            margin: 10px;
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            border-radius: 20px;
            border: 0px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #CFE0ED;
            color: #0D63A5;
        }
    </style>
</head>

<body id="page-top">
    <div class="logo">
        <img src="{{ asset('images/RightLogo.png') }}" style="width: 450px; height: 450px" alt="logo" />
    </div>
    <nav id="mainNav">
        <div class="d-flex justify-content-between text-black fixed-top">
            <div class="pt-4 pl-5">
                <span id="openSidebar" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
                <span id="closeSidebar"
                    style="position:relative; left: 130px; color: black; font-size:2rem; cursor:pointer; display: none;"
                    onclick="closeNav()"><img src="{{ asset('images/BackArrow.png') }}" alt=""></span>
            </div>
        </div>
    </nav>

    <div id="mySidebar" class="sidebar">
        <div class="p-3">
            <img src="images/LogoSidebar.png" alt="Logo">
        </div>
        <div class="card">
            <a href="{{ route('home') }}" class="nav-link">
                <span class="icon"><img src="images/Home.png" width="20px" height="20px" alt=""></span>
                <p>Home</p>
            </a>
        </div>

        <div class="card">
            <a href="{{ route('panduan') }}" class="nav-link">
                <span class="icon"><img src="images/Panduan.png" width="20px" height="20px" alt=""></span>
                <p>Panduan</p>
            </a>
        </div>

        <div class="card">
            <a href="{{ route('informasi') }}" class="nav-link">
                <span class="icon"><img src="images/Tentang.png" width="20px" height="20px" alt=""></span>
                <p>Tentang</p>
            </a>
        </div>
    </div>

    <div class="overlay" id="overlay" onclick="closeNav()"></div>

    <div id="main" class="container d-inline-flex m-3">
        @yield('content')
    </div>
    <div style="background-color: #CFE0ED; position: absolute;top: 50%;left: 0;width: 100%;height: 50%;z-index: -1;">
    </div>
    <div style="position: absolute;top: 80%;left: 0;width: 100%;height: 50%;z-index: -2;">
        <img src="images/Ellipse.png" style="position: absolute;
    bottom: 0;
    right: 0;" alt="" />
    </div>
    <script>
        window.addEventListener('scroll', function() {
            var navbar = document.getElementById('mainNav');
            if (window.scrollY > 50) {
                navbar.classList.remove('fixed-top');
                navbar.classList.add('d-none');
            } else {
                navbar.classList.add('fixed-top');
                navbar.classList.remove('d-none');
            }
        });
    </script>
    <script>
        function openNav() {
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementById("openSidebar").style.display = "none";
            document.getElementById("closeSidebar").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("openSidebar").style.display = "block";
            document.getElementById("closeSidebar").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }
    </script>

</body>
