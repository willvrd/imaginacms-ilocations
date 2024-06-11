<?php

namespace Modules\Ilocations\Http\Controllers\Admin;

use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Ilocations\Entities\Country;
use Modules\Ilocations\Http\Requests\CreateCountryRequest;
use Modules\Ilocations\Http\Requests\UpdateCountryRequest;
use Modules\Ilocations\Repositories\CountryRepository;

class CountryController extends AdminBaseController
{
    /**
     * @var CountryRepository
     */
    private $country;

    public function __construct(CountryRepository $country)
    {
        parent::__construct();

        $this->country = $country;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //$countries = $this->country->all();

        return view('ilocations::admin.countries.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return view('ilocations::admin.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCountryRequest $request): Response
    {
        $this->country->create($request->all());

        return redirect()->route('admin.ilocations.country.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('ilocations::countries.title.countries')]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country): Response
    {
        return view('ilocations::admin.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Country $country, UpdateCountryRequest $request): Response
    {
        $this->country->update($country, $request->all());

        return redirect()->route('admin.ilocations.country.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ilocations::countries.title.countries')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country): Response
    {
        $this->country->destroy($country);

        return redirect()->route('admin.ilocations.country.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('ilocations::countries.title.countries')]));
    }
}
