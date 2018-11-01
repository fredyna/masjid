<?php
    session_start();
    if(!isset($_SESSION['user_login'])){
      header('Location: ../login.php' );
      die();
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
    <div class="col-md-6">
      <div class="panel">
        <div class="panel-title">Title</div>
        <small class="panel-subtitle text-muted">Support panel subtitle</small>
        <div class="panel-body">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
        </div>
      </div>
    </div>
    
    <div class="col-md-6">
      <div class="panel">
        <div class="panel-title">Title</div>
        <small class="panel-subtitle text-muted">Support panel subtitle</small>
        <div class="panel-body">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
        </div>
      </div>
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