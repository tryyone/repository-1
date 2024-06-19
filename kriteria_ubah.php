<?php
    $id = stripslashes(strip_tags(htmlspecialchars($_GET['ID'],ENT_QUOTES)));
    $row = $db->get_row("SELECT * FROM tb_kriteria WHERE kode_kriteria='".$id."'"); 
?>
<div class="page-header">
    <h1>Ubah Kriteria</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include 'aksi.php' ?>
        <form method="post" action="?m=kriteria_ubah&amp;ID=<?=$row->kode_kriteria?>">
           <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode" value="<?=$row->kode_kriteria?>"/>
            </div>
            <div class="form-group">
                <label>Nama Kriteria<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?=$row->nama_kriteria?>"/>
            </div>
            <div class="form-group">
                <label>Bobot <span class="text-danger"></span></label>
               <input class="form-control" type="text" name="bobot" value="<?=$row->bobot?>"/>
            </div>
           
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=kriteria"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>