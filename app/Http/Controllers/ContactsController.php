<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $params = $request->all();
        $jsonString = file_get_contents(base_path('public/data.json'));

        $data = collect(json_decode($jsonString, true))->map(function ($item, $key) {
            return $item['item'];
        })->collapse();

        $data = $data->where('isActive', true);
        $total = $data->count();

        $data = $data->slice($params['slice'] ?? 0, $params['perPage'] ?? 2);

        if(isset($params['sortName']) && $params['sort'] == 'asc'){
            $data = $data->sortBy($params['sortName']);
        }elseif(isset($params['sortName']) && $params['sort'] == 'desc'){
            $data = $data->sortByDesc($params['sortName']);
        }

        if($request->ajax()){
            return response()->json($data->values()->all());
        }else{
            return view('welcome',compact('data', 'total'));
        }
    }
}
