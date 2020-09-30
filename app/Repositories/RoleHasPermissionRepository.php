<?php

namespace App\Repositories;

use Illuminate\Pagination\Paginator;
use App\Models\RoleHasPermission;
use Prettus\Repository\Eloquent\BaseRepository;
use DB;
use Exception;

/**
 * Class RoleHasPermissionRepository
 * @package App\Repositories
 * @version April 10, 2019, 3:42 am +08
 *
 * @method RoleHasPermission findWithoutFail($id, $columns = ['*'])
 * @method RoleHasPermission find($id, $columns = ['*'])
 * @method RoleHasPermission first($columns = ['*'])
*/
class RoleHasPermissionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
    
		'permission_id',
		'role_id',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return RoleHasPermission::class;
    }
    
    public function roleHasPermissions($input)
	{
		Paginator::currentPageResolver(function () use ($input) {
			return ($input['start'] / $input['length'] + 1);
		});

		$model = $this;

		if (!empty($input['search']['value'])) {
			foreach ($this->fieldSearchable as $column) {
				$model = $model->whereLike($column, $input['search']['value']);
			}
		}

		return $model->paginate($input['length']);
    }
    
    public function createRoleHasPermission($input)
	{
		DB::beginTransaction();
		try {
			if (!$this->create($input)) {
				throw new Exception('Error Processing Request', 405);
			}
			DB::commit();
		} catch (\Throwable $th) {
			DB::rollBack();
			throw new Exception($th->getMessage(), $th->getCode());
		}
	}
    
    public function showRoleHasPermission($id)
	{
		try {
			if (!$roleHasPermission = $this->findWithoutFail($id)) {
				throw new Exception('Error Processing Request', 405);
			}
			return $this->successResponse('Successfully Update Data', $roleHasPermission);
		} catch (\Throwable $th) {
			return $this->failResponse($th->getMessage(), $th->getCode());
		}
	}

    public function updateRoleHasPermission($id, $input)
	{
		DB::beginTransaction();
		try {
			if (!$this->update($input, $id)) {
				throw new Exception('Error Processing Request', 405);
			}
			DB::commit();
		} catch (\Throwable $th) {
			DB::rollBack();
			throw new Exception($th->getMessage(), $th->getCode());
		}
	}

	public function deleteRoleHasPermission($id)
	{
		DB::beginTransaction();
		try {
			if (!$this->delete($id)) {
				throw new Exception('Error Processing Request', 405);
			}
			DB::commit();
			return $this->successResponse('Data Has Been Deleted');
		} catch (\Throwable $th) {
			DB::rollBack();
			return $this->failResponse($th->getMessage(), $th->getCode());
		}
	}
}

