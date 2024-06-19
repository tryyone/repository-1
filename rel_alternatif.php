<div class="page-header">
    <h1>Nilai Bobot Alternatif</h1>
</div>
<div class="panel panel-info">
<div class="panel-heading">
<form class="form-inline">
    <input type="hidden" name="m" value="rel_alternatif" />
    <div class="form-group">
        <input class="form-control" type="text" name="q" value="<?=$_GET['q']?>" placeholder="Pencarian..." />
    </div>
    <div class="form-group">
        <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
    </div>
</form>
</div>
<table class="table table-bordered table-hover table-striped">
<thead>
    <tr>
        <th>Kode</th>
        <th>Nama Alternatif</th>
        <?php
        $aa = $db->get_var("SELECT COUNT(*) FROM tb_kriteria");
        if($aa>0):
        for($a = 1; $a<=$aa; $a++){
            echo "<th>C$a</th>";
        }
        endif;  
        ?>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
<?php

$rows = $db->get_results("SELECT
        	a.kode_alternatif, a.nama_alternatif,ra.nilai
        FROM tb_relasi ra 
        	INNER JOIN tb_alternatif a ON a.kode_alternatif = ra.kode_alternatif
        WHERE  nama_alternatif LIKE '%".esc_field($_GET['q'])."%' ORDER BY kode_alternatif, ra.kode_kriteria;", ARRAY_A);
$data = array();        
foreach($rows as $row){
    $data[$row['nama_alternatif']][]  = $row;
}
$no=0;

foreach($data as $key => $value):?>
<tr>
    <td>A<?=++$no ?></td>
    <td><?=$key;?></td>
    <?php  
    $q=0;
        foreach($value as $dt){
            echo "<td>$dt[nilai]</td>";   
            if ($dt['nilai']== null) {
                $q=1;
                        }            
        }

    if ($q == 0) {
    ?>
    <td>
        <a class="btn btn-xs btn-warning" href="?m=rel_alternatif_ubah1&ID=<?=$value[0]['kode_alternatif']?>"><span class="glyphicon glyphicon-edit"></span> Ubah</a>        
    </td>
    <?php } 
        else { ?>
    <td>
        <a class="btn btn-xs btn-info" href="?m=rel_alternatif_ubah&ID=<?=$value[0]['kode_alternatif']?>"><span class="glyphicon glyphicon-edit"></span> input</a>        
    </td>
<?php } ?>
</tr>
<?php endforeach;
?>
</tbody>
</table>
</div>