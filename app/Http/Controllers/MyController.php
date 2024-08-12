<?php

namespace App\Http\Controllers;

use App\Mail\QpeSubmitEmail;
use App\Models\SubDept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MyController extends Controller
{
   public function updatePosition(){
      $subdept = SubDept::find(9);
      dd($subdept->name);
   }

   public function testEmail(){
      $data = [
         'to' => 'Rahmat H',
         'from' => 'MyENC',
         'subject' => 'Testing Email',
         'body' => 'This is body of email',
         'schedule' => 'test',
         'activities' => [],
         'link' => 'test'
      ];
      Mail::to("rahmattrust@gmail.com")->send(new QpeSubmitEmail($data));
   }
}
