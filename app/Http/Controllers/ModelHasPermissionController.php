<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ModelHasPermissionDataTable;
use App\Http\Requests\CreateModelHasPermissionRequest;
use App\Http\Requests\UpdateModelHasPermissionRequest;
use App\Repositories\ModelHasPermissionRepository;
use App\Http\Controllers\AppBaseController;
use Response;
use Rekamy\Generator\Console\Traits\ResponseHandler;

class ModelHasPermissionController extends AppBaseController
{
    use ResponseHandler;

    private $page = 'ModelHasPermission';

    /** @var  ModelHasPermissionRepository */
    private $modelHasPermissionRepository;

    public function __construct(ModelHasPermissionRepository $modelHasPermissionRepo)
    {
        $this->modelHasPermissionRepository = $modelHasPermissionRepo;
    }

    /**
     * Display a listing of the ModelHasPermission.
     *
     * @param ModelHasPermissionDataTable $modelHasPermissionDataTable
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();

            $output = $this->modelHasPermissionRepository->modelHasPermissions($input)->toArray();

            $response = [
                "draw"            => $input['draw'],
                "recordsTotal"    => intval($output['total']),
                "recordsFiltered" => intval($output['total']),
                "data"            => $output['data']
            ];
            return response()->json($response, 200);
        }
        return view('model-has-permission.index')->with('page', $this->page);
    }

    /**
     * Show the form for creating a new ModelHasPermission.
     *
     * @return Response
     */
    public function create()
    {
        return view('model-has-permission.create')->with('page', $this->page);
    }

    /**
     * Store a newly created ModelHasPermission in storage.
     *
     * @param CreateModelHasPermissionRequest $request
     *
     * @return Response
     */
    public function store(CreateModelHasPermissionRequest $request)
    {
        $input = $request->all();

        $modelHasPermission = $this->modelHasPermissionRepository->createModelHasPermission($input);

        return $this->successResponse('Successfully Insert New Data', $modelHasPermission);
    }

    /**
     * Display the specified ModelHasPermission.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $modelHasPermission = $this->modelHasPermissionRepository->findWithoutFail($id);

        return view('model-has-permission.show')->with('modelhaspermission', $modelHasPermission)->with('page', $this->page);
    }

    /**
     * Show the form for editing the specified ModelHasPermission.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $modelHasPermission = $this->modelHasPermissionRepository->findWithoutFail($id);

        return view('model-has-permission.edit')->with('modelhaspermission', $modelHasPermission)->with('page', $this->page);
    }

    /**
     * Update the specified ModelHasPermission in storage.
     *
     * @param  int $id
     * @param UpdateModelHasPermissionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateModelHasPermissionRequest $request)
    {
        $input = $request->all();

        $modelHasPermission = $this->modelHasPermissionRepository->updateModelHasPermission($id, $input);

        return $this->successResponse('Successfully Update Data', $modelHasPermission);
    }

    /**
     * Remove the specified ModelHasPermission from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        return $this->modelHasPermissionRepository->deleteModelHasPermission($id);
    }
}
