<?php
    session_start();  
    if(!isset($_SESSION['user_login'])){
      header('Location: ../login.php' );
      die();
    } else{
      require_once('../../controller/AuthController.php');
      $auth = new AuthController();
      $user_login = $auth->getUserLogin();
    }
    require_once('../template/header.php');
    require_once('../template/navbar.php');
?>

<!-- Content -->
<div class="px-content">
  <div class="page-header">
    <h1><i class="px-nav-icon ion-home"></i><span class="px-nav-label"></span>BERANDA</h1>
  </div>

  <div class="row">
    <div class="col-sm-6">
      <a href="#" class="box bg-primary">
        <div class="box-cell p-a-3 valign-middle">
          <i class="box-bg-icon middle right ion-person-stalker"></i>

          <span class="font-size-24"><strong>3</strong></span><br>
          <span class="font-size-15">Users</span>
        </div>
      </a>
    </div>

    <div class="col-sm-6">
      <a href="#" class="box bg-success">
        <div class="box-cell p-a-3 valign-middle">
          <i class="box-bg-icon middle right ion-social-buffer"></i>

          <span class="font-size-24"><strong>4</strong></span><br>
          <span class="font-size-15">Kategori</span>
        </div>
      </a>
    </div>

    <div class="col-sm-6">
      <a href="#" class="box bg-info">
        <div class="box-cell p-a-3 valign-middle">
          <i class="box-bg-icon middle right ion-ios-paper"></i>

          <span class="font-size-24"><strong>5</strong></span><br>
          <span class="font-size-15">Artikel</span>
        </div>
      </a>
    </div>

    <div class="col-sm-6">
      <a href="#" class="box bg-warning">
        <div class="box-cell p-a-3 valign-middle">
          <i class="box-bg-icon middle right ion-ios-chatboxes"></i>

          <span class="font-size-24"><strong>5</strong></span><br>
          <span class="font-size-15">Komentar</span>
        </div>
      </a>
    </div>
  </div>
</div>
<!-- content -->

<script>
    $(function(){
        $("#menu-beranda").addClass('active');
    });
</script>

<?php
    require_once('../template/footer.php');
?>