<?php

namespace App\Http\Controllers;
use App\Models\HomeSliderModel;
use App\Models\AboutModel;
use App\Models\Our_ServicesModel;
use App\Models\BlogModel;
use App\Models\TestimonialModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function Home(){
     return view('index');
    }
}
