<?php 
    session_start();

    $path = dirname(__DIR__);
    $id = '';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    } else{
        header('Location: page404.php');
        die();
    }
    require_once($path.'/umum/header.php');
    require_once($path.'/umum/navbar.php');
    require_once('controller/ArtikelController.php');
    require_once('controller/KomentarController.php');
    require_once('controller/IPServer.php');
    $ip = new IPServer();
    $ip = $ip->getUserIP();
    $data = [
        'id_artikel'    => $id,
        'ip_address'    => $ip
    ];

    $page = 1;
    if(isset($_GET['comment'])){
        $page = $_GET['comment'];
    }

    $artikel = new ArtikelController();
    $komentar = new KomentarController();
    // $histori = $artikel->addHistoriArtikel($data);
    $histori = $artikel->getHistoriArtikel();
    $artikel = $artikel->getById($id);
    $jumlah_komen = $komentar->getTotal($id);
    $selisih = $jumlah_komen - ($page * 5);
    $komentar = $komentar->getLast($page, $id);

    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
?>
    <!-- Hero block -->

    <a class="position-relative" name="home"></a>
    <div id="landing-hero" class="clearfix">
        <div class="container-fluid">
        <!-- Header -->
        <h1 id="judul-web" class="font-weight-semibold">
            MASJID DAARUL FIKRI<br/>
            POLITEKNIK HARAPAN BERSAMA
        </h1>
        </div>
    </div>

    <div id="content-wrapper" class="container">
        <div class="row">
            <!-- main -->
            <div class="col-lg-7 col-content">
                <?php 
                    if(isset($artikel)){
                        while($row = $artikel->fetch()){ 
                        $tgl = date('d', strtotime($row['created_at']));
                        $bln = $bulan[date('m',strtotime($row['created_at'])) - 1];
                        $tahun = date('Y', strtotime($row['created_at']));
                        $tgl_fix = $tgl . ' ' . $bln . ' ' . $tahun;     
                        ?>
                        <div class="col-sm-12 col-main">
                            <p class="text-muted"><i class="fa fa-newspaper-o"></i> Artikel > <a href="index.php?kategori=<?php echo $row['id_kategori']; ?>"><?php echo $row['nama_kategori']; ?></a></p>
                            <?php if($row['id_kegiatan'] == null) { ?>
                                <img class="thumbnail" src="uploads/artikel/<?php echo $row['thumbnail'];?>" alt="Thumbnail" style="width:100%;"/>
                            <?php } else { ?>
                                <img class="thumbnail" src="uploads/kegiatan/<?php echo $row['thumbnail'];?>" alt="Thumbnail" style="width:100%;"/>
                            <?php } ?>
                            
                            <h4 class="judul-artikel"><?php echo $row['judul'];?></h4>
                            <p class="text-muted">OLEH <?php echo strtoupper($row['nama_user']); ?>| <?php echo $tgl_fix; ?> | <?php echo strtoupper($row['nama_kategori']);?></p>
                            <p>
                                <?php echo $row['isi'];?>
                            </p>

                            <hr />

                            <div id="komentar">
                                <h3>Komentar</h3>
                                <?php 
                                    if(isset($_SESSION['save'])){
                                        if($_SESSION['save'] == 1){
                                ?>
                                    <div class="col-sm-12">
                                        <div class="alert alert-success">
                                            Komentar berhasil ditambahkan!
                                        </div>
                                    </div>
                                    <br><br>
                                <?php } else{ ?>
                                    <div class="col-sm-12">
                                        <div class="alert alert-danger">
                                            Komentar gagal ditambahkan!
                                        </div>
                                    </div>
                                    <br><br>    
                                <?php   }
                                        unset($_SESSION['save']);
                                    }
                                ?>

                                <?php if(isset($_SESSION['form']) && $_SESSION['form'] == 1){ ?>
                                    <div class="col-sm-12">
                                        <div class="alert alert-warning">
                                            Pastikan data pada form telah terisi dengan benar!
                                        </div>
                                    </div>
                                    <br><br>
                                <?php 
                                        unset($_SESSION['form']);
                                    }
                                ?>
                                <form action="views/umum/komentar_proses.php" class="form-horizontal" method="post">
                                <!-- hidden input id -->

                                    <input type="hidden" name="id_artikel" value="<?php echo $row['id_artikel'];?>">
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 control-label">Nama</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nama" placeholder="Masukan nama..." class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="email" name="email" placeholder="Masukan email ..." class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 control-label">Isi Komentar</label>
                                            <div class="col-sm-8">
                                                <textarea name="komentar" class="form-control" placeholder="Masukan komentar ..." required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-right">
                                        <div class="row">
                                            <div class="col-sm-11">
                                                <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-edit"></i> Tambahkan</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <hr/>

                            <div id="list-komentar">
                                <?php 
                                    if(isset($komentar) && $komentar->rowCount() > 0){
                                        echo '<h5>Komentar Terbaru</h5>';
                                        while($komen = $komentar->fetch()){
                                        $bln = $bulan[date('m', strtotime($komen['created_at'])) - 1];
                                        $d = date('d', strtotime($komen['created_at']));
                                        $y = date('Y', strtotime($komen['created_at']));   
                                    ?>

                                        <div class="col-sm-12 list-komentar">
                                            <p class="komentar"><a href="javascript:void(0)" data-toggle="tooltip" title="<?php echo $komen['email_pengirim'];?>"><?php echo $komen['nama_pengirim'] != '' ? $komen['nama_pengirim']:'Admin'; ?></a> | <?php echo $d.' '.$bln.' '.$y; ?></p>
                                            <p class="komentar"><?php echo $komen['komentar'];?></p>
                                        </div>
                                <?php }

                                    if($selisih > 0){
                                        echo '<div class="pull-right"><a href="index.php?page=artikel&id='.$id.'&comment='.($page+1).'" class="btn btn-primary btn-xs">Selanjutnya <i class="fa fa-arrow-right"></i></a></div>';
                                    } else{
                                        echo '<div class="pull-right"><a href="javascript:void(0)" class="btn btn-primary btn-xs disabled">Selanjutnya <i class="fa fa-arrow-right"></i></a></div>';
                                    }

                                    if($page > 1){
                                        echo '<div class="pull-left"><a href="index.php?page=artikel&id='.$id.'&comment='.($page-1).'" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left"></i> Sebelumnya</a></div>';
                                    } else{
                                        echo '<div class="pull-left"><a href="javascript:void(0)" class="btn btn-primary btn-xs disabled"><i class="fa fa-arrow-right"></i> Sebelumnya</a></div>';
                                    }

                                } ?>
                                
                            </div>
                        </div>

                <?php   }
                    } ?>
            </div>
            <!-- end main -->

            <!-- side right -->
            <div class="col-lg-4 col-content">
                <!-- kegiatan -->
                <?php include('views/template/_kegiatan.php');?>

                <!-- kategori -->
                <?php include('views/template/_kategori.php');?>
                
                <!-- artikel populer -->
                <div id="artikel-populer" class="col-sm-12 col-side">
                    <h4>ARTIKEL POPULER</h4>
                    <hr style="border: 0.5px solid #999;">
                    <div id="list-kategori">
                        <?php 
                            if(isset($histori) && $histori->rowCount() > 0) {
                                while($row = $histori->fetch()){ 
                                    if($row['id_kegiatan'] == null) {
                                        echo '<a href="index.php?page=artikel&id='.$row['id_artikel'].'" class="link-kategori"><img src="uploads/artikel/'.$row['thumbnail'].'" alt="thumbnail" style="width:35px;"/> &nbsp;'.$row['judul'].'</a><br/>';
                                    }
                                } 
                            } 
                        ?>
                    </div>
                </div>
                <!-- end artikel populer -->

                <!-- galeri -->
                <?php include('views/template/_galeri.php');?>

            </div>
            <!-- end side right -->
        </div>
    </div>

    <!-- Footer -->

    <div class="px-footer bg-primary text-center">
        <span class="text-white">Copyright © 2018 Masjid Daarul Fikri. All rights reserved.</span>
        </div>
    </div>

    <script>
        $(function(){
            $("#menu-home").addClass('active');
            $('[data-toggle="tooltip"]').tooltip(); 
        });
    </script>

<?php require_once('footer.php'); ?>