<?php
    $id = stripslashes(strip_tags(htmlspecialchars($_GET['ID'],ENT_QUOTES)));
    $row = $db->get_row("SELECT * FROM tb_subkriteria WHERE id_sub='".$id."'"); 
?>
<div class="page-header">
    <h1>Ubah Sub Kriteria</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include 'aksi.php' ?>
        <form method="post" action="?m=sub_kriteria_ubah&amp;ID=<?=$row->id_sub?>">
           <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" readonly="readonly" name="kode" value="<?=$row->kode_sub?>"/>
            </div>
             <div class="form-group">
                <label>Nama Kriteria<span class="text-danger">*</span></label>
        <?php  
            $rows = $db->get_results("SELECT * FROM tb_kriteria  
            ORDER BY kode_kriteria"); ?>
             <select name="kode_kriteria" class="form-control" >      
        <?php        
            foreach($rows as $kriteria): 
                if ($kriteria->kode_kriteria == $row->kode_kriteria) {
        ?> 
                <option selected="selected" value="<?=$kriteria->kode_kriteria?>"><?=$kriteria->nama_kriteria?></option>     
        <?php
                }
                else  { ?>
                <option  value="<?=$kriteria->kode_kriteria?>"><?=$kriteria->nama_kriteria?></option> 
         <?php               
                        }        
            endforeach;
        ?>
            </select>

                
            </div>
            <div class="form-group">
                <label>Nama Kriteria<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_sub" value="<?=$row->nama_sub?>"/>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=sub_kriteria"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>