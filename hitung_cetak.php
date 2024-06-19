<h1>Perhitungan</h1>

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
            <td><?=$v?></td>
            <?php endforeach;?>
             <td><?=$rank[$key]?></td>
        </tr>
        
     <?php endforeach;?>
</table>      