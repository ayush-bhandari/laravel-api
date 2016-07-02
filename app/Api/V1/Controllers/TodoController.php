<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use JWTAuth;
use App\Todo;

use App\User;

use Dingo\Api\Routing\Helpers;


class TodoController extends Controller
{
    
        use Helpers;
        public function index(){
          $currentUser = JWTAuth::parseToken()->authenticate();
          return response()->json($currentUser->todos()->get()->toArray());

        }

        public function show()
		{


   				$currentUser = JWTAuth::parseToken()->authenticate();
		}
		public function store(Request $request)
		{
    			$currentUser = JWTAuth::parseToken()->authenticate();
    			
    				
   				 $todo = new Todo;

   				 $todo->title = $request->get('title');
   				 $todo->todo = $request->get('todo');
   				 $todo->deadline = $request->get('deadline');

    			if($currentUser->todos()->save($todo))
       				 return $this->response->created();
    			else
    				    return $this->response->error('could_not_create_todo', 500);

    			
		}

		public function destroy($id)
		{
   			 $currentUser = JWTAuth::parseToken()->authenticate();

    		$todo = $currentUser->todos()->find($id);

    		if(!$todo)
        		throw new NotFoundHttpException;

    		if($todo->delete())
        		return $this->response->noContent();
    		else
        		return $this->response->error('could_not_delete_todo', 500);
		}


}