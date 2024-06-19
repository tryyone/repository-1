<?php
$row = $db->get_row("SELECT * FROM tb_alternatif WHERE kode_alternatif='$_GET[ID]'");
?>
<div class="page-header">
    <h1>Input nilai bobot &raquo; <small><?= $row->nama_alternatif ?></small></h1>
</div>
<div class="row">
    <div class="col-sm-4">
        <form method="post" action="aksi.php?act=rel_alternatif_ubah&ID=<?= $row->kode_alternatif ?>">
            <input class="form-control" type="hidden" name="kode_alternatif" value="<?= $row->kode_alternatif ?>">
            <?php
            $rows = $db->get_results("SELECT * FROM tb_kriteria");
            foreach ($rows as $row) : ?>
            <div class="form-group">
                <div class="page-header text-warning">
                    <h4 class="text-danger"><strong> <?= $row->nama_kriteria ?> </strong></h4>
                </div>
                <?php
                    $sub = $db->get_results("SELECT * FROM tb_subkriteria WHERE kode_kriteria= '$row->kode_kriteria' ORDER BY kode_kriteria ");
                    foreach ($sub as $subs) {
                        ?>
                <label><?= $subs->nama_sub ?></label>
                <input class="form-control" min="1" max="4" type="text" name="<?= $subs->kode_sub ?>" placeholder="<?= $subs->kode_sub ?>">
                <?php } ?>
            </div>
            <?php
            endforeach ?>
            <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
            <a class="btn btn-danger" href="?m=rel_alternatif"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
        </form>
    </div>
</div>