<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ModelHasRoleDataTable;
use App\Http\Requests\CreateModelHasRoleRequest;
use App\Http\Requests\UpdateModelHasRoleRequest;
use App\Repositories\ModelHasRoleRepository;
use App\Http\Controllers\AppBaseController;
use Response;
use Rekamy\Generator\Console\Traits\ResponseHandler;

class ModelHasRoleController extends AppBaseController
{
    use ResponseHandler;

    private $page = 'ModelHasRole';

    /** @var  ModelHasRoleRepository */
    private $modelHasRoleRepository;

    public function __construct(ModelHasRoleRepository $modelHasRoleRepo)
    {
        $this->modelHasRoleRepository = $modelHasRoleRepo;
    }

    /**
     * Display a listing of the ModelHasRole.
     *
     * @param ModelHasRoleDataTable $modelHasRoleDataTable
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();

            $output = $this->modelHasRoleRepository->modelHasRoles($input)->toArray();

            $response = [
                "draw"            => $input['draw'],
                "recordsTotal"    => intval($output['total']),
                "recordsFiltered" => intval($output['total']),
                "data"            => $output['data']
            ];
            return response()->json($response, 200);
        }
        return view('model-has-role.index')->with('page', $this->page);
    }

    /**
     * Show the form for creating a new ModelHasRole.
     *
     * @return Response
     */
    public function create()
    {
        return view('model-has-role.create')->with('page', $this->page);
    }

    /**
     * Store a newly created ModelHasRole in storage.
     *
     * @param CreateModelHasRoleRequest $request
     *
     * @return Response
     */
    public function store(CreateModelHasRoleRequest $request)
    {
        $input = $request->all();

        $modelHasRole = $this->modelHasRoleRepository->createModelHasRole($input);

        return $this->successResponse('Successfully Insert New Data', $modelHasRole);
    }

    /**
     * Display the specified ModelHasRole.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $modelHasRole = $this->modelHasRoleRepository->findWithoutFail($id);

        return view('model-has-role.show')->with('modelhasrole', $modelHasRole)->with('page', $this->page);
    }

    /**
     * Show the form for editing the specified ModelHasRole.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $modelHasRole = $this->modelHasRoleRepository->findWithoutFail($id);

        return view('model-has-role.edit')->with('modelhasrole', $modelHasRole)->with('page', $this->page);
    }

    /**
     * Update the specified ModelHasRole in storage.
     *
     * @param  int $id
     * @param UpdateModelHasRoleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateModelHasRoleRequest $request)
    {
        $input = $request->all();

        $modelHasRole = $this->modelHasRoleRepository->updateModelHasRole($id, $input);

        return $this->successResponse('Successfully Update Data', $modelHasRole);
    }

    /**
     * Remove the specified ModelHasRole from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        return $this->modelHasRoleRepository->deleteModelHasRole($id);
    }
}
