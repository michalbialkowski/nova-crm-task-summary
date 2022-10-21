<?php

namespace Michalbialkowski\NovaCrmTaskSummary;

use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NovaCrmTaskSummary extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('nova-crm-task-summary', __DIR__.'/../dist/js/tool.js');
        Nova::style('nova-crm-task-summary', __DIR__.'/../dist/css/tool.css');
    }

    /**
     * Build the menu that renders the navigation links for the tool.
     *
     * @param  \Illuminate\Http\Request $request
     * @return mixed
     */
    public function menu(Request $request)
    {
        return MenuSection::make('Nova Crm Task Summary')
            ->path('/nova-crm-task-summary')
            ->icon('server');
    }
}
