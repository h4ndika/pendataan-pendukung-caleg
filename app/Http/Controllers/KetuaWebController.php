<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Support\Facades\View;

class KetuaWebController extends Controller
{
    public function index()
    {
        $data = array
		(
			'title' => 'Dashboard'
		);
        return View::make('ketua/index', $data);
    }

    public function anggota()
    {
        $data = array
		(
			'title' => 'Data Anggota',
            'endpoint' => 'anggotas',
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

        return View::make('ketua/pages', $data);
    }

    public function pendukung()
    {
        $data = array
		(
			'title' => 'Data Pendukung',
            'endpoint' => 'pendukungs',
            'form' => [],
            'tables' => [
                ['head' => ucwords('anggota'), 'rowdata'=> 'anggota.name'],
                ['head' => ucwords('wilayah'), 'rowdata'=> 'wilayahs.nama_wilayah'],
                ['head' => ucwords('nama pendukung'), 'rowdata'=> 'nama_pendukung'],
                ['head' => ucwords('No WA/HP'), 'rowdata'=> 'phone'],
                ['head' => ucwords('rt'), 'rowdata'=> 'rt'],
                ['head' => ucwords('rw'), 'rowdata'=> 'rw'],
                ['head' => ucwords('tps'), 'rowdata'=> 'tps'],
                ['head' => ucwords('point'), 'rowdata'=> 'point'],
                ['head' => ucwords('keterangan'), 'rowdata'=> 'keterangan'],
            ],
		);

        return View::make('ketua/pages', $data);
    }
}
