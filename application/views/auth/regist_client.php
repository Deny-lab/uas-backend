<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<? base_url('assets/'); ?> css/form-validation.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="header">
            <h2>Create Account</h2>
        </div>
    </div>
    <form action="" class="form" id="form">
        <div class="form-control">
            <label>Username</label>
            <input type="text" name="name" id="name" placeholder="Username">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error Message</small>
        </div>
        <div class="form-control">
            <label>Email</label>
            <input type="text" name="email" id="email" placeholder="Email">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error Message</small>
        </div>
        <div class="form-control">
            <label>Password</label>
            <input type="text" name="password1" id="password1" placeholder="Password">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error Message</small>
        </div>
        <div class="form-control">
            <label>Repeat Password</label>
            <input type="text" name="password2" id="password2" placeholder="Repeat Password">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error Message</small>
        </div>

        <button>Submit</button>
    </form>

    <script src="<? base_url("assets/") ?>js/form-validation.js"></script>

</body>

</html>