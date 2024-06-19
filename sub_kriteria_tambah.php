<?php
$data = $db->get_results("SELECT MAX(id_sub) FROM tb_subkriteria");
foreach ($data as $key => $value) {
    foreach ($value as $k => $v) {
        $kode = str_replace('C', '', $v);
        $kode++;
    }
}
$kode_otomatis = "$kode";

?>

<div class="page-header">
    <h1>Tambah Sub Kriteria</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php' ?>
        <form method="post" action="?m=sub_kriteria_tambah">
             <div class="form-group">
                <!-- <label>Kode <span class="text-danger">*</span></label> -->
                <input class="form-control" type="hidden" readonly="readonly" name="kode" value="<?=$kode_otomatis?>"/>
            </div> 
             <div class="form-group">
                <label>Nama Kriteria<span class="text-danger">*</span></label>
        <?php  
            $rows = $db->get_results("SELECT * FROM tb_kriteria  
            ORDER BY kode_kriteria"); ?>
             <select name="kode_kriteria" class="form-control" >      
        <?php        foreach($rows as $row): 
        ?>
                <option value="<?=$row->kode_kriteria?>"><?=$row->nama_kriteria?></option>
            

        <?php        endforeach;

        ?>
            </select>

                
            </div>
            <div class="form-group">
                <label>Nama Sub Kriteria<span class="text-danger"></span></label>
               <!--  <input class="form-control" type="text" name="nama_sub" value="<?=$_POST['nama_sub']?>"/> -->
                <textarea name="nama_sub" class="form-control" value="<?=$_POST['nama_sub']?>"></textarea>
            </div>
           
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=sub_kriteria"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>