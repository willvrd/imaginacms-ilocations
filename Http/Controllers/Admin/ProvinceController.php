<?php

namespace Modules\Ilocations\Http\Controllers\Admin;

use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Ilocations\Entities\Province;
use Modules\Ilocations\Http\Requests\CreateProvinceRequest;
use Modules\Ilocations\Http\Requests\UpdateProvinceRequest;
use Modules\Ilocations\Repositories\ProvinceRepository;

class ProvinceController extends AdminBaseController
{
    /**
     * @var ProvinceRepository
     */
    private $province;

    public function __construct(ProvinceRepository $province)
    {
        parent::__construct();

        $this->province = $province;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //$provinces = $this->province->all();

        return view('ilocations::admin.provinces.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return view('ilocations::admin.provinces.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProvinceRequest $request): Response
    {
        $this->province->create($request->all());

        return redirect()->route('admin.ilocations.province.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('ilocations::provinces.title.provinces')]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Province $province): Response
    {
        return view('ilocations::admin.provinces.edit', compact('province'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Province $province, UpdateProvinceRequest $request): Response
    {
        $this->province->update($province, $request->all());

        return redirect()->route('admin.ilocations.province.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ilocations::provinces.title.provinces')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Province $province): Response
    {
        $this->province->destroy($province);

        return redirect()->route('admin.ilocations.province.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('ilocations::provinces.title.provinces')]));
    }
}
