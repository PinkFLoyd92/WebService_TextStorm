<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SentencesController extends Controller
{

    public function index()
    {
        if(Storage::disk('local')->has('data.txt'))
        {
            if (!Storage::disk('local')->has('data_temp.txt'))
                Storage::copy('data.txt', 'data_temp.txt');

            $file = Storage::disk('local')->get('data.txt');
            if(strlen($file) == 0){
                $content_temp = Storage::disk('local')->get('data_temp.txt');
                Storage::put('data.txt', $content_temp);
            }
            $file = Storage::disk('local')->get('data.txt');
            $small = substr($file, 0, 100);
            $file = substr($file,100);
            Storage::put('data.txt', $file);
            return $small;
        }
    }
}
