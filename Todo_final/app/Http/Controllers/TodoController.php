<?php
use Illuminate\Support\Facades;
namespace App\Http\Controllers;

use App\Repositories\TodoRepository;
use App\Services\TodoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TodoRequest;
use App\Todo;
use Illuminate\Support\Facades\Gate;


class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid=TodoService::getuseridservice();
        $todos=TodoService::IndexService();
        return view('todo.list', ['todos' => $todos]); //returning list.blade.php
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.add'); //returning add.blade.php 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoRequest $request)
    {
        $userid=TodoService::getuseridservice();
        $todoStatus=TodoService::StoreService($request);
        if ($todoStatus)            //checking todostatus
        {
            $request->session()->flash('success', 'Todo successfully added');
        } 
        else 
        {
            $request->session()->flash('error', 'Oops something went wrong, Todo not saved');
        }
        //return redirect('todo'); //redirect to /todo after running store meathod
        $arr = array('msg' => 'Something goes to wrong. Please try again later', 'status' =>false);
        if($todoStatus){ 
            $arr = array('msg' => 'Successfully Form Submited', 'status' => true);
        }
        return response()->json($arr);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userId = TodoService::getuseridservice(); //get user id
        $todo=TodoService::ShowService($id);
        if (!$todo) //checking todo is empty or not 
        {
            return redirect('todo')->with('error', 'Todo not found'); //redirect to /todo ith error message
        }
        return view('todo.view', ['todo' => $todo]); //returning view.blade.php
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userId = TodoService::getuseridservice(); //get user id
        $todo = TodoService::EditService($id);
        if ($todo)
        {
            return view('todo.edit', [ 'todo' => $todo ]); //returning edit.blade.php
        } 
        else 
        {
            return redirect('todo')->with('error', 'Todo not found'); //else redirect to /todo
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TodoRequest $request, $id)
    {
        $todo=new Todo;
        $userId = TodoService::getuseridservice();  //get user id
        $todo=TodoService::FindService($id);
        if (!$todo) 
        {
            return redirect('todo')->with('error', 'Todo not found.');
        }
        $todoStatus = TodoService::UpdateService($request,$todo);
        if ($todoStatus) //checking todo status
        {
            return redirect('todo')->with('success', 'Todo successfully updated.');
        } 
        else //else it will redirect to /todo with error message
        {
            return redirect('todo')->with('error', 'Oops something went wrong. Todo not updated');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userId = TodoService::getuseridservice(); //get user id
        $todo=TodoService::GetDeleteService($id);
        if (!$todo)
        {
            $respStatus = 'error';
            $respMsg = 'Todo not found';
        }
        $todoDelStatus=TodoService::DeleteService($todo);
        if ($todoDelStatus) // checking todo status if success then prrint success message
        {
            $respStatus = 'success';
            $respMsg = 'Todo deleted successfully';
        }
        else // else it will print oops message
        {
            $respStatus = 'error';
            $respMsg = 'Oops something went wrong. Todo not deleted successfully';
        }
        return redirect('todo')->with($respStatus, $respMsg);
    }

}
