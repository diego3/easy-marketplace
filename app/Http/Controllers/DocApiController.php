<?php

namespace App\Http\Controllers;


class DocApiController extends Controller
{

    public function developers(){

        echo file_get_contents('/application/resources/index-doc.html');
    }

}