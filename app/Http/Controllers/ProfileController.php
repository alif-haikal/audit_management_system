<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ProfileDataTable;
use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Repositories\ProfileRepository;
use App\Http\Controllers\AppBaseController;
use Response;
use Rekamy\Generator\Console\Traits\ResponseHandler;

class ProfileController extends AppBaseController
{
    use ResponseHandler;

    private $page = 'Profile';

    /** @var  ProfileRepository */
    private $profileRepository;

    public function __construct(ProfileRepository $profileRepo)
    {
        $this->profileRepository = $profileRepo;
    }

    /**
     * Display a listing of the Profile.
     *
     * @param ProfileDataTable $profileDataTable
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();

            $output = $this->profileRepository->profiles($input)->toArray();

            $response = [
                "draw"            => $input['draw'],
                "recordsTotal"    => intval($output['total']),
                "recordsFiltered" => intval($output['total']),
                "data"            => $output['data']
            ];
            return response()->json($response, 200);
        }
        return view('profile.index')->with('page', $this->page);
    }

    /**
     * Show the form for creating a new Profile.
     *
     * @return Response
     */
    public function create()
    {
        return view('profile.create')->with('page', $this->page);
    }

    /**
     * Store a newly created Profile in storage.
     *
     * @param CreateProfileRequest $request
     *
     * @return Response
     */
    public function store(CreateProfileRequest $request)
    {
        $input = $request->all();

        $profile = $this->profileRepository->createProfile($input);

        return $this->successResponse('Successfully Insert New Data', $profile);
    }

    /**
     * Display the specified Profile.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $profile = $this->profileRepository->findWithoutFail($id);

        return view('profile.show')->with('profile', $profile)->with('page', $this->page);
    }

    /**
     * Show the form for editing the specified Profile.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $profile = $this->profileRepository->findWithoutFail($id);

        return view('profile.edit')->with('profile', $profile)->with('page', $this->page);
    }

    /**
     * Update the specified Profile in storage.
     *
     * @param  int $id
     * @param UpdateProfileRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProfileRequest $request)
    {
        $input = $request->all();

        $profile = $this->profileRepository->updateProfile($id, $input);

        return $this->successResponse('Successfully Update Data', $profile);
    }

    /**
     * Remove the specified Profile from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        return $this->profileRepository->deleteProfile($id);
    }
}
