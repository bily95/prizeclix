<?php 

namespace App\Http\Charts;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;


class AdminUsersChart {



    public function chart()
    {
        return  new LaravelChart($this->chartOption());
    }


    protected function chartOption()
    {
        return [
            'chart_title' => 'Registered users Last 30 days',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'line',
            'filter_period' => 'month',
            'filter_days' => 30,
            'continuous_time' => true,
            'show_blank_data' => true,
        ];
    }
}