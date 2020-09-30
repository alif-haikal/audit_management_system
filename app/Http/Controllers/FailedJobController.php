<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\FailedJobDataTable;
use App\Http\Requests\CreateFailedJobRequest;
use App\Http\Requests\UpdateFailedJobRequest;
use App\Repositories\FailedJobRepository;
use App\Http\Controllers\AppBaseController;
use Response;
use Rekamy\Generator\Console\Traits\ResponseHandler;

class FailedJobController extends AppBaseController
{
    use ResponseHandler;

    private $page = 'FailedJob';

    /** @var  FailedJobRepository */
    private $failedJobRepository;

    public function __construct(FailedJobRepository $failedJobRepo)
    {
        $this->failedJobRepository = $failedJobRepo;
    }

    /**
     * Display a listing of the FailedJob.
     *
     * @param FailedJobDataTable $failedJobDataTable
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();

            $output = $this->failedJobRepository->failedJobs($input)->toArray();

            $response = [
                "draw"            => $input['draw'],
                "recordsTotal"    => intval($output['total']),
                "recordsFiltered" => intval($output['total']),
                "data"            => $output['data']
            ];
            return response()->json($response, 200);
        }
        return view('failed-job.index')->with('page', $this->page);
    }

    /**
     * Show the form for creating a new FailedJob.
     *
     * @return Response
     */
    public function create()
    {
        return view('failed-job.create')->with('page', $this->page);
    }

    /**
     * Store a newly created FailedJob in storage.
     *
     * @param CreateFailedJobRequest $request
     *
     * @return Response
     */
    public function store(CreateFailedJobRequest $request)
    {
        $input = $request->all();

        $failedJob = $this->failedJobRepository->createFailedJob($input);

        return $this->successResponse('Successfully Insert New Data', $failedJob);
    }

    /**
     * Display the specified FailedJob.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $failedJob = $this->failedJobRepository->findWithoutFail($id);

        return view('failed-job.show')->with('failedjob', $failedJob)->with('page', $this->page);
    }

    /**
     * Show the form for editing the specified FailedJob.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $failedJob = $this->failedJobRepository->findWithoutFail($id);

        return view('failed-job.edit')->with('failedjob', $failedJob)->with('page', $this->page);
    }

    /**
     * Update the specified FailedJob in storage.
     *
     * @param  int $id
     * @param UpdateFailedJobRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFailedJobRequest $request)
    {
        $input = $request->all();

        $failedJob = $this->failedJobRepository->updateFailedJob($id, $input);

        return $this->successResponse('Successfully Update Data', $failedJob);
    }

    /**
     * Remove the specified FailedJob from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        return $this->failedJobRepository->deleteFailedJob($id);
    }
}
