<?php

namespace App\Http\Controllers\APIv1;

use App\Models\Anggota;
use App\Http\Resources\AnggotaResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\AnggotaCreateRequest;
use App\Http\Requests\AnggotaUpdateRequest;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AnggotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:ketua-api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = $request->query('paginate', 15);

        $data = QueryBuilder::for(Anggota::class)
            ->allowedFilters([
                AllowedFilter::partial('name'),
                AllowedFilter::partial('email'),
                AllowedFilter::exact('phone'),
            ])->orderBy('id', 'DESC');

        return AnggotaResource::collection($data->paginate(min($paginate, 50)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnggotaCreateRequest $request)
    {
        $data = $request->validated();

        return (new AnggotaResource(Anggota::create($data)))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anggota $Anggota
     * @return \Illuminate\Http\Response
     */
    public function show(Anggota $Anggota)
    {
        return new AnggotaResource($Anggota);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Anggota $Anggota
     * @return \Illuminate\Http\Response
     */
    public function update(AnggotaUpdateRequest $request, Anggota $Anggota)
    {
        $data = $request->validated();

        return response()->json([
            'updated' => $Anggota->update($data),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anggota $Anggota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anggota $Anggota)
    {
        return response()->json([
            'deleted' => $Anggota->delete(),
        ]);
    }
}
