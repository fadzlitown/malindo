<?php

namespace App\Controllers\Api;

use App\Controllers\ApiBaseController,
    App\Models\Todo,
    Input,
    Response,
    Validator;

class TodosController extends ApiBaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * GET
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $response                  = $this->response;
        $response['data']['todos'] = Todo::all();

        return Response::json($response, $this->http_status);
    }

    /**
     * GET
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $input     = Input::only("title", "note", "due_date", "reminder_date", "status");
        $validator = Validator::make($input, Todo::getRules());

        if ($validator->passes()) {
            $input['status'] = isset($input['status']) ? $input['status'] : 'in_progress';
            $todo            = Todo::create($input);
            if ($todo->id) {
                $this->response['data']['todo'] = $todo->toArray();
                return Response::json($this->response, 200);
            }
        }
        else {
            $this->response = $this->getErrorResponse("errorValidator", 200, "", $validator->messages()->first());
        }

        return Response::json($this->response, $this->http_status);
    }

    /**
     * POST
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input     = Input::only("title", "note", "due_date", "reminder_date", "status");
        $validator = Validator::make($input, Todo::getRules());

        if ($validator->passes()) {
            $input['status'] = isset($input['status']) ? $input['status'] : 'in_progress';
            $todo            = Todo::create($input);
            if ($todo->id) {
                $this->response['data']['todo'] = $todo->toArray();
                return Response::json($this->response, 200);
            }
        }
        else {
            $this->response = $this->getErrorResponse("errorValidator", 200, "", $validator->messages()->first());
        }

        return Response::json($this->response, $this->http_status);
    }

    /**
     * GET
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if (!is_null($id)) {
            $todo = Todo::find($id);
            if ($todo) {
                $this->response['data']['todo'] = $todo->toArray();
            }
        }
        else {
            $this->response = $this->getErrorResponse("notFound", 404);
        }

        return Response::json($this->response, $this->http_status);
    }

    /**
     * GET
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $input = Input::only("title", "note", "due_date", "reminder_date", "status");
        $todo  = Todo::find($id);
        if ($todo) {

            $todo->title         = $input['title'];
            $todo->note          = $input['note'];
            $todo->due_date      = $input['due_date'];
            $todo->reminder_date = $input['reminder_date'];
            $todo->status        = $input['status'];
            $todo->update();
        }

        $this->response['message'] = 'Todo successfully updated.';
        return Response::json($this->response, $this->http_status);
    }

    /**
     * POST
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //same as edit
    }

    /**
     * DELETE
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (!is_null($id)) {
            $todo = Todo::find($id);
            $todo->delete();
            $this->response['message'] = "Todo successfully deleted.";
        }
        else {
            $this->response = $this->getErrorResponse("notFound", 404);
        }

        return Response::json($this->response, $this->http_status);
    }

    public function missingMethod($parameters = array())
    {
        echo "Missing method";
    }

}
