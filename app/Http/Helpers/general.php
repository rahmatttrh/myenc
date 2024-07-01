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

function formatDate($data)
{
   $date = \Carbon\Carbon::parse($data)->format('d/m/Y');
   return $date;
}

function formatDateTime($data)
{
   $date = \Carbon\Carbon::parse($data)->format('d/m/Y H:i');
   return $date;
}






function formatDateB($data)
{
   $date = \Carbon\Carbon::parse($data)->format('d F Y');
   return $date;
}

function formatTime($data)
{
   $date = \Carbon\Carbon::parse($data)->format('H:i');
   return $date;
}

function formatDayDate($data)
{
   $date = \Carbon\Carbon::parse($data)->format('l, d/m/Y');
   return $date;
}

function numberToAlphabet($number)
{
   // Array untuk menyimpan huruf hasil konversi
   $letters = [];

   // Menghitung huruf berdasarkan angka yang diberikan
   while ($number > 0) {
      // Mengurangi 1 dari nomor untuk menangani indeks nol
      $number--;

      // Menentukan huruf berdasarkan nilai saat ini
      $remainder = $number % 26;
      $letters[] = chr($remainder + ord('a'));

      // Mengupdate nomor untuk loop berikutnya
      $number = intdiv($number, 26);
   }

   // Menggabungkan hasil dalam urutan terbalik
   return implode('', array_reverse($letters));
}
