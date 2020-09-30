<?php

namespace App\Repositories;

use Illuminate\Pagination\Paginator;
use App\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;
use DB;
use Exception;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version April 10, 2019, 3:42 am +08
 *
 * @method User findWithoutFail($id, $columns = ['*'])
 * @method User find($id, $columns = ['*'])
 * @method User first($columns = ['*'])
*/
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

		'id',
		'name',
		'email',
		'password',
		'remember_token',
		'created_at',
		'updated_at',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    public function users($input)
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

    public function createUser($input)
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

    public function showUser($id)
	{
		try {
			if (!$user = $this->findWithoutFail($id)) {
				throw new Exception('Error Processing Request', 405);
			}
			return $this->successResponse('Successfully Update Data', $user);
		} catch (\Throwable $th) {
			return $this->failResponse($th->getMessage(), $th->getCode());
		}
	}

    public function updateUser($id, $input)
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

	public function deleteUser($id)
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

