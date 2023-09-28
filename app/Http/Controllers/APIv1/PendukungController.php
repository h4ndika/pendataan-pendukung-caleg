<?php

namespace App\Http\Controllers\APIv1;

use App\Models\Pendukung;
use App\Http\Resources\PendukungResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PendukungController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:anggota-api')->only('store','update','destroy');
        $this->middleware('auth:admin-api,ketua-api,anggota-api')->only('index','show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = $request->query('paginate', 15);

        $data = QueryBuilder::for(Pendukung::class)
            ->allowedFilters([
                AllowedFilter::partial('nama_pendukung'),
                AllowedFilter::partial('phone'),
                AllowedFilter::partial('rt'),
                AllowedFilter::partial('rw'),
                AllowedFilter::partial('tps'),
                AllowedFilter::partial('point'),
                AllowedFilter::partial('keterangan'),
                AllowedFilter::exact('wilayah_id'),
            ])->orderBy('id', 'DESC');

        return PendukungResource::collection($data->paginate(min($paginate, 50)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'wilayah_id' => 'required|exists:wilayahs,id',
            'nama_pendukung' => 'required|string',
            'phone' => 'numeric|nullable',
            'rt' => 'numeric|nullable',
            'rw' => 'numeric|nullable',
            'tps' => 'numeric|nullable',
            'point' => 'string|nullable',
            'keterangan' => 'string|nullable',
        ]);

        return (new PendukungResource(Pendukung::create($data)))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pendukung $Pendukung
     * @return \Illuminate\Http\Response
     */
    public function show(Pendukung $Pendukung)
    {
        return new PendukungResource($Pendukung);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Pendukung $Pendukung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pendukung $Pendukung)
    {
        $data = $request->validate([
            'wilayah_id' => 'exists:wilayahs,id',
            'nama_pendukung' => 'string',
            'phone' => 'numeric|nullable',
            'rt' => 'numeric|nullable',
            'rw' => 'numeric|nullable',
            'tps' => 'numeric|nullable',
            'point' => 'string|nullable',
            'keterangan' => 'string|nullable',
        ]);

        return response()->json([
            'updated' => $Pendukung->update($data),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pendukung $Pendukung
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendukung $Pendukung)
    {
        return response()->json([
            'deleted' => $Pendukung->delete(),
        ]);
    }
}
