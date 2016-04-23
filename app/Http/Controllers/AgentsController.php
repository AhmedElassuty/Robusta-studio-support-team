<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\User;
use Auth;
use Input;
use Redirect;
use Session;

class AgentsController extends Controller
{
    protected static $rules = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $user = new User(Input::all());
        // process
        if ($user->save()) {
            // redirect
            Session::flash('message', 'Successfully created Agent!');
            return Redirect::action('AgentsController@show', @$user);
        } else {
            // redirect
            Session::flash('message', $user->getErrors());
            return Redirect::back();
        }
    }

    /**
     * Update an existing resource in storage.
     *
     * @return Response
     */
    public function update($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return Redirect::back();
        }
        // process
        if ($user->update(Input::all())) {
            // redirect
            Session::flash('message', 'Successfully created Agent!');
            return Redirect::action('AgentsController@show', @$user);
        } else {
            // redirect
            Session::flash('message', $user->getErrors());
            return Redirect::back();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return Redirect::back();
        }
        return view('agents.show', ['user' => Auth::user(), 'agent' => $user]);
    }


    /**
     *Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return Redirect::back();
        }
        return view('agents.edit', ['user' => Auth::user(), 'agent' => $user]);
    }

}