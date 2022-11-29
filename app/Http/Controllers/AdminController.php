<?php

namespace App\Http\Controllers;

use App\Models\departments;
use App\Models\departments_service;
use App\Models\survey_responses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {

        // $responses = survey_responses::all();

        // $departments = departments::all();




        // return view('admin.index', compact('responses','departments'));
    }


    public function get_responses(Request $request)
    {

        $responses = survey_responses::orderBy('response_id', 'DESC')->get();
        $departments = departments::all();


        return view('admin.index', compact('responses','departments'));
    }

    public function update_responses(Request $request)
    {

    }


    public function get_clients(Request $request)
    {


      $getYears = (DB::select('select substring(created_at,1,4) as year from survey_responses order by year desc'));

      $years = collect($getYears)->unique('year');

      $today= Carbon::now();

      $prev_year =  Carbon::now()->subYears(1);

      $startDate = $prev_year->format('Y-m-15'); // prev

      $endDate = $today->format('Y-m-15'); // year today

      $period = \Carbon\CarbonPeriod::create($startDate, '1 month', $endDate);


      $p = array();

      $clients = array();

      $labels = array();

      foreach ($period as $date) {

        $p[] = $date->format('Y-m');

        $labels[] = $date->format('F Y');

        $clients[] = survey_responses::where('created_at','like', $date->format('Y-m').'%')->count();

      }

      $departments = departments::all();

      $division = $this->division;

      $division_responses = array();


      foreach($division as $key => $div)
      {
        $dept_id = $departments->where('division',$key)->pluck('dept_id');

        $division_responses[$key] = survey_responses::whereIn('dept_id', $dept_id)->where('created_at','like',date('Y-m').'%')->count();

      }

      foreach($departments  as $dept)
      {

        $dept_comment[$dept->acronym] = survey_responses::where('dept_id',$dept->dept_id)->where('created_at','like',date('Y-m').'%')->whereNotNull('comment')->pluck('comment');


      }


      $responses = survey_responses::where('created_at','like',date('Y-m').'%')->get();

      return view('admin.ClientSummary',compact('dept_comment','labels' ,'clients', 'responses','departments','division','division_responses','years'));
    }

    public function update_clients(Request $request)
    {


      $req_month = $request->c_month; // month change

      $req_year = $request->c_year;

      $req_prev_year = $req_year-1;

      $c_year = Carbon::parse($req_year.'-'.$req_month.'-15');  // year change  end date

      $prev_year = Carbon::parse($req_prev_year.'-'.$req_month.'-15'); // prev year change start date


      $period = \Carbon\CarbonPeriod::create( $prev_year, '1 month',  $c_year);


      $p = array();

      $clients = array();

      $labels = array();

      foreach ($period as $date) {

        $p[] = $date->format('Y-m');

        $labels[] = $date->format('F Y');

        $clients[] = survey_responses::where('created_at','like', $date->format('Y-m').'%')->count();

      }

      $departments = departments::all();

      $division = $this->division;

      $division_responses = array();

      foreach($division as $key => $div)
      {
        $dept_id = $departments->where('division',$key)->pluck('dept_id');

        $division_responses[$key] = survey_responses::whereIn('dept_id', $dept_id)->where('created_at','like',date('Y-m',strtotime($c_year)).'%')->count();

      }


      $responses = survey_responses::where('created_at','like',date('Y-m',strtotime($c_year)).'%')->get();


      return view('admin.ClientSummaryData', compact('labels' ,'clients', 'responses','departments','division','division_responses'));


    }

    public function get_quantitative(Request $request)
    {
      $getYears = (DB::select('select substring(created_at,1,4) as year from survey_responses order by year desc'));

      $years = collect($getYears)->unique('year');

      $today= Carbon::now();

      $prev_year =  Carbon::now()->subYears(1);

      $startDate = $prev_year->format('Y-m-15'); // prev

      $endDate = $today->format('Y-m-15'); // year today

      $period = \Carbon\CarbonPeriod::create($startDate, '1 month', $endDate);


      $p = array();

      $clients = array();

      $labels = array();

      foreach ($period as $date) {

        $p[] = $date->format('Y-m');

        $labels[] = $date->format('F Y');

        $clients[] = survey_responses::where('created_at','like', $date->format('Y-m').'%')->pluck('rating')->avg();

      }  // for line graph

      $departments = departments::all();

      $division = $this->division;

      $division_responses = array();

      foreach($division as $key => $div)
      {
        $dept_id = $departments->where('division',$key)->pluck('dept_id');

        $division_responses[$key] = survey_responses::whereIn('dept_id', $dept_id)->where('created_at','like',date('Y-m').'%')->pluck('rating')->avg();

      }

      $responses = survey_responses::where('created_at','like',date('Y-m').'%')->get();

        return view('admin.Quantitative',compact('labels' ,'clients', 'responses','departments','division','division_responses','years'));
    }

    public function update_quantitative(Request $request)
    {


      $req_month = $request->c_month; // month change

      $req_year = $request->c_year;

      $req_prev_year = $req_year-1;

      $req_dept_id = $request->c_dept;

      $c_year = Carbon::parse($req_year.'-'.$req_month.'-15');  // year change  end date

      $prev_year = Carbon::parse($req_prev_year.'-'.$req_month.'-15'); // prev year change start date


      $period = \Carbon\CarbonPeriod::create( $prev_year, '1 month',  $c_year);


      $p = array();

      $clients = array();

      $labels = array();

      foreach ($period as $date) {

        $p[] = $date->format('Y-m');

        $labels[] = $date->format('F Y');

        if($req_dept_id)

            {

               $clients[] = survey_responses::where('dept_id',$req_dept_id)->where('created_at','like', $date->format('Y-m').'%')->pluck('rating')->avg();

            }

            else
            {

                $clients[] = survey_responses::where('created_at','like', $date->format('Y-m').'%')->pluck('rating')->avg();

            }

      }


      $departments = departments::all();

      $division = $this->division;

      $division_responses = array();

      foreach($division as $key => $div)
      {
        $dept_id = $departments->where('division',$key)->pluck('dept_id');

        $division_responses[$key] = survey_responses::whereIn('dept_id', $dept_id)->where('created_at','like',date('Y-m',strtotime($c_year)).'%')->pluck('rating')->avg();


      }

      $responses = survey_responses::where('created_at','like',date('Y-m',strtotime($c_year)).'%')->get();


      return view('admin.QuantitativeData',compact('labels' ,'clients', 'responses','departments','division','division_responses'));
    }

    public function get_qualitative()
    {

      $getYears = (DB::select('select substring(created_at,1,4) as year from survey_responses order by year desc'));

      $years = collect($getYears)->unique('year');

      $today= Carbon::now();

      $prev_year =  Carbon::now()->subYears(1);

      $startDate = $prev_year->format('Y-m-15'); // prev

      $endDate = $today->format('Y-m-15'); // year today

      $departments = departments::orderBy('level', 'ASC')->orderBy('name','ASC')->get();

      $period = \Carbon\CarbonPeriod::create($startDate, '1 month', $endDate);

      $p = array();

      $clients = array();

      $labels = array();




      $division = $this->division;

      $division_responses = array();

      $dept_comment = array();

      foreach($departments  as $dept)
      {

        $dept->comment = survey_responses::where('dept_id',$dept->dept_id)->where('created_at','like',date('Y-m').'%')->whereNotNull('comment')->get();


      }


      $responses = survey_responses::where('created_at','like',date('Y-m').'%')->get();

      $staff = $responses->pluck('staff');



        return view('admin.Qualitative',compact('staff','labels' ,'clients', 'responses','departments','division','division_responses','years'));
    }

    public function update_qualitative(Request $request)
    {


      $req_month = $request->c_month; // month change

      $req_year = $request->c_year;

      $req_prev_year = $req_year-1;

      $req_dept_id = $request->c_dept;



      $c_year = Carbon::parse($req_year.'-'.$req_month.'-15');  // year change  end date

      $prev_year = Carbon::parse($req_prev_year.'-'.$req_month.'-15'); // prev year change start date


      $period = \Carbon\CarbonPeriod::create( $prev_year, '1 month',  $c_year);


      $p = array();

      $clients = array();

      $labels = array();

      foreach ($period as $date) {

        $p[] = $date->format('Y-m');

        $labels[] = $date->format('F Y');

        $clients[] = survey_responses::where('created_at','like', $date->format('Y-m').'%')->count();

      }

      $departments = departments::all();

      $division = $this->division;

      $division_responses = array();



      foreach($departments  as $dept)
      {


        $dept->comment = survey_responses::where('dept_id',$dept->dept_id)->where('created_at','like',date('Y-m',strtotime($c_year)).'%')->whereNotNull('comment')->get();

      }



      $responses = survey_responses::where('created_at','like',date('Y-m',strtotime($c_year)).'%')->get();




      return view('admin.QualitativeData', compact('labels' ,'clients', 'responses','departments','division','division_responses'));

    }



    public function get_overallRatings()
    {
        $getYears = (DB::select('select substring(created_at,1,4) as year from survey_responses order by year desc'));

        $years = collect($getYears)->unique('year');

        $today= Carbon::now();

        $req_dept_id= "";

        $prev_year =  Carbon::now()->subYears(1);

        $startDate = $prev_year->format('Y-m-15'); // prev

        $endDate = $today->format('Y-m-15'); // year today

        $period = \Carbon\CarbonPeriod::create($startDate, '1 month', $endDate);

        $departments = departments::all();

        $responses = survey_responses::where('created_at','like',date('Y-m').'%')->get();

        // start of division data

        $division = $this->division;

        $division_responses = array();

        $div_delivery = array();

        $div_communication = array();

        $div_qStaff = array();

        $div_qWork = array();

         $div_pSolving = array();

        foreach($division as $key => $div)
        {

          $dept_id = $departments->where('division',$key)->pluck('dept_id');

          $division_responses[$key] = survey_responses::whereIn('dept_id', $dept_id)->where('created_at','like',date('Y-m').'%')->get();

          $div_d = array();

          $div_c = array();

          $div_qS = array();

          $div_qW = array();

          $div_pS = array();

          if($division_responses[$key]->isEmpty())

                  {

                    $div_d[] = 0;
                    $div_c[] = 0;
                    $div_qS[] = 0;
                    $div_qW[] = 0;
                    $div_pS[] = 0;

                    $div_ave_d = 0;
                    $div_ave_c = 0;
                    $div_ave_qS = 0;
                    $div_ave_qW = 0;
                    $div_ave_pS = 0;

                  }

                  else

                  {

                      $div_ave = $division_responses[$key]->pluck("average");

                          foreach($div_ave as $g_ave)
                          {
                            $div_a =  json_decode($g_ave); // average na lima

                            $div_d[] =  $div_a[0];

                            $div_c[] =  $div_a[1];

                            $div_qS[] =  $div_a[2];

                            $div_qW[] =  $div_a[3];

                            $div_pS[] =  $div_a[4];

                          }


                          $div_ave_d = array_sum($div_d) / count($div_d);

                          $div_ave_c = array_sum($div_c) / count($div_c);

                          $div_ave_qS = array_sum($div_qS) / count($div_qS);

                          $div_ave_qW = array_sum($div_qW) / count($div_qW);

                          $div_ave_pS = array_sum($div_pS) / count($div_pS);

                } // end of else

                          $div_delivery[$key] = number_format($div_ave_d,2,'.','.');

                          $div_communication[$key] = number_format($div_ave_c,2,'.','.');

                          $div_qStaff[$key] = number_format($div_ave_qS,2,'.','.');

                          $div_qWork[$key] = number_format($div_ave_qW,2,'.','.');

                          $div_pSolving[$key] = number_format($div_ave_pS,2,'.','.');

        } // end of foreach for division

        // end for division data

        // start of data for department

 // for graph
 foreach($departments  as $dept)

 {

     $delivery = array();

     $communications = array();

     $qStaff = array();

     $qWork = array();

     $pSolving = array();

     $dept_rspns = $responses->where('dept_id',$dept->dept_id);




   if($dept_rspns->isEmpty())

   {
       $dept->delivery = "";

       $dept->communications = "";

       $dept->qStaff = "";

       $dept->qWork = "";

       $dept->pSolving =  "";

   }

 else

 {
       $average =  $dept_rspns->pluck('average');



       foreach($average as $ave)

         {

               $avg_rspns =  json_decode($ave);

               $delivery[] =  $avg_rspns[0];

               $communications[] =  $avg_rspns[1];

               $qStaff[] =  $avg_rspns[2];

               $qWork[] =  $avg_rspns[3];

               $pSolving[] =  $avg_rspns[4];


         }

               $dept->delivery = array_sum($delivery) / count($delivery);

               $dept->communications = array_sum($communications) / count($communications);

               $dept->qStaff = array_sum($qStaff) / count($qStaff);

               $dept->qWork = array_sum($qWork) / count($qWork);

               $dept->pSolving = array_sum($pSolving) / count($pSolving);


     }
 }


        //end data for department

        //start of graph data


      $p = array();

      $clients = array();

      $labels = array();

      $graph_delivery = array();

      $graph_communications = array();

      $graph_qStaff = array();

      $graph_qWork = array();

      $graph_pSolving = array();

      foreach ($period as $date)

          {

                $p[] = $date->format('Y-m');

                $labels[] = $date->format('F Y');

                //overall ratings for graph

                $d = array();

                $c = array();

                $qS = array();

                $qW = array();

                $pS = array();

                $graph_rspns = survey_responses::where('created_at','like', $date->format('Y-m').'%')->get();

                if($graph_rspns->isEmpty())

                {

                  $d[] = 0;
                  $c[] = 0;
                  $qS[] = 0;
                  $qW[] = 0;
                  $pS[] = 0;

                  $ave_d = 0;
                  $ave_c = 0;
                  $ave_qS = 0;
                  $ave_qW = 0;
                  $ave_pS = 0;

                }

                else

                {

                    $graph_ave = $graph_rspns->pluck("average");

                        foreach($graph_ave as $g_ave)
                        {
                          $a =  json_decode($g_ave); // average na lima

                          $d[] =  $a[0];

                          $c[] =  $a[1];

                          $qS[] =  $a[2];

                          $qW[] =  $a[3];

                          $pS[] =  $a[4];

                        }


                        $ave_d = array_sum($d) / count($d);

                        $ave_c = array_sum($c) / count($c);

                        $ave_qS = array_sum($qS) / count($qS);

                        $ave_qW = array_sum($qW) / count($qW);

                        $ave_pS = array_sum($pS) / count($pS);
              }


                        $graph_delivery[] = number_format($ave_d,2,'.','.');

                        $graph_communications[] = number_format($ave_c,2,'.','.');

                        $graph_qStaff[] = number_format($ave_qS,2,'.','.');

                        $graph_qWork[] = number_format($ave_qW,2,'.','.');

                        $graph_pSolving[] = number_format($ave_pS,2,'.','.');


          }

        // end of graph data





          return view('admin.OverallRatings',compact('responses','departments','division','division_responses','years','div_delivery','div_communication','div_qStaff','div_qWork','div_pSolving','req_dept_id','labels','graph_delivery','graph_communications','graph_qStaff','graph_qWork','graph_pSolving'));

    }

    public function update_overallRatings(Request $request)
    {

        $req_month = $request->c_month; // month change

        $req_year = $request->c_year;

        $req_prev_year = $req_year-1;

        $req_dept_id = $request->c_dept;

        $c_year = Carbon::parse($req_year.'-'.$req_month.'-15');  // year change  end date

        $prev_year = Carbon::parse($req_prev_year.'-'.$req_month.'-15'); // prev year change start date

        $period = \Carbon\CarbonPeriod::create( $prev_year, '1 month',  $c_year);

        $departments = departments::all();

        $responses = survey_responses::where('created_at','like',date('Y-m',strtotime($c_year)).'%')->get();

         // start of division data

        $division = $this->division;

         $division_responses = array();

         $div_delivery = array();

          $div_communication = array();

          $div_qStaff = array();

          $div_qWork = array();

          $div_pSolving = array();

        foreach($division as $key => $div)
        {

          $dept_id = $departments->where('division',$key)->pluck('dept_id');

          $division_responses[$key] = survey_responses::whereIn('dept_id', $dept_id)->where('created_at','like',date('Y-m',strtotime($c_year)).'%')->get();

          $div_d = array();

          $div_c = array();

          $div_qS = array();

          $div_qW = array();

          $div_pS = array();

          if($division_responses[$key]->isEmpty())

                  {

                    $div_d[] = 0;
                    $div_c[] = 0;
                    $div_qS[] = 0;
                    $div_qW[] = 0;
                    $div_pS[] = 0;

                    $div_ave_d = 0;
                    $div_ave_c = 0;
                    $div_ave_qS = 0;
                    $div_ave_qW = 0;
                    $div_ave_pS = 0;

                  }

                  else

                  {

                      $div_ave = $division_responses[$key]->pluck("average");

                          foreach($div_ave as $g_ave)
                          {
                            $div_a =  json_decode($g_ave); // average na lima

                            $div_d[] =  $div_a[0];

                            $div_c[] =  $div_a[1];

                            $div_qS[] =  $div_a[2];

                            $div_qW[] =  $div_a[3];

                            $div_pS[] =  $div_a[4];

                          }


                          $div_ave_d = array_sum($div_d) / count($div_d);

                          $div_ave_c = array_sum($div_c) / count($div_c);

                          $div_ave_qS = array_sum($div_qS) / count($div_qS);

                          $div_ave_qW = array_sum($div_qW) / count($div_qW);

                          $div_ave_pS = array_sum($div_pS) / count($div_pS);

                } // end of else

                          $div_delivery[$key] = number_format($div_ave_d,2,'.','.');

                          $div_communication[$key] = number_format($div_ave_c,2,'.','.');

                          $div_qStaff[$key] = number_format($div_ave_qS,2,'.','.');

                          $div_qWork[$key] = number_format($div_ave_qW,2,'.','.');

                          $div_pSolving[$key] = number_format($div_ave_pS,2,'.','.');




        } // end of foreach for division

        // end for division data

        // start of department data

        foreach($departments  as $dept)

                {

                    $delivery = array();

                    $communications = array();

                    $qStaff = array();

                    $qWork = array();

                    $pSolving = array();

                    $dept_rspns = $responses->where('dept_id',$dept->dept_id);




                  if($dept_rspns->isEmpty())

                  {
                      $dept->delivery = "";

                      $dept->communications = "";

                      $dept->qStaff = "";

                      $dept->qWork = "";

                      $dept->pSolving =  "";

                  } // end of if on dept_rspns

                else

                {
                      $average =  $dept_rspns->pluck('average');



                      foreach($average as $ave)

                        {

                              $avg_rspns =  json_decode($ave);

                              $delivery[] =  $avg_rspns[0];

                              $communications[] =  $avg_rspns[1];

                              $qStaff[] =  $avg_rspns[2];

                              $qWork[] =  $avg_rspns[3];

                              $pSolving[] =  $avg_rspns[4];


                        } // end of foreach of average

                              $dept->delivery = array_sum($delivery) / count($delivery);

                              $dept->communications = array_sum($communications) / count($communications);

                              $dept->qStaff = array_sum($qStaff) / count($qStaff);

                              $dept->qWork = array_sum($qWork) / count($qWork);

                              $dept->pSolving = array_sum($pSolving) / count($pSolving);


                    } // end of else

                } // end of foreach of department

        // end of department data


        // start of graph data

        $p = array();

        $clients = array();

        $labels = array();

        $graph_delivery = array();

        $graph_communications = array();

        $graph_qStaff = array();

        $graph_qWork = array();

        $graph_pSolving = array();

    foreach ($period as $date)

    {

      $p[] = $date->format('Y-m');

      $labels[] = $date->format('F Y');

      $clients[] = survey_responses::where('created_at','like', $date->format('Y-m').'%')->count();

          //overall ratings for graph


          $d = array();

          $c = array();

          $qS = array();

          $qW = array();

          $pS = array();

          if($req_dept_id == 0)

          {
            $graph_rspns = survey_responses::where('created_at','like', $date->format('Y-m').'%')->get();

          }

          else

          {

            $graph_rspns = survey_responses::where('dept_id', $req_dept_id)->where('created_at','like', $date->format('Y-m').'%')->get();
          }


          if($graph_rspns->isEmpty())

          {

            $d[] = 0;
            $c[] = 0;
            $qS[] = 0;
            $qW[] = 0;
            $pS[] = 0;

            $ave_d = 0;
            $ave_c = 0;
            $ave_qS = 0;
            $ave_qW = 0;
            $ave_pS = 0;

          } // end of if ng empty

          else

          {

              $graph_ave = $graph_rspns->pluck("average");

                  foreach($graph_ave as $g_ave)
                  {
                    $a =  json_decode($g_ave); // average na lima

                    $d[] =  $a[0];

                    $c[] =  $a[1];

                    $qS[] =  $a[2];

                    $qW[] =  $a[3];

                    $pS[] =  $a[4];

                  } // end of fearch of graph


                  $ave_d = array_sum($d) / count($d);

                  $ave_c = array_sum($c) / count($c);

                  $ave_qS = array_sum($qS) / count($qS);

                  $ave_qW = array_sum($qW) / count($qW);

                  $ave_pS = array_sum($pS) / count($pS);

        } // end of else


                  $graph_delivery[] = number_format($ave_d,2,'.','.');

                  $graph_communications[] = number_format($ave_c,2,'.','.');

                  $graph_qStaff[] = number_format($ave_qS,2,'.','.');

                  $graph_qWork[] = number_format($ave_qW,2,'.','.');

                  $graph_pSolving[] = number_format($ave_pS,2,'.','.');


        }  // end of foreach of date


        // end of graph data


        return view('admin.OverAllData',compact('responses','departments','division','division_responses','div_delivery','div_communication','div_qStaff','div_qWork','div_pSolving','req_dept_id','labels','graph_delivery','graph_communications','graph_qStaff','graph_qWork','graph_pSolving'));

    }

    public function get_service()
    {

            $departments = departments::orderBy('level', 'ASC')->orderBy('name','ASC')->get();
            $dept_service = departments_service::orderBy('service_id', 'DESC')->get();

            return view('admin.service',compact('departments','dept_service'));
    }

    public function service_department(Request $request)
    {

        $dept_service = departments_service::where('dept_id',$request->dept_id)->orderBy('service_id', 'DESC')->get();

        return view('admin.serviceData',compact('dept_service'));
    }


    public function add_service(Request $request)
    {


        $s = new departments_service;
        $s -> dept_id = $request->dept_id;
        $s -> services = $request->service;
        $s -> save();

        $departments = departments::orderBy('level', 'ASC')->orderBy('name','ASC')->get();
        $dept_service = departments_service::where('dept_id',$request->dept_id)->orderBy('service_id', 'DESC')->get();

        return view('admin.ServiceData',compact('dept_service','departments'));
    }

    public function destroy_service(Request $request)
    {


        $service_id = $request->service_id;
        $service = departments_service::where('service_id',$service_id)->first();
        departments_service::where('service_id',$service_id)->delete();

        $dept_service = departments_service::where('dept_id',$service->dept_id)->orderBy('service_id', 'DESC')->get();


        return view('admin.ServiceData',compact('dept_service'));
    }


}
