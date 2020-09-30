<?php

namespace App\Repositories;

use Illuminate\Pagination\Paginator;
use App\Models\Profile;
use Prettus\Repository\Eloquent\BaseRepository;
use DB;
use Exception;

/**
 * Class ProfileRepository
 * @package App\Repositories
 * @version April 10, 2019, 3:42 am +08
 *
 * @method Profile findWithoutFail($id, $columns = ['*'])
 * @method Profile find($id, $columns = ['*'])
 * @method Profile first($columns = ['*'])
*/
class ProfileRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
    
		'id',
		'ic',
		'created_at',
		'updated_at',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Profile::class;
    }
    
    public function profiles($input)
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
    
    public function createProfile($input)
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
    
    public function showProfile($id)
	{
		try {
			if (!$profile = $this->findWithoutFail($id)) {
				throw new Exception('Error Processing Request', 405);
			}
			return $this->successResponse('Successfully Update Data', $profile);
		} catch (\Throwable $th) {
			return $this->failResponse($th->getMessage(), $th->getCode());
		}
	}

    public function updateProfile($id, $input)
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

	public function deleteProfile($id)
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

