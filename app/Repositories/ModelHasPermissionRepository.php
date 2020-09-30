<?php

namespace App\Repositories;

use Illuminate\Pagination\Paginator;
use App\Models\ModelHasPermission;
use Prettus\Repository\Eloquent\BaseRepository;
use DB;
use Exception;

/**
 * Class ModelHasPermissionRepository
 * @package App\Repositories
 * @version April 10, 2019, 3:42 am +08
 *
 * @method ModelHasPermission findWithoutFail($id, $columns = ['*'])
 * @method ModelHasPermission find($id, $columns = ['*'])
 * @method ModelHasPermission first($columns = ['*'])
*/
class ModelHasPermissionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
    
		'permission_id',
		'model_type',
		'model_id',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ModelHasPermission::class;
    }
    
    public function modelHasPermissions($input)
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
    
    public function createModelHasPermission($input)
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
    
    public function showModelHasPermission($id)
	{
		try {
			if (!$modelHasPermission = $this->findWithoutFail($id)) {
				throw new Exception('Error Processing Request', 405);
			}
			return $this->successResponse('Successfully Update Data', $modelHasPermission);
		} catch (\Throwable $th) {
			return $this->failResponse($th->getMessage(), $th->getCode());
		}
	}

    public function updateModelHasPermission($id, $input)
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

	public function deleteModelHasPermission($id)
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

