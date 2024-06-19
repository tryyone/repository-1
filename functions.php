<?php
error_reporting(~E_NOTICE & ~E_DEPRECATED);
session_start();

error_reporting(0); //tambahkan ini
	

include'config.php';
include'includes/ez_sql_core.php';
include'includes/ez_sql_mysqli.php';
$db = new ezSQL_mysqli($config['username'], $config['password'], $config['database_name'], $config['server']);
include'includes/general.php';
    
$mod = $_GET['m'];
$act = $_GET['act'];   
$sid = session_id();

   $rows = $db->get_results("SELECT kode_alternatif, nama_alternatif FROM tb_alternatif ORDER BY kode_alternatif");
    foreach($rows as $row){
    $ALT[$row->kode_alternatif] = $row->nama_alternatif;
} 



$rows = $db->get_results("SELECT kode_kriteria, nama_kriteria, bobot FROM tb_kriteria ORDER BY kode_kriteria");
foreach($rows as $row){
    $KRT[$row->kode_kriteria] = array(
        'nama_kriteria'=>$row->nama_kriteria,
        'bobot'=>$row->bobot
    );
}

function kode_oto($field, $table, $prefix, $length){
    global $db;
    $var = $db->get_var("SELECT $field FROM $table WHERE $field REGEXP '{$prefix}[0-9]{{$length}}' ORDER BY $field DESC");    
    if($var){
        return $prefix . substr( str_repeat('0', $length) . (substr($var, - $length) + 1), - $length );
    } else {
        return $prefix . str_repeat('0', $length - 1) . 1;
    }
}

function set_value($key = null, $default = null){
    global $_POST;
    if(isset($_POST[$key]))
        return $_POST[$key];
        
    if(isset($_GET[$key]))
        return $_GET[$key];
        
    return $default;
}

function spk_rel(){
    global $db;
 
    $rows = $db->get_results("SELECT a.kode_alternatif, k.kode_kriteria, rl.nilai
        FROM tb_alternatif a 
            INNER JOIN tb_relasi rl ON rl.kode_alternatif=a.kode_alternatif
            INNER JOIN tb_kriteria k ON k.kode_kriteria=rl.kode_kriteria
        ORDER BY a.kode_alternatif, k.kode_kriteria");
    $data = array();
    foreach($rows as $row){
        $data[$row->kode_alternatif][$row->kode_kriteria] = $row->nilai;
    }
    return $data;
}


function ratarata(){
    $array = spk_rel();
    $data = array();
    foreach($array as $key => $value){              
        foreach($value as $k => $v){
                $data[$k][$key] = $v * $v;
                
        }
       
    }
    return $data;
}

function normalisasi(){
    $array = ratarata();
    $arr = spk_rel();
    $nilai = array();
    $data = array();

    foreach ($array as $key => $value) {
        $nilai[$key]=sqrt(array_sum($value));
    }
    foreach($arr as $key => $value){                
        foreach($value as $k => $v){
           $data[$key][$k] = $v / $nilai[$k];
        }
    }
    return $data;
}


function nilaiv(){
    global $KRT;
    $array = normalisasi();
    $data = array();
    foreach($array as $key => $value){
        $total=0;
        foreach($value as $k => $v){   
            $data[$key][$k] =  $v * $KRT[$k]['bobot'];
        }        
    }  
    return $data;

}

function concordance(){
    $arr = spk_rel();
    $data = array();
    $array = array();
    $hasil = array();

    foreach ($arr as $key => $value) {
        foreach ($value as $k => $v) {
            $data[$key][$k]=$v;
        }
    }
    foreach ($arr as $key => $value) {
        foreach ($value as $k => $v){
            $array[$key]=$data;

        }
    }
    foreach ($array as $key => $value) {
        foreach ($value as $k => $v) {
           foreach ($v as $ky => $val) {
             if($key != $k){
                   if($data[$key][$ky]>=$val){
                    $hasil[$key][$k][]=$ky;
                   } 
                }else{
                   $hasil[$key][$k]=array(); 
                }

           }
        }
    }
    return $hasil;
    
}

function disordance(){
    $arr = spk_rel();
    $data = array();
    $array = array();
    $hasil = array();

    foreach ($arr as $key => $value) {
        foreach ($value as $k => $v) {
            $data[$key][$k]=$v;
        }
    }
    foreach ($arr as $key => $value) {
        foreach ($value as $k => $v){
            $array[$key]=$data;

        }
    }
    $no = 0;
    $ttl = array();
    foreach ($array as $key => $value) {
        foreach ($value as $k => $v) {
           foreach ($v as $ky => $val) {
             if($key != $k){
                   if($data[$key][$ky]<$val){
                    $hasil[$key][$k][]=$ky;
                   }elseif($data[$key][$ky]>$val){
                            $no++;
                            $ttl[$key][$k]=array();
                            if($no == count($ttl)){
                            $hasil[$key][$k]=array();
                        }
                   }
                }else{
                   $hasil[$key][$k]=array(); 
                }

           }
        }
    }
    return $hasil;
    
   
}

function concordancegalaxy(){
    global $KRT;
    $arr = spk_rel();
    $data = array();
    $array = array();
    $hasil = array();
    foreach ($arr as $key => $value) {

        foreach ($value as $k => $v) {
            $data[$key][$k]=$v;

        }
    }

    foreach ($arr as $key => $value) {
        foreach ($value as $k => $v){
            $array[$key]=$data;

        }
    }
    foreach ($array as $key => $value) {
        foreach ($value as $k => $v) {
           foreach ($v as $ky => $val) {
             if($key != $k){
                   if($data[$key][$ky]>=$val){
                    $hasil[$key][$k][]=$KRT[$ky]['bobot'];
                   } 
                }else{
                   $hasil[$key][$k]=array(); 
                }

           }
        }
    }
    return $hasil;
    
    
}
function disordancegalaxy(){
$array = disordance();
$nilai = nilaiv();
$arr = array();
$new = array();
$hasil=array();
foreach ($array as $key => $val) {
    foreach ($val as $k => $v) {
        $xxx = array(0);
        foreach ($v as $a => $b) {
            $xxx[] = abs($nilai[$key][$b] - $nilai[$k][$b]);
        }
        $arr[$key][$k] = max($xxx);
    }
}
 
foreach ($array as $key => $val) {
    foreach ($val as $k => $v) {
        $xxx = array();
        foreach ($v as $a => $b) {
            $xxx= $nilai[$key];
        }
        $new[$key][$k] = $xxx;
    }
 }
 foreach ($new as $key => $val) {
    foreach ($val as $k => $v) {
        $xxx = array(0);
        foreach ($v as $a => $b) {
           $xxx[]=abs($nilai[$key][$a]-$nilai[$k][$a]);
             
        }
        if($arr[$key][$k]!=0){
        $hasil[$key][$k]=(($arr[$key][$k])/(max($xxx)));
        }else{
            
         $hasil[$key][$k]=0;
        }
   }
 }
return $hasil;

}
$nilaicon = nilaitresholdconcor();
$nilaidis = nilaitresholddisor();

function nilaitresholdconcor(){

    $array = concordancegalaxy();
    $jumlah = array();
    $total = array();
    $hasil = array();
    foreach ($array as $key => $value) {
        $nilai = array(0);
        foreach ($value as $k => $v) {
            $nilai[]=array_sum($v);
        }
         $jumlah[]=array_sum($nilai);
         $total[]=$key;
    }

    $hasil= array_sum($jumlah)/(count($total)*(count($total)-1));
    return $hasil;
}

function nilaitresholddisor(){

    $array = disordancegalaxy();
    $jumlah = array();
    $total = array();
    $hasil = array();
    foreach ($array as $key => $value) {
        $jumlah[] = array_sum($value);
        $total[]=$key;
      }
      $hasil= array_sum($jumlah)/(count($total)*(count($total)-1));
      return $hasil;
}

function matriksdominanconcor(){
    global $nilaicon;

    $array = concordancegalaxy();
    $hasil = array();

    foreach ($array as $key => $value) {
        foreach ($value as $k => $v) {
           if(array_sum($v)>=$nilaicon){
            $hasil[$key][$k]=1;
           }else{
            $hasil[$key][$k]=0;
           }
        }
    }
    return $hasil;

}

function matriksdominandisor(){
    global $nilaidis;

    $array = disordancegalaxy();
    $hasil = array();

    foreach ($array as $key => $value) {
        foreach ($value as $k => $v) {
           if($v>=$nilaidis){
            $hasil[$key][$k]=1;
           }else{
            $hasil[$key][$k]=0;
           }
        }
    }
    return $hasil;

}
function agragratematriks(){
    $arr = matriksdominanconcor();
    $nilai = matriksdominandisor();
    $hasil = array();

    foreach ($arr as $key => $value) {
        foreach ($value as $k => $v) {
            $hasil[$key][$k]=$v * $nilai[$key][$k];
        }
    }
    return $hasil;

    echo print_r("<prev>".$hasil."</prev>");
    
}

function get_rank($array){
    $data = $array;
    arsort($data);
    $no=1;
    $new = array();
    foreach($data as $key => $value){
        $new[$key] = $no++;
    }
    return $new;
}
