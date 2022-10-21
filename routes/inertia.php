<?php

use Illuminate\Support\Facades\Route;
use Laravel\Nova\Http\Requests\NovaRequest;

use App\Models\Task;
use App\Models\Project;

/*
|--------------------------------------------------------------------------
| Tool Routes
|--------------------------------------------------------------------------
|
| Here is where you may register Inertia routes for your tool. These are
| loaded by the ServiceProvider of the tool. The routes are protected
| by your tool's "Authorize" middleware by default. Now - go build!
|
*/

Route::get('/', function (
    NovaRequest $request,
    Task $task,
    Project $project
) {
    $user = $request->user();
    $team = $request->user()->organization;
    $tasks = [];
    if (true || $request->user()->can('viewAny', $task)):
        foreach (getScheludesScheme() as $mainkey => $mainscheme):
            $tasks_collection = [];
            foreach (getPrioritiesScheme() as $key => $scheme):
                $tasks_query = $task
                    ->where('schelude', $mainkey)
                    ->where('priority', $key)
                    ->with('task_type')
                    ->with('subtasks')
                    ->with('project')
                    ->get()
                    ->toArray();
                $tasks_collection = array_merge($tasks_collection, $tasks_query);
                unset($tasks_query);
            endforeach;
            $tasks[] = [
                'title' => $mainscheme,
                'data'  => $tasks_collection
            ];
            unset($tasks_collection);
        endforeach;
    else:
        $tasks;
    endif;

    return inertia('Summary', [
        'data' => [
            'user'              => [
                'title'         => 'Użytkownik',
                'data'          => $user,
            ],
            'team'              => [
                'title'         => 'Zespół',
                'data'          => $team,
            ],
            'schemes'           => [
                'priorities'    => getPrioritiesScheme(),
                'scheludes'     => getScheludesScheme(),
                'statuses'      => getStatusesScheme(),
                'stages'        => getStagesScheme(),
            ],
            'tasks'             => $tasks,
        ]
    ]);
});
