<?php 
  session_start();
?>
<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

  <title>Masjid Daarul Fikri</title>

  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">
  <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">

  <!-- Core stylesheets -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/css/pixeladmin.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/css/widgets.min.css" rel="stylesheet" type="text/css">

  <!-- font awesome -->
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <!-- Theme -->
  <link href="../assets/css/themes/candy-green.min.css" rel="stylesheet" type="text/css">

  <!-- Pace.js -->
  <script src="../assets/pace/pace.min.js"></script>
  <!-- Load jQuery -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Core scripts -->
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/pixeladmin.min.js"></script>

  <!-- Custom styling -->
  <style>
    body{
        background-color: #eaeaea;
    }

    .page-signin-modal {
      position: relative;
      top: auto;
      right: auto;
      bottom: auto;
      left: auto;
      z-index: 1;
      display: block;
    }

    .page-signin-form-group { position: relative; }

    .page-signin-icon {
      position: absolute;
      line-height: 21px;
      width: 36px;
      border-color: rgba(0, 0, 0, .14);
      border-right-width: 1px;
      border-right-style: solid;
      left: 1px;
      top: 9px;
      text-align: center;
      font-size: 15px;
    }

    html[dir="rtl"] .page-signin-icon {
      border-right: 0;
      border-left-width: 1px;
      border-left-style: solid;
      left: auto;
      right: 1px;
    }

    html:not([dir="rtl"]) .page-signin-icon + .page-signin-form-control { padding-left: 50px; }
    html[dir="rtl"] .page-signin-icon + .page-signin-form-control { padding-right: 50px; }

    #page-signin-forgot-form {
      display: none;
    }

    /* Margins */

    .page-signin-modal > .modal-dialog { margin: 30px 10px; }

    .page-signin-modal > .modal-dialog .modal-content { 
        margin-top: 20%;
        box-shadow: 1px 1px 7px 0px rgba(0,0,0,0.2);
    }

    @media (min-width: 544px) {
      .page-signin-modal > .modal-dialog { margin: 60px auto; }
    }
  </style>
  <!-- / Custom styling -->
</head>
<body>

  <div class="page-signin-modal modal">

    <?php if(isset($_SESSION['form']) && $_SESSION['form'] == 1){ ?>
        <div class="col-sm-12">
            <div class="alert alert-warning">
                Username atau password salah!
            </div>
        </div>
        <br><br>
    <?php 
            unset($_SESSION['form']);
        }
    ?>

    <div class="modal-dialog">
      <div class="modal-content">
        <div class="box m-a-0">
          <div class="box-row">

            <div class="box-cell col-md-5 bg-primary p-a-4">
                <br/>
                <img src="../assets/img/logo.png" style="width:110px;height:100px;display:block;margin:auto;" alt="Logo">
                <br/>
                <div class="text-xs-center text-md-left">
                    <p class="text-center">
                        <span class="font-size-20 line-height-1">Masjid Daarul Fikri</span>
                    </p>
                    <div class="font-size-14 m-t-1 line-height-1 text-center">Politeknik Harapan Bersama</div>
                </div>
            </div>

            <div class="box-cell col-md-7">

              <!-- Sign In form -->

              <form action="login_proses.php" method="post" class="p-a-4" id="page-signin-form">
                <h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold">Silahkan Masuk</h4>

                <fieldset class="page-signin-form-group form-group form-group-lg">
                  <div class="page-signin-icon text-muted"><i class="ion-person"></i></div>
                  <input type="text" name="username" class="page-signin-form-control form-control" placeholder="Username / Email">
                </fieldset>

                <fieldset class="page-signin-form-group form-group form-group-lg">
                  <div class="page-signin-icon text-muted"><i class="ion-asterisk"></i></div>
                  <input type="password" name="password" class="page-signin-form-control form-control" placeholder="Password">
                </fieldset>

                <div class="clearfix"></div>

                <button type="submit" name="submit" class="btn btn-block btn-lg btn-primary m-t-3">Masuk</button>
              </form>

              <!-- / Sign In form -->

            </div>
          </div>
        </div>
      </div>

      <div class="text-xs-center m-t-2 font-size-14 text-black" id="px-demo-signup-link">
        Copyright &copy; 2018 Masjid Daarul Fikri. All rights reserved.
      </div>
    </div>
  </div>

  <!-- ==============================================================================
  |
  |  SCRIPTS
  |
  =============================================================================== -->

  <!-- jQuery -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/pixeladmin.min.js"></script>

  
</body>
</html>
