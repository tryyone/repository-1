<?php
require_once'functions.php';
 
/**LOGIN */ 
if ($act=='login'){
    $user = esc_field($_POST['user']);
    $pass = esc_field($_POST['pass']);
    
    $row = $db->get_row("SELECT * FROM tb_admin WHERE user='$user' AND pass='$pass'");
    if($row){
        $_SESSION['login'] = $row->user;

        redirect_js("index.php");
    } else{
        print_msg("Salah kombinasi username dan password.");
    }          
}
/**PASSWORD */
else if ($mod=='password'){
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $pass3 = $_POST['pass3'];
    
    $row = $db->get_row("SELECT * FROM tb_user WHERE user='$_SESSION[login]' AND pass='$pass1'");        
     
    if($pass1=='' || $pass2=='' || $pass3=='')
        print_msg('Field bertanda * harus diisi.');
    elseif(!$row)
        print_msg('Password lama salah.');
    elseif( $pass2 != $pass3 )
        print_msg('Password baru dan konfirmasi password baru tidak sama.');
    else{        
        $db->query("UPDATE tb_user SET pass='$pass2' WHERE user='$_SESSION[login]'");                    
        print_msg('Password berhasil diubah.', 'success');
    }
} elseif($act=='logout'){
    unset($_SESSION['login']);
    header("location:login.php");
}elseif($act=='logout'){
    unset($_SESSION['login']);
    header("location:login.php");
}
/** ALTERNATIF */    
if($mod=='alternatif_tambah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    
    if($kode=='' || $nama=='' )
        print_msg("Field bertanda * tidak boleh kosong!");
        
   elseif($db->get_results("SELECT * FROM tb_alternatif WHERE kode_alternatif='$kode'"))
        print_msg("Kode sudah ada!");
    else{
        $db->query("INSERT INTO tb_alternatif (kode_alternatif, nama_alternatif) VALUES ('$kode', '$nama')");
        $db->query("INSERT INTO tb_relasi(kode_alternatif, kode_kriteria) SELECT '$kode', kode_kriteria FROM tb_kriteria");
        redirect_js("index.php?m=alternatif");
    }                    
} else if($mod=='alternatif_ubah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    
    if($kode=='' || $nama=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    else{
        $db->query("UPDATE tb_alternatif SET nama_alternatif='$nama' WHERE kode_alternatif='$_GET[ID]'");
        redirect_js("index.php?m=alternatif");
    }    
} else if ($act=='alternatif_hapus'){
    $db->query("DELETE FROM tb_alternatif WHERE kode_alternatif='$_GET[ID]'");
     $db->query("DELETE FROM tb_relasi WHERE kode_alternatif='$_GET[ID]'");
    header("location:index.php?m=alternatif");
} 
    
/** KRITERIA */    
if($mod=='kriteria_tambah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $bobot = $_POST['bobot'];
    $atribut = $_POST['atribut'];
    
    if($nama=='' || $atribut==''||$bobot=='')
        print_msg("Field bertanda * tidak boleh kosong!");
        
   elseif($db->get_results("SELECT * FROM tb_kriteria WHERE kode_kriteria='$kode'"))
        print_msg("Kode sudah ada!");
    
    else{
        $db->query("INSERT INTO tb_kriteria (kode_kriteria, nama_kriteria, atribut, bobot) VALUES ('$kode', '$nama', '$atribut', '$bobot')"); 
          $db->query("INSERT INTO tb_relasi(kode_alternatif, kode_kriteria, nilai) SELECT kode_alternatif, '$kode', 0  FROM tb_alternatif");           
        redirect_js("index.php?m=kriteria");
    }                    
} else if($mod=='kriteria_ubah'){
    $nama = $_POST['nama'];
    $atribut = $_POST['atribut'];
    $bobot = $_POST['bobot'];
    
    if($nama==''||$bobot=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    else{
        $db->query("UPDATE tb_kriteria SET nama_kriteria='$nama', atribut='$atribut', bobot='$bobot' WHERE kode_kriteria='$_GET[ID]'");
        redirect_js("index.php?m=kriteria");
    }    
} else if ($act=='kriteria_hapus'){
    $db->query("DELETE FROM tb_kriteria WHERE kode_kriteria='$_GET[ID]'");
    $db->query("DELETE FROM tb_relasi WHERE kode_kriteria='$_GET[ID]'");
    header("location:index.php?m=kriteria");
} 
/** RELASI ALTERNATIF */ 
else if ($act=='rel_alternatif_ubah'){
            $kode_alternatif = $_POST['kode_alternatif'];
    $rows = $db->get_results("SELECT * from tb_subkriteria");
        foreach($rows as $row){
            $nilai = $_POST[$row->kode_sub];
            $kode_kriteria = $row->kode_kriteria;
            $kode_sub = $row->kode_sub;
          $db->query("INSERT INTO tb_nilai (kode_kriteria, nilai, kode_sub, kode_alternatif) VALUES ('$kode_kriteria', '$nilai', '$kode_sub', '$kode_alternatif')"); 
        }

    $kriteria = $db->get_results("SELECT * from tb_kriteria");
        foreach ($kriteria as $kri) {
            $rata= $db->get_row("SELECT AVG(nilai) as rata FROM tb_nilai WHERE kode_kriteria='$kri->kode_kriteria' AND kode_alternatif= '$kode_alternatif'");
            $kit=$rata+2;
            $hasil=number_format($rata->rata, 2);
 
          $db->query("UPDATE tb_relasi SET nilai='$hasil' WHERE kode_alternatif='$kode_alternatif' AND kode_kriteria= '$kri->kode_kriteria'");
        }

     header("location:index.php?m=rel_alternatif");
}
else if ($act=='rel_alternatif_ubah1'){
            $kode_alternatif = $_POST['kode_alternatif'];
    $rows = $db->get_results("SELECT * from tb_subkriteria");
        foreach($rows as $row){
            $nilai = $_POST[$row->kode_sub];
            $kode_kriteria = $row->kode_kriteria;
            $id_nilai =$_POST["N".$row->kode_sub];
            $kode_sub = $row->kode_sub;
          $db->query("UPDATE tb_nilai set nilai='$nilai' WHERE id_nilai='$id_nilai'"); 
          var_dump($id_nilai);
        }

    $kriteria = $db->get_results("SELECT * from tb_kriteria");
        foreach ($kriteria as $kri) {
            $rata= $db->get_row("SELECT AVG(nilai) as rata FROM tb_nilai WHERE kode_kriteria='$kri->kode_kriteria' AND kode_alternatif= '$kode_alternatif'");
            $kit=$rata+2;
            $hasil=number_format($rata->rata, 2);
 
          $db->query("UPDATE tb_relasi SET nilai='$hasil' WHERE kode_alternatif='$kode_alternatif' AND kode_kriteria= '$kri->kode_kriteria'");
        }

     header("location:index.php?m=rel_alternatif");
}
// Sub Kriteria
 if ($mod=='sub_kriteria_hapus'){
    $db->query("DELETE FROM tb_subkriteria WHERE id_sub='$_GET[ID]'");
    header("location:index.php?m=sub_kriteria");

}
if($mod=='sub_kriteria_tambah'){
    $kode_kriteria = $_POST['kode_kriteria'];
    $nama_sub = $_POST['nama_sub'];
    $kode_sub = $_POST['kode'].$_POST['kode_kriteria'];
   
    
    if( $nama_sub=='' )
        print_msg("Field bertanda * tidak boleh kosong!");
           
    else{
        $db->query("INSERT INTO tb_subkriteria (kode_kriteria, nama_sub, kode_sub) VALUES ('$kode_kriteria', '$nama_sub', '$kode_sub')"); 

    }       
        redirect_js("index.php?m=sub_kriteria");
    }
    else if($mod=='sub_kriteria_ubah'){
    $kode_kriteria = $_POST['kode_kriteria'];
    $nama_sub = $_POST['nama_sub'];
  //  $kode = $_POST['kode'];
    
        $db->query("UPDATE tb_subkriteria SET nama_sub='$nama_sub', kode_kriteria='$kode_kriteria'  WHERE id_sub ='$_GET[ID]'");
        redirect_js("index.php?m=sub_kriteria");
    }  