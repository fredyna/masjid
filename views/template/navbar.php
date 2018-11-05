<!-- Nav -->
<nav class="px-nav px-nav-left">
    <button type="button" class="px-nav-toggle" data-toggle="px-nav">
      <span class="px-nav-toggle-arrow"></span>
      <span class="navbar-toggle-icon"></span>
      <span class="px-nav-toggle-label font-size-11">HIDE MENU</span>
    </button>

    <ul class="px-nav-content">
      <li class="px-nav-box p-a-3 b-b-1" id="demo-px-nav-box">
        <img src="../../assets/img/avatars/user.jpg" alt="" class="pull-xs-left m-r-2 border-round" style="width: 54px; height: 54px;">
        <div class="font-size-16"><span class="font-weight-light">Welcome, </span><strong><?php echo $user_login['username'];?></strong></div>
      </li>

      <li class="px-nav-item" id="menu-beranda">
        <a href="index.php"><i class="px-nav-icon ion-home"></i><span class="px-nav-label"> BERANDA</span></a>
      </li>
      <?php if($user_login['role'] == 1){ ?>
        <li class="px-nav-item" id="menu-user">
          <a href="user.php"><i class="px-nav-icon ion-person"></i><span class="px-nav-label">KELOLA USER</span></a>
        </li>
      <?php } ?>
      <li class="px-nav-item" id="menu-kategori">
        <a href="kategori.php"><i class="px-nav-icon ion-social-buffer"></i><span class="px-nav-label">KELOLA KATEGORI</span></a>
      </li>
      <li class="px-nav-item" id="menu-artikel">
        <a href="artikel.php"><i class="px-nav-icon ion-ios-paper"></i><span class="px-nav-label">KELOLA ARTIKEL</span></a>
      </li>
      <li class="px-nav-item" id="menu-komentar">
        <a href="javascript:void(0)"><i class="px-nav-icon ion-ios-chatboxes"></i><span class="px-nav-label"> KELOLA KOMENTAR</span></a>
      </li>
      <li class="px-nav-item" id="menu-kegiatan">
        <a href="javascript:void(0)"><i class="px-nav-icon ion-android-calendar"></i><span class="px-nav-label"> KELOLA KEGIATAN</span></a>
      </li>
      <li class="px-nav-item" id="menu-galeri">
          <a href="javascript:void(0)"><i class="px-nav-icon ion-ios-photos"></i><span class="px-nav-label"> KELOLA GALERI</span></a>
        </li>
      <li class="px-nav-item px-nav-dropdown" id="menu-setting">
        <a href="javascript:void(0)"><i class="px-nav-icon ion-gear-b"></i><span class="px-nav-label"> SETTING</a>

        <ul class="px-nav-dropdown-menu">
        <?php if($user_login['role'] == 1){ ?>
          <li class="px-nav-item" id="sub-profil-masjid"><a href="profil_masjid.php"><span class="px-nav-label">PROFIL MASJID</span></a></li>
        <?php } ?>
          <li class="px-nav-item" id="sub-profil-user"><a href="profil_user.php"><span class="px-nav-label">PROFIL USER</span></a></li>
        </ul>
      </li>
    </ul>
  </nav>

  <!-- Navbar -->
  <nav class="navbar px-navbar">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
        <b>MASJID DAARUL FIKRI</b>
      </a>
    </div>

    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#px-navbar-collapse" aria-expanded="false"><i class="navbar-toggle-icon"></i></button>

    <div class="collapse navbar-collapse" id="px-navbar-collapse">

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="../../assets/img/avatars/user.jpg" alt="" class="px-navbar-image">
            <span class="hidden-md"><?php echo $user_login['username'];?></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="profil_user.php"><span class="label label-warning pull-xs-right"><i class="fa fa-asterisk"></i></span>Profil</a></li>
            <li class="divider"></li>
            <li><a href="../logout.php"><i class="dropdown-icon fa fa-sign-out"></i>&nbsp;&nbsp;Keluar</a></li>
          </ul>
        </li>
      </ul>
    </div>
</nav>