<html>

<head>
    <title><?= $title ?></title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/bootstrap/3/css/bootstrap.min.css' ?>">
    <style>
        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }

        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }

        .form-signin .checkbox {
            font-weight: normal;
        }

        .form-signin .form-control {
            position: relative;
            font-size: 16px;
            height: auto;
            padding: 10px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="text"] {
            margin-bottom: -1px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .account-wall {
            margin-top: 20px;
            padding: 40px 0px 20px 0px;
            background-color: #f7f7f7;
            -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }

        .login-title {
            color: #555;
            font-size: 18px;
            font-weight: 400;
            display: block;
        }

        .profile-img {
            width: 96px;
            height: 96px;
            margin: 0 auto 10px;
            display: block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
        }

        .need-help {
            margin-top: 10px;
        }

        .new-account {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container" style="margin-top: 50px">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <!--<h1 class="text-center">Klinik Sumber Waras</h1>-->

                <?php if (isset($error)) {
                    echo $error;
                }; ?>
                <div class="account-wall">
                    <h1 class="text-center login-title">Silahkan Masuk Program Pendaftaran Pasien Baru</h1>
                    <img style="width: 300px; height: 150px; display: block; margin:auto;" src="<?php echo base_url() . 'assets/img/logo.png' ?>" alt="">
                    <form class="form-signin" method="POST" action="<?= base_url() ?>index.php/daftar_c">
                        <div class="form-group" style="text-align: center;">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Masukkan Username Anda" autofocus>
                            <?php echo form_error('username'); ?>
                        </div>
                        <div class="form-group" style="text-align: center;">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password Anda">
                            <?php echo form_error('password'); ?>
                        </div>

                        <button class="btn btn-lg btn-primary btn-block" name="btn-login" id="btn-login" type="submit">
                            Masuk</button><br>
                        <p style="text-align: center;">User: admin | Password: admin</p>
                    </form>
                </div>
                <div id="error" style="margin-top: 10px"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-3.4.1.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/bootstrap/3/js/bootstrap.min.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.validate.min.js' ?>"></script>
</body>
<footer>
    <p style="text-align: center;"><i class="fa fa-copyright" aria-hidden="true">Copyright &copy; <?= $copy; ?> <?= date("Y"); ?> </i></p>
</footer>

</html>