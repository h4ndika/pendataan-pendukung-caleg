<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Support\Facades\View;

class AnggotaWebController extends Controller
{
    public function index()
    {
        $data = array
		(
			'title' => 'Dashboard'
		);
        return View::make('anggota/index', $data);
    }

    public function wilayah()
    {
        $data = array
		(
			'title' => 'Data Wilayah',
            'endpoint' => 'wilayahs',
            'form' => [
                ['name'=> 'nama_wilayah', 'label' => ucwords('nama wilayah'), 'type' => 'text'],
            ],
            'tables' => [
                ['head' => ucwords('nama wilayah'), 'rowdata'=> 'nama_wilayah'],
                ['head' => ucwords('action'), 'rowdata'=> 'action'],
            ],
		);

        return View::make('anggota/pages', $data);
    }

    public function pendukung()
    {
        $data = array
		(
			'title' => 'Data Pendukung',
            'endpoint' => 'pendukungs',
            'form' => [
                ['name'=> 'wilayah_id', 'label' => ucwords('wilayah'), 'row' => 'wilayahs.id', 'type' => 'select', 'option' => (function(){
                    $option = [];
                    foreach (Wilayah::orderBy('id', 'DESC')->get() as $value) {
                        $option[] = ['value' => $value->id, 'label' => $value->nama_wilayah];
                    }
                    return $option;
                })()],
                ['name'=> 'nama_pendukung', 'label' => ucwords('nama pendukung'), 'type' => 'text'],
                ['name'=> 'phone', 'label' => ucwords('No WA/HP'), 'type' => 'number'],
                ['name'=> 'rt', 'label' => ucwords('rt'), 'type' => 'number'],
                ['name'=> 'rw', 'label' => ucwords('rw'), 'type' => 'number'],
                ['name'=> 'tps', 'label' => ucwords('tps'), 'type' => 'number'],
                ['name'=> 'point', 'label' => ucwords('point'), 'type' => 'number'],
                ['name'=> 'keterangan', 'label' => ucwords('keterangan'), 'type' => 'text'],
            ],
            'tables' => [
                ['head' => ucwords('wilayah'), 'rowdata'=> 'wilayahs.nama_wilayah'],
                ['head' => ucwords('nama pendukung'), 'rowdata'=> 'nama_pendukung'],
                ['head' => ucwords('No WA/HP'), 'rowdata'=> 'phone'],
                ['head' => ucwords('rt'), 'rowdata'=> 'rt'],
                ['head' => ucwords('rw'), 'rowdata'=> 'rw'],
                ['head' => ucwords('tps'), 'rowdata'=> 'tps'],
                ['head' => ucwords('point'), 'rowdata'=> 'point'],
                ['head' => ucwords('keterangan'), 'rowdata'=> 'keterangan'],
                ['head' => ucwords('action'), 'rowdata'=> 'action'],
            ],
		);

        return View::make('anggota/pages', $data);
    }
}
