<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Illuminate\Http\Request;
use App\Todo;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TodoController;

/**
 * Class TodoRepository.
 */
class TodoRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    public static function StoreRepository($input)
    {
         return Todo::create($input); 
    }

    public static function getuseridrepository()
    {
        return Auth::user()->id; //return user id
    }

    public static function IndexRepository()
    {
        return Todo::where(['user_id' => Auth::user()->id])->get(); 
    }

    public static function ShowRepository($id)
    {
        return Todo::where(['user_id' => Auth::user()->id ,'id'=> $id])->first(); 
    }

    public static function EditRepository($id)
    {
        return Todo::where(['user_id' => Auth::user()->id, 'id' => $id])->first(); 
    }

    public static function FindRepository($id)
    {
        return Todo::find($id);
    }

    public static function UpdateRepository($input,$todo)
    {
        return $todo->update($input); //updating todo using input we gave
    }

    public static function GetDeleteRepository($id)
    {
        return Todo::where(['user_id' => Auth::user()->id, 'id' => $id])->first();
    }

    public static function DeleteRepository($todo)
    {
        return $todo->delete(); //deleting todo 
    }
}
