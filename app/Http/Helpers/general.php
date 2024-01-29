<?php

function formatRupiah($data)
{
   $rupiah = 'Rp ' . number_format($data, 0, ",", ".");
   return $rupiah;
}

function host()
{
   $host = '/var/www/html/dsp-phe/';
   // $srv = $_SERVER['SERVER_NAME'];
   // $port = ":" .  $_SERVER['SERVER_PORT'];
   // $host = 'http://' . $srv . ':' . $port;

   return $host;
}


function enkripRambo($data)
{
   return base64_encode(base64_encode(base64_encode($data)));
}

function dekripRambo($data)
{
   return base64_decode(base64_decode(base64_decode($data)));
}

function getMonthNameIndonesian($monthNumber)
{
   $bulan = [
      1 => 'Januari',
      2 => 'Februari',
      3 => 'Maret',
      4 => 'April',
      5 => 'Mei',
      6 => 'Juni',
      7 => 'Juli',
      8 => 'Agustus',
      9 => 'September',
      10 => 'Oktober',
      11 => 'November',
      12 => 'Desember',
   ];

   return   $bulan[$monthNumber];
}

function dateToMonth($date)
{

   // Ambil dua karakter terakhir dari string tanggal
   $bulan = intval(substr($date, 5, 2));

   $tahun = intval(substr($date, 0, 4));


   return getMonthNameIndonesian($bulan) . ' ' . $tahun;
   // return $bulan;
}

function formatMonthName($data)
{
   $date = \Carbon\Carbon::parse($data)->format('F');
   return $date;
}
