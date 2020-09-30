<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ObjectiveDataTable;
use App\Http\Requests\CreateObjectiveRequest;
use App\Http\Requests\UpdateObjectiveRequest;
use App\Repositories\ObjectiveRepository;
use App\Http\Controllers\AppBaseController;
use Response;
use Rekamy\Generator\Console\Traits\ResponseHandler;

class ObjectiveController extends AppBaseController
{
    use ResponseHandler;

    private $page = 'Objective';

    /** @var  ObjectiveRepository */
    private $objectiveRepository;

    public function __construct(ObjectiveRepository $objectiveRepo)
    {
        $this->objectiveRepository = $objectiveRepo;
    }

    /**
     * Display a listing of the Objective.
     *
     * @param ObjectiveDataTable $objectiveDataTable
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();

            $output = $this->objectiveRepository->objectives($input)->toArray();

            $response = [
                "draw"            => $input['draw'],
                "recordsTotal"    => intval($output['total']),
                "recordsFiltered" => intval($output['total']),
                "data"            => $output['data']
            ];
            return response()->json($response, 200);
        }
        return view('objective.index')->with('page', $this->page);
    }

    /**
     * Show the form for creating a new Objective.
     *
     * @return Response
     */
    public function create()
    {
        return view('objective.create')->with('page', $this->page);
    }

    /**
     * Store a newly created Objective in storage.
     *
     * @param CreateObjectiveRequest $request
     *
     * @return Response
     */
    public function store(CreateObjectiveRequest $request)
    {
        $input = $request->all();

        $objective = $this->objectiveRepository->createObjective($input);

        return $this->successResponse('Successfully Insert New Data', $objective);
    }

    /**
     * Display the specified Objective.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $objective = $this->objectiveRepository->findWithoutFail($id);

        return view('objective.show')->with('objective', $objective)->with('page', $this->page);
    }

    /**
     * Show the form for editing the specified Objective.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $objective = $this->objectiveRepository->findWithoutFail($id);

        return view('objective.edit')->with('objective', $objective)->with('page', $this->page);
    }

    /**
     * Update the specified Objective in storage.
     *
     * @param  int $id
     * @param UpdateObjectiveRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateObjectiveRequest $request)
    {
        $input = $request->all();

        $objective = $this->objectiveRepository->updateObjective($id, $input);

        return $this->successResponse('Successfully Update Data', $objective);
    }

    /**
     * Remove the specified Objective from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        return $this->objectiveRepository->deleteObjective($id);
    }
}
