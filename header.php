<?php
session_start();
?>
<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <h3 class="text-light fw-bold" style="display: flex; align-items: center; gap: 10px;">
                <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" style="width: 50px; height: auto;">
                    <ellipse cx="28" cy="29" rx="25" ry="6" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2px"></ellipse>
                    <path d="M53 29v1c0 15.46-11.19 26-25 26S3 45.46 3 30v-1" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2px"></path>
                    <path d="M53 34a7.64 7.64 0 0 1 5-2 2.65 2.65 0 0 1 3 3v1a9 9 0 0 1-9 9s-3 0-4 1" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2px"></path>
                    <path d="M43 51c4.31 1.28 7 3 7 5 0 3.87-9.85 7-22 7S6 59.87 6 56c0-2 2.69-3.72 7-5" fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="2px"></path>
                    <path d="m52.36 37.21-.72-1.87C45.67 37.67 37.06 39 28 39s-17.67-1.33-23.64-3.66l-.72 1.87.68.25-.68 1.75C9.82 41.62 18.7 43 28 43s18.18-1.38 24.36-3.79l-.68-1.75Z" fill="#ffffff"></path>
                    <path d="M30 1c0 4.5-4 4.5-4 9s4 4.5 4 9M11 5c0 4-4 4-4 8s4 4 4 8M47 5c0 4-4 4-4 8s4 4 4 8M39 4l1-1M36 4l-1-1M36 7l-1 1M39 7l1 1M60 19l1-1M57 19l-1-1M57 22l-1 1M60 22l1 1M19 14l1-1M16 14l-1-1M16 17l-1 1M19 17l1 1" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2px"></path>
                </svg><span></span>Teapot
            </h3>
        </a>
        <!-- Toggler for mobile view -->
        <button class="navbar-toggler bg-body border border-1 border-black" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""><?xml version="1.0" ?><svg height="25" viewBox="0 0 48 48" width="25" xmlns="http://www.w3.org/2000/svg"><path d="M12 26c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 8c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm-6 1c-.55 0-1 .45-1 1s.45 1 1 1 1-.45 1-1-.45-1-1-1zm6-9c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm30 11c.55 0 1-.45 1-1s-.45-1-1-1-1 .45-1 1 .45 1 1 1zm-14-7c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0-7c.55 0 1-.45 1-1s-.45-1-1-1-1 .45-1 1 .45 1 1 1zm-22 20c-.55 0-1 .45-1 1s.45 1 1 1 1-.45 1-1-.45-1-1-1zm14 14c-.55 0-1 .45-1 1s.45 1 1 1 1-.45 1-1-.45-1-1-1zm0-34c.55 0 1-.45 1-1s-.45-1-1-1-1 .45-1 1 .45 1 1 1zm0 7c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 11c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3zm16 1c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 8c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-8c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm6 17c-.55 0-1 .45-1 1s.45 1 1 1 1-.45 1-1-.45-1-1-1zm-14 7c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 7c-.55 0-1 .45-1 1s.45 1 1 1 1-.45 1-1-.45-1-1-1zm-8-24c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3zm0 17c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm8-9c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/><path d="M0 0h48v48h-48z" fill="none"/></svg></span>            
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse gap-2" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto gap-2">
                <a class="nav-link active text-light" href="index.php">Home</a>
                <?php
                if (!isset($_SESSION['user'])) {
                    // Display Sign Up link only if user is not logged in
                    echo '<a class="nav-link active text-light" href="account.php">Sign Up</a>';
                }
                ?>
                <!-- Profile dropdown -->

                <?php
                if (isset($_SESSION['user'])) {
                    ?>
                    <a class="nav-link active text-light" href="cart.php">Cart</a>
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profile
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                    </ul>
                </div>
                <?php
                }
                ?>
            </div>

            <form class="d-flex mt-2 mb-2">
                <input type="search" class="form-control me-2" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
            </form>

        </div>
    </div>
</nav>