<?php
namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    	//
	// public function fetchAll(){
	// 	$tasks = Task::all();
	// 	//return response()->json($tasks);
	// 	return $tasks;
	// }

	// public function store(Request $request){
	// 	$task = Task::create($request->all());
	// 	broadcast(new TaskCreated($task));
	// 	return response()->json("added");
	// }

	// public function delete($id){
	// 	$task = Task::find($id);
	// 	broadcast(new TaskRemoved($task));
	// 	Task::destroy($id);
	// 	return response()->json("deleted");
	// }
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return response(Task::latest()->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'text' => 'required',
            'finished' => 'required|boolean',
        ]);

        $todo = Task::create($data);

        return response($todo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Task $todo)
    {
        return response($todo, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $todo)
    {
        $data = $request->validate([
            'text' => 'required',
            'finished' => 'required|boolean',
        ]);

        $todo->update($data);

        return response($todo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task $todo
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Task $todo)
    {
        $todo->delete();

        return response('Deleted Succesfully', 200);
    }
}
