<?php

namespace App\Repositories;

use Illuminate\Pagination\Paginator;
use App\Models\Objective;
use Prettus\Repository\Eloquent\BaseRepository;
use DB;
use Exception;

/**
 * Class ObjectiveRepository
 * @package App\Repositories
 * @version April 10, 2019, 3:42 am +08
 *
 * @method Objective findWithoutFail($id, $columns = ['*'])
 * @method Objective find($id, $columns = ['*'])
 * @method Objective first($columns = ['*'])
*/
class ObjectiveRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
    
		'id',
		'objective',
		'created_by',
		'created_at',
		'updated_at',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Objective::class;
    }
    
    public function objectives($input)
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
    
    public function createObjective($input)
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
    
    public function showObjective($id)
	{
		try {
			if (!$objective = $this->findWithoutFail($id)) {
				throw new Exception('Error Processing Request', 405);
			}
			return $this->successResponse('Successfully Update Data', $objective);
		} catch (\Throwable $th) {
			return $this->failResponse($th->getMessage(), $th->getCode());
		}
	}

    public function updateObjective($id, $input)
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

	public function deleteObjective($id)
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

