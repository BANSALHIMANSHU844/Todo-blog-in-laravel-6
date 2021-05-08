<?php
namespace App\Services;
use Illuminate\Http\Request;

use App\Repositories\TodoRepository;

class TodoService
{
    public static function StoreService(Request $request)
    {
        $input = $request->input(); //store the input in $input variable
        $input['user_id'] = TodoRepository::getuseridrepository();
        return TodoRepository::StoreRepository($input);
    }

    public static function getuseridservice()
    {
        return TodoRepository::getuseridrepository();
    }

    public static function IndexService()
    {
        return TodoRepository::IndexRepository();
    }

    public static function ShowService($id)
    {
        return TodoRepository::ShowRepository($id);
    }

    public static function EditService($id)
    {
        return TodoRepository::EditRepository($id);
    }

    public static function FindService($id)
    {
        return TodoRepository::FindRepository($id);
    }

    public static function UpdateService(Request $request,$todo)
    {
        $input = $request->input(); //store the input in $input variable
        $input['user_id'] = TodoService::getuseridservice();
        return TodoRepository::UpdateRepository($input,$todo);
    }

    public static function GetDeleteService($id)
    {
        $respStatus = $respMsg = '';
        return TodoRepository::GetDeleteRepository($id);
    }

    public static function DeleteService($todo)
    {
        return TodoRepository::DeleteRepository($todo);
    }
}
