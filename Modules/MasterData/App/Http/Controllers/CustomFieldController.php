<?php

namespace Modules\MasterData\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\MasterData\CustomField\App\Http\Requests\StoreRequest;
use Modules\MasterData\CustomField\App\Http\Requests\UpdateRequest;
use Modules\MasterData\CustomField\App\Models\CustomField;
use Modules\MasterData\CustomField\App\Repositories\CustomFieldInterface;

class CustomFieldController extends Controller
{
    protected $custom_field;

    public function __construct(CustomFieldInterface $custom_field)
    {
        $this->custom_field = $custom_field;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->custom_field->index($request);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return $this->custom_field->store($request);
    }

    /**
     * Show the specified resource.
     */
    public function show(CustomField $custom_field)
    {
        return $this->custom_field->show($custom_field);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(CustomField $custom_field , UpdateRequest $request)
    {
        return $this->custom_field->update($custom_field , $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomField $custom_field)
    {
        return $this->custom_field->destroy($custom_field);

    }
}
