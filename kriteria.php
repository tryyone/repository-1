<div class="page-header">
    <h1>Kriteria</h1>
</div>
<div class="panel panel-warning">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="kriteria" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=kriteria_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
             <div class="form-group">
            <a class="btn btn-default" target="_blank" href="cetak.php?m=kriteria&q=<?=$_GET['q']?>"><span class="glyphicon glyphicon-print"></span> Cetak</a>
        </div>
        </form>
    </div>
    <div class="oxa">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr class="nw">
                <th>Kode Kriteria</th>
                <th>Nama Kriteria</th>
                <th>Bobot</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
         $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT * FROM tb_kriteria 
        WHERE kode_kriteria LIKE '%$q%' OR nama_kriteria LIKE '%$q%' 
        ORDER BY kode_kriteria");
        
        foreach($rows as $row):?>
        <tr>
            
            <td><?=$row->kode_kriteria?></td>
            <td><?=$row->nama_kriteria?></td>
            <td><?=$row->bobot?></td>
            <td class="nw">
                <a class="btn btn-xs btn-warning" href="?m=kriteria_ubah&amp;ID=<?=$row->kode_kriteria?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-xs btn-danger" href="aksi.php?act=kriteria_hapus&amp;ID=<?=$row->kode_kriteria?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php endforeach;
        ?>
        </table>
    </div>
</div>