<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Message;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('message.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Message::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
        $response = $request->validate([
            'status' => 'required'
        ]);
        return Message::whereId($id)->update($response) ? 1 : 0;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return Message::findOrFail($id)->delete() ? 1 : 0;
    }

    public function getAll(){
        $messages = Message::getAllMessages();
        foreach ($messages as $message) {
            if ($message->reason == 2) {
                 $message->reason = 'Ser Colaborador';
             }else if($message->reason == 3){
                $message->reason = 'Rescate';
             }else{
                $message->reason = 'Otros';
             }

             if ($message->status ==  1) {
                 $message->status = 'Atendido';
             }else{
                $message->status = 'Pendiente';
             }
             
            $message->fullName = $message->name.' '.$message->lastName;
        }
        
        return datatables()->of($messages)
            ->addColumn('btn', 'message.actions')
            ->addColumn('btn-status', 'message.status')
            ->addIndexColumn()
            ->rawColumns(['btn', 'btn-status'])
            ->toJson();
    }
}
