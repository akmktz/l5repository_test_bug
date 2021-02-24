<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestCreateRequest;
use App\Http\Requests\TestUpdateRequest;
use App\Repositories\TestRepository;
use App\Repositories\TestRepositoryEloquent;
use App\Validators\TestValidator;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class TestsController.
 *
 * @package namespace App\Http\Controllers;
 */
class TestsController extends Controller
{
    /**
     * @var TestRepository
     */
    protected $repository;

    /**
     * @var TestValidator
     */

    /**
     * TestsController constructor.
     *
     * @param TestRepository $repository
     */
    public function __construct(TestRepositoryEloquent $repository)
    {
        //$this->repository = new TestRepositoryEloquent();
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $tests = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tests,
            ]);
        }

        return view('tests.index', compact('tests'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TestCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TestCreateRequest $request)
    {
        try {
            $test = $this->repository->create($request->all());

            $response = [
                'message' => 'Test created.',
                'data'    => $test->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $test,
            ]);
        }

        return view('tests.show', compact('test'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $test = $this->repository->find($id);

        return view('tests.edit', compact('test'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TestUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TestUpdateRequest $request, $id)
    {
        try {
            $test = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Test updated.',
                'data'    => $test->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Test deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Test deleted.');
    }
}