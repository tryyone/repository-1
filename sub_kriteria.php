<div class="page-header">
    <h1>sub_Kriteria</h1>
</div>
<div class="panel panel-info">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="sub_kriteria" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=sub_kriteria_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
             <div class="form-group">
            <a class="btn btn-default" target="_blank" href="cetak.php?m=sub_kriteria&q=<?=$_GET['q']?>"><span class="glyphicon glyphicon-print"></span> Cetak</a>
        </div>
        </form>
    </div>
    <div class="oxa">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr class="nw">
                <th>Kode Sub Kriteria</th>
                <th>Nama Kriteria</th>
                <th>Nama Sub Kriteria</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
         $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT * FROM tb_subkriteria JOIN tb_kriteria ON (tb_kriteria.kode_kriteria= tb_subkriteria.kode_kriteria) 
        ORDER BY id_sub");
        
        foreach($rows as $row):?>
        <tr>
            
            <td><?=$row->kode_sub?></td>         
            <td><?=$row->nama_kriteria?></td>
            <td><?=$row->nama_sub?></td>
            <td class="nw">
                <a class="btn btn-xs btn-warning" href="?m=sub_kriteria_ubah&amp;ID=<?=$row->id_sub?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-xs btn-danger" href="aksi.php?m=sub_kriteria_hapus&amp;ID=<?=$row->id_sub?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php endforeach;
        ?>
        </table>
    </div>
</div>