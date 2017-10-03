<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Validator;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all Data
        $items = Item::all();
        return response()->json($items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Add data
        $validator = Validator::make($request->all(),[
            "text" => "required",
            "body" => "required",
        ]);

        if($validator->fails()){
            $response = "failed";
            //$response = array('response' => $validator->message(), 'success' => false);
            return $response;
        }
        else{
            $item = new Item;
            $item->text = $request->input('text');
            $item->body = $request->input('body');
            $item->save();

            $response = "success";
            return $response;
            //return response()->json($item);
        }
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        //Find 1 specific data
        $items = Item::find($id);
        return response()->json($items);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Update data
        $validator = Validator::make($request->all(),[
            "text" => "required",
            "body" => "required",
        ]);

        if($validator->fails()){
            $response = "failed";
            //$response = array('response' => $validator->message(), 'success' => false);
            return $response;
        }
        else{
            $item = Item::find($id);
            $item->text = $request->input('text');
            $item->body = $request->input('body');
            $item->save();

            $response = "success";
            return $response;
            //return response()->json($item);
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
        //Delete Data
        $item = Item::find($id);
        $item->delete();

        if($item){
            $response = "success";
            return $response;
            //return array('response' => 'Item deleted', 'success' => true);
        }
        else{
            $response = "failed";
            return $response; 
        }
        

    }
}
