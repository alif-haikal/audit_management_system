<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\RoleHasPermissionDataTable;
use App\Http\Requests\CreateRoleHasPermissionRequest;
use App\Http\Requests\UpdateRoleHasPermissionRequest;
use App\Repositories\RoleHasPermissionRepository;
use App\Http\Controllers\AppBaseController;
use Response;
use Rekamy\Generator\Console\Traits\ResponseHandler;

class RoleHasPermissionController extends AppBaseController
{
    use ResponseHandler;

    private $page = 'RoleHasPermission';

    /** @var  RoleHasPermissionRepository */
    private $roleHasPermissionRepository;

    public function __construct(RoleHasPermissionRepository $roleHasPermissionRepo)
    {
        $this->roleHasPermissionRepository = $roleHasPermissionRepo;
    }

    /**
     * Display a listing of the RoleHasPermission.
     *
     * @param RoleHasPermissionDataTable $roleHasPermissionDataTable
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();

            $output = $this->roleHasPermissionRepository->roleHasPermissions($input)->toArray();

            $response = [
                "draw"            => $input['draw'],
                "recordsTotal"    => intval($output['total']),
                "recordsFiltered" => intval($output['total']),
                "data"            => $output['data']
            ];
            return response()->json($response, 200);
        }
        return view('role-has-permission.index')->with('page', $this->page);
    }

    /**
     * Show the form for creating a new RoleHasPermission.
     *
     * @return Response
     */
    public function create()
    {
        return view('role-has-permission.create')->with('page', $this->page);
    }

    /**
     * Store a newly created RoleHasPermission in storage.
     *
     * @param CreateRoleHasPermissionRequest $request
     *
     * @return Response
     */
    public function store(CreateRoleHasPermissionRequest $request)
    {
        $input = $request->all();

        $roleHasPermission = $this->roleHasPermissionRepository->createRoleHasPermission($input);

        return $this->successResponse('Successfully Insert New Data', $roleHasPermission);
    }

    /**
     * Display the specified RoleHasPermission.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $roleHasPermission = $this->roleHasPermissionRepository->findWithoutFail($id);

        return view('role-has-permission.show')->with('rolehaspermission', $roleHasPermission)->with('page', $this->page);
    }

    /**
     * Show the form for editing the specified RoleHasPermission.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $roleHasPermission = $this->roleHasPermissionRepository->findWithoutFail($id);

        return view('role-has-permission.edit')->with('rolehaspermission', $roleHasPermission)->with('page', $this->page);
    }

    /**
     * Update the specified RoleHasPermission in storage.
     *
     * @param  int $id
     * @param UpdateRoleHasPermissionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoleHasPermissionRequest $request)
    {
        $input = $request->all();

        $roleHasPermission = $this->roleHasPermissionRepository->updateRoleHasPermission($id, $input);

        return $this->successResponse('Successfully Update Data', $roleHasPermission);
    }

    /**
     * Remove the specified RoleHasPermission from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        return $this->roleHasPermissionRepository->deleteRoleHasPermission($id);
    }
}
