<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class CollectionController extends Controller
{
    protected $myArray = [['John', 35], ['Jane', 33]];


    public function index()
    {
        $collection = collect($this->myArray);
       $msg =  $collection->eachSpread(function($name,$age){
               echo "Your name is $name and you are $age years old";
        });
        return "done";
    }

}
