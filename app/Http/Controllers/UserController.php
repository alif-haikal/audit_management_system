<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Response;
use Rekamy\Generator\Console\Traits\ResponseHandler;

class UserController extends AppBaseController
{
    use ResponseHandler;

    private $page = 'User';

    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();

            $output = $this->userRepository->users($input)->toArray();

            $response = [
                "draw"            => $input['draw'],
                "recordsTotal"    => intval($output['total']),
                "recordsFiltered" => intval($output['total']),
                "data"            => $output['data']
            ];
            return response()->json($response, 200);
        }
        return view('user.index')->with('page', $this->page);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $properties = Property::where('user_id', auth()->user()->id)->get();

        return view('user.create')
            ->with('properties', $properties)
            ->with('page', $this->page);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();

        $user = $this->userRepository->createUser($input);

        return $this->successResponse('Successfully Insert New Data', $user);
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        return view('user.show')->with('user', $user)->with('page', $this->page);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        return view('user.edit')->with('user', $user)->with('page', $this->page);
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $input = $request->all();

        $user = $this->userRepository->updateUser($id, $input);

        return $this->successResponse('Successfully Update Data', $user);
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        return $this->userRepository->deleteUser($id);
    }
}
