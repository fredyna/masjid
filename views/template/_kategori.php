<!-- kategori -->
<div id="kategori" class="col-sm-12 col-side">
    <h4>KATEGORI ARTIKEL</h4>
    <hr style="border: 0.5px solid #999;">
    <div id="list-kategori">
        <?php 
            require_once('controller/CategoryController.php');
            $category = new CategoryController();
            $category = $category->getAll();
            
            if($category->rowCount() > 0) {
            while($row = $category->fetch()){ 
                echo '<a href="index.php?kategori='.$row['id_kategori'].'" class="link-kategori">'.$row['kategori'].'</a><br/>';
                } 
            } 
        ?>
    </div>
</div>
<!-- end kategori -->