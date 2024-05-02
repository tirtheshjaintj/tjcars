<?php require '../controllers/redirect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TJ Cars Agency Registration</title>
    <?php require '../components/bootstrap.php';?>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <?php require "../components/navbar.php"; ?>
    <section class="vh-100 pt-5 login_section">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="https://c4.wallpaperflare.com/wallpaper/421/641/257/taxi-skyscrapers-city-traffic-wallpaper-preview.jpg"
                                    alt="login form" class="img-fluid"
                                    style="border-radius: 1rem 0 0 1rem;height:100%;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-lg-5 text-black">
                                    <form method="POST" action="/tjcars/controllers/loggedin.php" id="register_form">
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                        <span class="h1 fw-bold mb-0">TJ Cars <i class="fa fa-car"></i></span>
                                        </div>
                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Register Your Agency</h5>
                                        <div class="form-floating mb-4">
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Your name" minlength="3" required>
                                            <label for="floatingInput" >Your Name</label>
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input type="email" name="email" class="form-control" id="email"
                                                placeholder="name@example.com" required>
                                            <label for="floatingInput">Email address</label>
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input type="password" name="password" class="form-control"
                                                id="password" placeholder="Password" minlength="8" required>
                                            <label for="floatingPassword" >Password</label>
                                        </div>
                                        <input type="hidden" id="type" name="type" value="agency">
                                        <div class="pt-1 mb-4">
                                            <button  class="btn btn-dark float-right btn-md " type="submit">Register <i class="fa fa-car"></i></button>
                                        </div>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Already have an account? <a
                                                href="login.php" class="text-decoration-none">Login here</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="../scripts/register.js"></script>
</body>

</html>