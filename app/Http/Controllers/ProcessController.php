<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ProcessDataTable;
use App\Http\Requests\CreateProcessRequest;
use App\Http\Requests\UpdateProcessRequest;
use App\Repositories\ProcessRepository;
use App\Http\Controllers\AppBaseController;
use Response;
use Rekamy\Generator\Console\Traits\ResponseHandler;

class ProcessController extends AppBaseController
{
    use ResponseHandler;

    private $page = 'Process';

    /** @var  ProcessRepository */
    private $processRepository;

    public function __construct(ProcessRepository $processRepo)
    {
        $this->processRepository = $processRepo;
    }

    /**
     * Display a listing of the Process.
     *
     * @param ProcessDataTable $processDataTable
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();

            $output = $this->processRepository->process($input)->toArray();

            $response = [
                "draw"            => $input['draw'],
                "recordsTotal"    => intval($output['total']),
                "recordsFiltered" => intval($output['total']),
                "data"            => $output['data']
            ];
            return response()->json($response, 200);
        }
        return view('process.index')->with('page', $this->page);
    }

    /**
     * Show the form for creating a new Process.
     *
     * @return Response
     */
    public function create()
    {
        return view('process.create')->with('page', $this->page);
    }

    /**
     * Store a newly created Process in storage.
     *
     * @param CreateProcessRequest $request
     *
     * @return Response
     */
    public function store(CreateProcessRequest $request)
    {
        $input = $request->all();

        $process = $this->processRepository->createProcess($input);

        return $this->successResponse('Successfully Insert New Data', $process);
    }

    /**
     * Display the specified Process.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $process = $this->processRepository->findWithoutFail($id);

        return view('process.show')->with('process', $process)->with('page', $this->page);
    }

    /**
     * Show the form for editing the specified Process.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $process = $this->processRepository->findWithoutFail($id);

        return view('process.edit')->with('process', $process)->with('page', $this->page);
    }

    /**
     * Update the specified Process in storage.
     *
     * @param  int $id
     * @param UpdateProcessRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProcessRequest $request)
    {
        $input = $request->all();

        $process = $this->processRepository->updateProcess($id, $input);

        return $this->successResponse('Successfully Update Data', $process);
    }

    /**
     * Remove the specified Process from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        return $this->processRepository->deleteProcess($id);
    }
}
