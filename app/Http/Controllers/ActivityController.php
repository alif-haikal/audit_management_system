<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ActivityDataTable;
use App\Http\Requests\CreateActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Repositories\ActivityRepository;
use App\Http\Controllers\AppBaseController;
use Response;
use Rekamy\Generator\Console\Traits\ResponseHandler;

class ActivityController extends AppBaseController
{
    use ResponseHandler;

    private $page = 'Activity';

    /** @var  ActivityRepository */
    private $activityRepository;

    public function __construct(ActivityRepository $activityRepo)
    {
        $this->activityRepository = $activityRepo;
    }

    /**
     * Display a listing of the Activity.
     *
     * @param ActivityDataTable $activityDataTable
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();

            $output = $this->activityRepository->activities($input)->toArray();

            $response = [
                "draw"            => $input['draw'],
                "recordsTotal"    => intval($output['total']),
                "recordsFiltered" => intval($output['total']),
                "data"            => $output['data']
            ];
            return response()->json($response, 200);
        }
        return view('activity.index')->with('page', $this->page);
    }

    /**
     * Show the form for creating a new Activity.
     *
     * @return Response
     */
    public function create()
    {
        return view('activity.create')->with('page', $this->page);
    }

    /**
     * Store a newly created Activity in storage.
     *
     * @param CreateActivityRequest $request
     *
     * @return Response
     */
    public function store(CreateActivityRequest $request)
    {
        $input = $request->all();

        $activity = $this->activityRepository->createActivity($input);

        return $this->successResponse('Successfully Insert New Data', $activity);
    }

    /**
     * Display the specified Activity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $activity = $this->activityRepository->findWithoutFail($id);

        return view('activity.show')->with('activity', $activity)->with('page', $this->page);
    }

    /**
     * Show the form for editing the specified Activity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $activity = $this->activityRepository->findWithoutFail($id);

        return view('activity.edit')->with('activity', $activity)->with('page', $this->page);
    }

    /**
     * Update the specified Activity in storage.
     *
     * @param  int $id
     * @param UpdateActivityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivityRequest $request)
    {
        $input = $request->all();

        $activity = $this->activityRepository->updateActivity($id, $input);

        return $this->successResponse('Successfully Update Data', $activity);
    }

    /**
     * Remove the specified Activity from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        return $this->activityRepository->deleteActivity($id);
    }
}
