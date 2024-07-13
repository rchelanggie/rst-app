<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>RST</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div>
            <img src="images/Logo.png" alt="logo" />
        </div>
    </nav>
    @include('dashboard.layout.header')
    @include('dashboard.index')
    @include('dashboard.layout.footer')
    
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>
