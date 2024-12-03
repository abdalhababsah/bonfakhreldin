<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
   public function aboutUs(){
    return view('pages.aboutus');
   }
   public function branches(){
    return view('pages.branches');
   }
   public function products(){
    return view('pages.products');
   }
}
