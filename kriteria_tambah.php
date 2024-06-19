<?php
$data = $db->get_results("SELECT MAX(kode_kriteria) FROM tb_kriteria");
foreach ($data as $key => $value) {
    foreach ($value as $k => $v) {
        $kode = str_replace('C', '', $v);
        $kode++;
    }
}
$kode_otomatis = "C$kode";

?>

<div class="page-header">
    <h1>Tambah Kriteria</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php' ?>
        <form method="post" action="?m=kriteria_tambah">
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" readonly="readonly" name="kode" value="<?=$kode_otomatis?>"/>
            </div>
            <div class="form-group">
                <label>Nama Kriteria<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?=$_POST['nama']?>"/>
            </div>
            <div class="form-group">
                <label>Bobot <span class="text-danger"></span></label>
               <input class="form-control" type="text" name="bobot" value="<?=$_POST['benefit']?>"/>
            </div>
           
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=kriteria"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>