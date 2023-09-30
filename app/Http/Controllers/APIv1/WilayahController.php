<?php

namespace App\Http\Controllers\APIv1;

use App\Models\Anggota;
use App\Models\Wilayah;
use App\Http\Resources\WilayahResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class WilayahController extends Controller
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

        $data = QueryBuilder::for(Wilayah::class)
            ->allowedFilters([
                AllowedFilter::partial('nama_wilayah'),
                AllowedFilter::exact('anggota_id'),
            ])->orderBy('id', 'DESC');

        if (auth()->user() instanceof Anggota) {
            $data = $data->where('anggota_id', auth()->user()->id);
        }

        return WilayahResource::collection($data->paginate(min($paginate, 50)));
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
            'nama_wilayah' => 'required|string'
        ]);

        $Wilayah = Wilayah::create($data);
        $Wilayah->anggota_id = app('user')->id;
        $Wilayah->save();

        return (new WilayahResource($Wilayah->fresh()))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wilayah $Wilayah
     * @return \Illuminate\Http\Response
     */
    public function show(Wilayah $Wilayah)
    {
        return new WilayahResource($Wilayah);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Wilayah $Wilayah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wilayah $Wilayah)
    {
        $data = $request->validate([
            'nama_wilayah' => 'string'
        ]);

        return response()->json([
            'updated' => $Wilayah->update($data),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wilayah $Wilayah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wilayah $Wilayah)
    {
        return response()->json([
            'deleted' => $Wilayah->delete(),
        ]);
    }
}
