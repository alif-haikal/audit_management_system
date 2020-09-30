<?php

namespace App\Repositories;

use Illuminate\Pagination\Paginator;
use App\Models\FailedJob;
use Prettus\Repository\Eloquent\BaseRepository;
use DB;
use Exception;

/**
 * Class FailedJobRepository
 * @package App\Repositories
 * @version April 10, 2019, 3:42 am +08
 *
 * @method FailedJob findWithoutFail($id, $columns = ['*'])
 * @method FailedJob find($id, $columns = ['*'])
 * @method FailedJob first($columns = ['*'])
*/
class FailedJobRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
    
		'id',
		'connection',
		'queue',
		'payload',
		'exception',
		'failed_at',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return FailedJob::class;
    }
    
    public function failedJobs($input)
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
    
    public function createFailedJob($input)
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
    
    public function showFailedJob($id)
	{
		try {
			if (!$failedJob = $this->findWithoutFail($id)) {
				throw new Exception('Error Processing Request', 405);
			}
			return $this->successResponse('Successfully Update Data', $failedJob);
		} catch (\Throwable $th) {
			return $this->failResponse($th->getMessage(), $th->getCode());
		}
	}

    public function updateFailedJob($id, $input)
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

	public function deleteFailedJob($id)
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

