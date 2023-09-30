<?php

namespace App\Http\Controllers\APIv1;

use App\Models\Ketua;
use App\Http\Resources\KetuaResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\KetuaCreateRequest;
use App\Http\Requests\KetuaUpdateRequest;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class KetuaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin-api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = $request->query('paginate', 15);

        $data = QueryBuilder::for(Ketua::class)
            ->allowedFilters([
                AllowedFilter::partial('name'),
                AllowedFilter::partial('username'),
                AllowedFilter::partial('email'),
                AllowedFilter::partial('phone'),
            ])->orderBy('id', 'DESC');

        return KetuaResource::collection($data->paginate(min($paginate, 50)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(KetuaCreateRequest $request)
    {
        $data = $request->validated();

        return (new KetuaResource(Ketua::create($data)))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ketua $Ketua
     * @return \Illuminate\Http\Response
     */
    public function show(Ketua $Ketua)
    {
        return new KetuaResource($Ketua);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Ketua $Ketua
     * @return \Illuminate\Http\Response
     */
    public function update(KetuaUpdateRequest $request, Ketua $Ketua)
    {
        $data = $request->validated();

        return response()->json([
            'updated' => $Ketua->update($data),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ketua $Ketua
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ketua $Ketua)
    {
        return response()->json([
            'deleted' => $Ketua->delete(),
        ]);
    }
}
