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
