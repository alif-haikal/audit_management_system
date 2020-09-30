<?php

namespace App\Repositories;

use Illuminate\Pagination\Paginator;
use App\Models\Permission;
use Prettus\Repository\Eloquent\BaseRepository;
use DB;
use Exception;

/**
 * Class PermissionRepository
 * @package App\Repositories
 * @version April 10, 2019, 3:42 am +08
 *
 * @method Permission findWithoutFail($id, $columns = ['*'])
 * @method Permission find($id, $columns = ['*'])
 * @method Permission first($columns = ['*'])
*/
class PermissionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
    
		'id',
		'name',
		'guard_name',
		'created_at',
		'updated_at',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Permission::class;
    }
    
    public function permissions($input)
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
    
    public function createPermission($input)
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
    
    public function showPermission($id)
	{
		try {
			if (!$permission = $this->findWithoutFail($id)) {
				throw new Exception('Error Processing Request', 405);
			}
			return $this->successResponse('Successfully Update Data', $permission);
		} catch (\Throwable $th) {
			return $this->failResponse($th->getMessage(), $th->getCode());
		}
	}

    public function updatePermission($id, $input)
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

	public function deletePermission($id)
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

