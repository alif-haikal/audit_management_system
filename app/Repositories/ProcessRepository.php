<?php

namespace App\Repositories;

use Illuminate\Pagination\Paginator;
use App\Models\Process;
use Prettus\Repository\Eloquent\BaseRepository;
use DB;
use Exception;

/**
 * Class ProcessRepository
 * @package App\Repositories
 * @version April 10, 2019, 3:42 am +08
 *
 * @method Process findWithoutFail($id, $columns = ['*'])
 * @method Process find($id, $columns = ['*'])
 * @method Process first($columns = ['*'])
*/
class ProcessRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

		'id',
		'process',
		'created_by',
		'created_at',
		'updated_at',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Process::class;
    }

    public function process($input)
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

    public function createProcess($input)
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

    public function showProcess($id)
	{
		try {
			if (!$process = $this->findWithoutFail($id)) {
				throw new Exception('Error Processing Request', 405);
			}
			return $this->successResponse('Successfully Update Data', $process);
		} catch (\Throwable $th) {
			return $this->failResponse($th->getMessage(), $th->getCode());
		}
	}

    public function updateProcess($id, $input)
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

	public function deleteProcess($id)
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

