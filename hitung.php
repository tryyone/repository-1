<?php
    $row = $db->get_results("SELECT nilai FROM tb_relasi where nilai is null ");
    if (!$ALT || !$KRT):
        echo "Tampaknya anda belum mengatur alternatif dan kriteria. Silahkan tambahkan minimal 3 alternatif dan 3 kriteria.";
    elseif ($row):
        echo "Tampaknya anda belum mengatur nilai alternatif. Silahkan atur pada menu <strong>Nilai Alternatif</strong>.";
    else:
?>
<div class="page-header">
    <h2>Perhitungan</h2>
</div>

<div class="panel panel-danger">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" href="#c1" aria-expanded="true" aria-controls="c1">
                Matriks X (Data Nilai)
            </a>
        </h4>
    </div>
    <div class="table-responsive" id="c1"> 
        <table class="table table-bordered table-striped table-hover"> 
        <thead>
            <tr>
            <th></th>
            <?php    
            $data = spk_rel(); 
            $ratarata = ratarata();
            foreach(current($data) as $key => $value):?>
            <th><?=$KRT[$key]['nama_kriteria']?></th>
            <?php endforeach;?> 
            </tr>     
        </thead>
        <?php foreach($data as $key => $value):?>
        <tr>
            <th><?=$ALT[$key]?></th>
            <?php foreach($value as $k => $v):?>
            <td><?=$v?></td>
            <?php endforeach;?>
        </tr>
        <?php endforeach;?>
        <tr>
        <th></th>
        <?php  foreach($ratarata as $key => $value):?>
        <td><?=round(sqrt(array_sum($value)),4)?></td>     
        <?php endforeach;?>
        </tr>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" href="#c2" aria-expanded="false" aria-controls="c2">
                Matriks R (Normalisasi)
            </a>
        </h4>
    </div>
    <div class="table-responsive collapse" id="c2"> 
        <table class="table table-bordered table-striped table-hover">
       <thead>
            <tr>
            <th></th>
            <?php    
            $data = normalisasi(); 
            foreach(current($data) as $key => $value):?>
            <th><?=$KRT[$key]['nama_kriteria']?></th>
            <?php endforeach;?> 
            </tr>     
        </thead>
        <?php foreach($data as $key => $value):?>
        <tr>
            <th><?=$ALT[$key]?></th>
            <?php foreach($value as $k => $v):?>
            <td><?=round($v,4)?></td>
            <?php endforeach;?>
        </tr>
        <?php endforeach;?>
        </table>
        </div>
    </div>

    <div class="panel panel-info">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" href="#c3" aria-expanded="false" aria-controls="c3">
                Matriks V (Normalisasi Terbobot)
            </a>
        </h4>
    </div>
    <div class="table-responsive collapse" id="c3"> 
        <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
            <th></th>
            <?php    
            $data = nilaiv(); 
            foreach(current($data) as $key => $value):?>
            <th><?=$KRT[$key]['nama_kriteria']?></th>
            <?php endforeach;?> 
            </tr>     
        </thead>
        <?php foreach($data as $key => $value):?>
        <tr>
            <th><?=$ALT[$key]?></th>
            <?php foreach($value as $k => $v):?>
            <td><?=round($v,4)?></td>
            <?php endforeach;?>
        </tr>
        <?php endforeach;?>
        </table>
        </div>
    </div>

    <div class="panel panel-warning">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" href="#c4" aria-expanded="false" aria-controls="c4">
                Concordance
            </a>
        </h4>
    </div>
    <div class="table-responsive collapse" id="c4"> 
        <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
            <th></th>
            <?php    
            $data = concordance(); 
            foreach($data as $key => $value):?>
            <th><?=$ALT[$key]?></th>
            <?php endforeach;?> 
            </tr>     
        </thead>
        <?php foreach($data as $key => $value):?>
        <tr>
            <th><?=$ALT[$key]?></th>
            <?php foreach($value as $k => $v):?>
            <td><?=implode(", ",$v)?></td>
            <?php endforeach;?>
        </tr>
        <?php endforeach;?>
        </table>
        </div>
    </div>

    <div class="panel panel-danger">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" href="#c5" aria-expanded="false" aria-controls="c5">
                Disordance
            </a>
        </h4>
    </div>
    <div class="table-responsive collapse" id="c5"> 
        <table class="table table-bordered table-striped table-hover">
       <thead>
            <tr>
            <th></th>
            <?php    
            $data = disordance(); 
            foreach($data as $key => $value):?>
            <th><?=$ALT[$key]?></th>
            <?php endforeach;?> 
            </tr>     
        </thead>
        <?php foreach($data as $key => $value):?>
        <tr>
            <th><?=$ALT[$key]?></th>
            <?php foreach($value as $k => $v):?>
            <td><?=implode(", ",$v)?></td>
            <?php endforeach;?>
        </tr>
        <?php endforeach;?>
        </table>
        </div>
    </div>

 <div class="panel panel-info">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" href="#c6" aria-expanded="false" aria-controls="c6">
                Concordance Galaxy
            </a>
        </h4>
    </div>
    <div class="table-responsive collapse" id="c6">  
        <table class="table table-bordered table-striped table-hover">
         <thead>
            <tr>
            <th></th>
            <?php    
            $data = concordancegalaxy(); 
            foreach($data as $key => $value):?>
            <th><?=$ALT[$key]?></th>
            <?php endforeach;?> 
            </tr>     
        </thead>
        <?php foreach($data as $key => $value):?>
        <tr>
            <th><?=$ALT[$key]?></th>
            <?php foreach($value as $k => $v):?>
            <td><?=array_sum($v)?></td>
            <?php endforeach;?>
        </tr>
        <?php endforeach;?>
        </table>
        </div>
    </div>
    <div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" href="#c7" aria-expanded="false" aria-controls="c7">
                Disordance Galaxy
            </a>
        </h4>
    </div>
    <div class="table-responsive collapse" id="c7">  
        <table class="table table-bordered table-striped table-hover">
         <thead>
            <tr>
            <th></th>
            <?php    
            $data = disordancegalaxy(); 
            foreach($data as $key => $value):?>
            <th><?=$ALT[$key]?></th>
            <?php endforeach;?> 
            </tr>     
        </thead>
        <?php foreach($data as $key => $value):?>
        <tr>
            <th><?=$ALT[$key]?></th>
            <?php foreach($value as $k => $v):?>
            <td><?=round($v,4)?></td>
            <?php endforeach;?>
        </tr>
        <?php endforeach;?>
        </table>
        </div>
    </div>
    <div class="panel panel-warning">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" href="#c8" aria-expanded="false" aria-controls="c8">
                Matriks Dominan Concordance
            </a>
        </h4>
    </div>
    <div class="table-responsive collapse" id="c8"> 
        <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
            <th></th>
            <?php    
            $data = matriksdominanconcor(); 
            foreach($data as $key => $value):?>
            <th><?=$ALT[$key]?></th>
            <?php endforeach;?> 
            </tr>     
        </thead>
        <?php foreach($data as $key => $value):?>
        <tr>
            <th><?=$ALT[$key]?></th>
            <?php foreach($value as $k => $v):?>
            <td><?=$v?></td>
            <?php endforeach;?>
        </tr>
        <?php endforeach;?>
        </table>
        </div>
    </div>
     <div class="panel panel-danger">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" href="#c9" aria-expanded="false" aria-controls="c9">
                Matriks Dominan Concordance
            </a>
        </h4>
    </div>
    <div class="table-responsive collapse" id="c9"> 
        <table class="table table-bordered table-striped table-hover">
         <thead>
            <tr>
            <th></th>
            <?php    
            $data = matriksdominandisor(); 
            foreach($data as $key => $value):?>
            <th><?=$ALT[$key]?></th>
            <?php endforeach;?> 
            </tr>     
        </thead>
        <?php foreach($data as $key => $value):?>
        <tr>
            <th><?=$ALT[$key]?></th>
            <?php foreach($value as $k => $v):?>
            <td><?=$v?></td>
            <?php endforeach;?>
        </tr>
        <?php endforeach;?>
        </table>
        </div>
    </div>
     <div class="panel panel-info">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" href="#c10" aria-expanded="true" aria-controls="c10">
                Agregate Dominance Matrix E
            </a>
        </h4>
    </div>
    <div class="table-responsive" id="c10"> 
        <table class="table table-bordered table-striped table-hover">
         <thead>
            <tr>
            <th></th>
            <?php    

            $data = agragratematriks(); 
            $rank = get_rank(agragratematriks());
            foreach($data as $key => $value):?>
            <th><?=$ALT[$key]?></th>
            <?php endforeach;?> 
            <th>Rank</th>
            </tr>     
        </thead>
        <?php foreach($data as $key => $value):?>
        <tr>
            <th><?=$ALT[$key]?></th>
            <?php foreach($value as $k => $v):?>
            <td><?= $v?></td>
            <?php endforeach;?>
             <td><?=$rank[$key]?></td>
        </tr>
        
     <?php endforeach;?>
        </table>
        </div>
         <div class="panel-body">
            <a class="btn btn-default" target="_blank" href="cetak.php?m=hitung"><span class="glyphicon glyphicon-print"></span> Cetak</a>
        </div> 
    </div>
<?php endif; ?>