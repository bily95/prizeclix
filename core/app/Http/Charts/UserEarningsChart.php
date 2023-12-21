<?php

namespace App\Http\Charts;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;


class UserEarningsChart
{



  public function chart()
  {
    return  new LaravelChart($this->chartOption());
  }


  protected function chartOption()
  {
    return [
      'chart_title' => 'Earning Last 30 days',

      'report_type' => 'group_by_date',

      'model' => 'App\Models\Transaction',

      'group_by_field' => 'created_at',
      'group_by_period' => 'day',

      'date_format' => 'y-m-d',

      'aggregate_function' => 'sum',
      'aggregate_field' => 'amount',

      'chart_type' => 'line',

      'filter_period' => 'month',
      'filter_days' => 30,

      'continuous_time' => true,
      'show_blank_data' => true,

      'chart_color' => '0,0,0',
      'chart_height' => 400,
    ];
  }
}
