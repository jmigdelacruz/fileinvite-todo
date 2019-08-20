<?php
namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class TaskController extends Controller
{
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
        
        //log this transaction
        $orderLog = new Logger('api');
        $orderLog->pushHandler(new StreamHandler(storage_path('logs/fileinvite.log')), Logger::INFO);
        $orderLog->info('action: create | id: '.$todo->id.' | text: "'.$request->text.'" | finished: '.$request->finished);

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

        //log this transaction
        $orderLog = new Logger('api');
        $orderLog->pushHandler(new StreamHandler(storage_path('logs/fileinvite.log')), Logger::INFO);
        $orderLog->info('action: update | id: '.$todo->id.' | text: "'.$request->text.'" | finished: '.$request->finished);

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
        
        //log this transaction
        $orderLog = new Logger('api');
        $orderLog->pushHandler(new StreamHandler(storage_path('logs/fileinvite.log')), Logger::INFO);
        $orderLog->info('action: delete | id: '.$todo->id.' | text: "'.$todo->text.'" | finished: '.$todo->finished);

        return response('Deleted Succesfully', 200);
    }
}
