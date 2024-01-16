<?php

  include ('plugin/phpqrcode/qrlib.php');

  #produksi
  $folderqrcode = 'barcode/';
  $tempdir      = $folderqrcode;

  if (!file_exists($tempdir)) //Buat folder bername temp
  mkdir($tempdir);

  //ambil logo untuk posisi di tengah
  $logopath     = 'contohlogotengah.png';
  
  //nilai yang akan di generate pada qrcode
  $isi          = 'lab/all'; 
  $codeContents = 'https://www.kokitindo.com/'.$isi;

  // menyimpan file qrcode dengan nama file yang kita buat
  QRcode::png($codeContents, $tempdir.'testing1.png', QR_ECLEVEL_H, 10,4);

  // mengambil file qrcode yang telah behasil kita buat
  $QR = imagecreatefrompng($tempdir.'testing1.png');

 // memulai menggambar logo dalam file qrcode
  $logo = imagecreatefromstring(file_get_contents($logopath));

  imagecolortransparent($logo , imagecolorallocatealpha($logo , 0, 0, 0, 127));
  imagealphablending($logo , false);
  imagesavealpha($logo , true);

  $QR_width = imagesx($QR);
  $QR_height = imagesy($QR);

  $logo_width = imagesx($logo);
  $logo_height = imagesy($logo);

 // Scale logo to fit in the QR Code
  $logo_qr_width = $QR_width/8;
  $scale = $logo_width/$logo_qr_width;
  $logo_qr_height = $logo_height/$scale;

  imagecopyresampled($QR, $logo, $QR_width/2.3, $QR_height/2.3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

 // Simpan kode QR lagi, dengan logo di atasnya
  imagepng($QR,$tempdir.'testing1.png');

  ?>