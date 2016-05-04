<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::auth();
    // Single Routes
    Route::get('/', [function () {
        return view('landing');
    }]);

    Route::get('/get-skin', function () {
        return response(view('skin'))->header('Content-Type', 'text/css');
    });

    Route::group(['middleware' => ['auth']], function () {

        Route::group(['prefix' => 'home'], function () {
            Route::get('', ['uses' => 'HomeController@index']);
        });

        Route::group(['prefix' => 'department'], function () {
            Route::get('free/{id}', ['as' => 'departments.free', 'uses' => 'DepartmentsController@freeAgents'])->where('id', '[1-9][0-9]*');
        });

        // Resources
        Route::resource('ticket', 'TicketsController', ['only' => [
            'store'
        ]]);

        Route::resource('customers', 'CustomersController', ['except' => [
            'index', 'create'
        ]]);
        Route::post('/customers/{customer}/edit', function ($id) {
            return redirect()->route('customers.edit', [$id]);
        });

        Route::resource('comments', 'CommentsController', ['only' => ['store']]);

        //AGENT
        Route::group(['prefix' => 'agent'], function () {
            Route::post('/agents/{agent}/edit', function ($id) {
                return redirect()->route('agents.edit', [$id]);
            });
        });

        Route::resource('agents', 'AgentsController', ['except' => [
            'create'
        ]]);

        //TICKET
        Route::group(['prefix' => 'tickets'], function () {

            Route::group(['middleware' => 'userRole:Admin,Supervisor'], function () {
                Route::delete('{id}', ['as' => 'tickets.destroy', 'uses' => 'TicketsController@destroy'])->where('id', '[1-9][0-9]*');
            });

            Route::get('pool', ['as' => 'tickets.pool', 'uses' => 'TicketsController@pool']);
            Route::post('{id}/claim', ['as' => 'tickets.claim', 'uses' => 'TicketsController@claim'])->where('id', '[1-9][0-9]*');

            // CRUD
            Route::get('create', ['as' => 'tickets.new', 'uses' => 'TicketsController@new']);
            Route::get('', ['as' => 'tickets.index', 'uses' => 'TicketsController@index']);
            Route::get('{id}/edit', ['as' => 'tickets.edit', 'uses' => 'TicketsController@edit'])->where('id', '[1-9][0-9]*');
            Route::post('', ['as' => 'tickets.store', 'uses' => 'TicketsController@store']);

            Route::put('{id}', ['as' => 'tickets.update', 'uses' => 'TicketsController@update'])->where('id', '[1-9][0-9]*');
            Route::get('{id}', ['as' => 'tickets.show', 'uses' => 'TicketsController@show'])->where('id', '[1-9][0-9]*');

            Route::post('{id}/comment', ['as' => 'tickets.comment.store', 'uses' => 'CommentsController@store'])
                ->where('id', '[1-9][0-9]*');
            Route::post('feed', ['as' => 'tickets.feed', 'uses' => 'TicketsController@from_feed']);

            Route::put('{id}/toggle_status', ['as' => 'tickets.toggle_status', 'uses' => 'TicketsController@toggle_status']);
            Route::put('{id}/toggle_vip', ['as' => 'tickets.toggle_vip', 'uses' => 'TicketsController@toggle_vip']);
        });

        // ADMIN ONLY
        Route::group(['middleware' => 'userRole:Admin'], function () {

            Route::resource('priorities', 'PrioritiesController', ['except' => [
                'show'
            ]]);

            Route::resource('label', 'LabelsController', ['only' => [
                'store'
            ]]);
            Route::group(['prefix' => 'home'], function () {
                Route::post('', ['uses' => 'HomeController@store']);
                Route::post('twitter',['uses' => 'HomeController@twitterSettings','as'=>'home.twitter']);

            });
        });

        // ADMIN AND SUPERVISOR
        Route::group(['middleware' => 'userRole:Admin,Supervisor'], function () {

            Route::resource('departments', 'DepartmentsController');


            Route::group(['prefix' => 'department'], function () {
                Route::get('supervisor', ['as' => 'departments.supervisor', 'uses' => 'DepartmentsController@freeSupervisors'])->where('id', '[1-9][0-9]*');
            });
        });

        // AGENT ONLY
        Route::group(['middleware' => 'userRole:Agent'], function () {
            Route::get('workspace', ['as' => 'agents.workspace', 'uses' => 'AgentsController@workspace']);
            Route::get('closed', ['as' => 'agents.closed', 'uses' => 'AgentsController@closedTickets']);
        });
    });
});
