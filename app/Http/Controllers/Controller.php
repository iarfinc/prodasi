<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $defaultUploadFileDir = 'uploads';

    public function __construct(){
        if(!is_dir($this->defaultUploadFileDir)) mkdir($this->defaultUploadFileDir);
    }
    public function getPageData(){
        if (auth()->check() && auth()->user()->role == 'Admin') {
            $data = [];
            $data['page_name'] = 'Dashboard';
            $data['page_subname'] = 'Grafik Data Fakultas Design';
            $data['page_breadcum'] = [['name' => 'Dashboard','link' => route('dashboard'),'status' => '']];
            return $data;
        }
    
        if (auth()->check() && auth()->user()->role == 'User') {
            $data = [];
            $data['page_name'] = 'Dashboard';
            $data['page_subname'] = 'Status';
            $data['page_breadcum'] = [['name' => 'Dashboard','link' => route('dashboard'),'status' => '']];
            return $data;
        }
            
        return [
            'page_name' => 'Project Data Sains',
            'page_subname' => 'Selamat datang di PSD.',
            'page_breadcum' => [],
        ];
    }

    public function RolesAllowed($roles = []){
        if(count($roles) < 0 ){
            return;
        }
        if(!Auth::check()){
            return;
        }
        if(!in_array(auth()->user()->role,$roles)){
            abort(404,"Page Not Found");
        }
    }

}
