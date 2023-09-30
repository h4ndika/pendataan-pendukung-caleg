<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class AdminWebController extends Controller
{
    public function index()
    {
        $data = array
		(
			'title' => 'Dashboard'
		);
        return View::make('admin/index', $data);
    }

    public function timses()
    {
        $data = array
		(
			'title' => 'Data Ketua Timses',
            'endpoint' => 'ketuas',
            'form' => [
                ['name'=> 'name', 'label' => ucwords('Name'), 'type' => 'text'],
                ['name'=> 'email', 'label' => ucwords('Email'), 'type' => 'email'],
                ['name'=> 'phone', 'label' => ucwords('Phone'), 'type' => 'number'],
                ['name'=> 'username', 'label' => ucwords('username'), 'type' => 'text'],
                ['name'=> 'password', 'label' => ucwords('password'), 'type' => 'password'],
            ],
            'tables' => [
                ['head' => ucwords('Name'), 'rowdata'=> 'name'],
                ['head' => ucwords('username'), 'rowdata'=> 'username'],
                ['head' => ucwords('email'), 'rowdata'=> 'email'],
                ['head' => ucwords('phone'), 'rowdata'=> 'phone'],
                ['head' => ucwords('action'), 'rowdata'=> 'action'],
            ],
		);

        return View::make('admin/pages', $data);
    }
}
