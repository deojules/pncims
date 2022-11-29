<?php

namespace App\Http\Controllers;

use App\Models\departments;
use App\Models\departments_service;
use App\Models\employees;
use App\Models\employees_dept;
use App\Models\survey_items;
use App\Models\survey_responses;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function index()
    {
        if (!Auth::guard('student')->user() && !Auth::user() && !session('guest') )
        {
             return redirect('login');
        }

        $icons=$this->icons;

        $departments = departments::orderBy('level', 'ASC')->orderBy('name','ASC')->get();


        return view('user.index', compact('departments','icons'));
    }

    public function dept_quali($acronym)

    {


        $department = departments::where('acronym',$acronym)->first();

        $ed = employees_dept::where('p_id',Auth::user()->p_id)->where('dept_id',$department->dept_id)->first();

        if(!$ed)

        return redirect('survey');

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

        // for over all ratings

        $delivery = array();

        $communications = array();

        $qStaff = array();

        $qWork = array();

        $pSolving = array();

        $responses = survey_responses::where('created_at','like',date('Y-m').'%')->where('dept_id',$department->dept_id)->get();

        foreach ($period as $date)
        {

          $p[] = $date->format('Y-m');

          $labels[] = $date->format('F Y');

          $rspns = survey_responses::where('created_at','like', $date->format('Y-m').'%')->where('dept_id',$department->dept_id)->get();

          $client_avg = $rspns->pluck('rating')->avg();

          $clients[] = number_format($client_avg,2,'.',',');

          // for overall ratings

          $d = array();

          $c = array();

          $qS = array();

          $qW = array();

          $pS = array();


            if($rspns->isEmpty())
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

             $avg_rspns = $rspns->pluck('average');



                foreach($avg_rspns as $average)
                {
                    $a =  json_decode($average); // average na lima

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


            $delivery[] = number_format($ave_d,2,'.','.');

            $communications[] = number_format($ave_c,2,'.','.');

            $qStaff[] = number_format($ave_qS,2,'.','.');

            $qWork[] = number_format($ave_qW,2,'.','.');

            $pSolving[] = number_format($ave_pS,2,'.','.');



        }  // for line graph



       return view('user.qualitative',compact('years','responses','department',
                        'labels','clients','delivery','communications',
                        'qStaff','qWork','pSolving'));

    }

    public function update_dept_quali(Request $request , $acronym)
    {

        $department = departments::where('acronym',$acronym)->first();

        $req_month = $request->c_month; // month change

        $req_year = $request->c_year;

        $req_prev_year = $req_year-1;

        $c_year = Carbon::parse($req_year.'-'.$req_month.'-15');  // year change  end date

        $prev_year = Carbon::parse($req_prev_year.'-'.$req_month.'-15'); // prev year change start date


        $period = \Carbon\CarbonPeriod::create( $prev_year, '1 month',  $c_year);

        $p = array();

        $clients = array();

        $labels = array();

        //for overall ratings

        $delivery = array();

        $communications = array();

        $qStaff = array();

        $qWork = array();

        $pSolving = array();

        $responses = survey_responses::where('created_at','like',date('Y-m',strtotime($c_year)).'%')->where('dept_id',$department->dept_id)->get();

        foreach ($period as $date) {

          $p[] = $date->format('Y-m');

          $labels[] = $date->format('F Y');

          $rspns = survey_responses::where('created_at','like', $date->format('Y-m').'%')->where('dept_id',$department->dept_id)->get();

          $client_avg = $rspns->pluck('rating')->avg();

          $clients[] = number_format($client_avg,2,'.',',');

           // for overall ratings

          $d = array();

          $c = array();

          $qS = array();

          $qW = array();

          $pS = array();


            if($rspns->isEmpty())
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

                 $avg_rspns = $rspns->pluck('average');

                foreach($avg_rspns as $average)
                {
                    $a =  json_decode($average); // average na lima

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


            $delivery[] = number_format($ave_d,2,'.','.');

            $communications[] = number_format($ave_c,2,'.','.');

            $qStaff[] = number_format($ave_qS,2,'.','.');

            $qWork[] = number_format($ave_qW,2,'.','.');

            $pSolving[] = number_format($ave_pS,2,'.','.');


        }

        return view('user.qualitativeData',compact('responses',
        'department','labels','clients','delivery','communications',
                      'qStaff','qWork','pSolving'));
    }

    public function search(Request $request)
    {
        $get_dept = $request->search;

        $icons=$this->icons;

        $departments = departments::where('name','like','%'.$get_dept.'%')->orWhere('acronym','like','%'.$get_dept.'%')->orderBy('level')->orderBy('division')->orderBy('name')->get();

        return view('user.homeData',compact('departments','icons'));

    }

    public function get_department($acronym)
    {

        if (!Auth::guard('student')->user() && !Auth::user() && !session('guest') )

            {

                return redirect('login');
            }

        $department = departments::where('acronym', $acronym)->first();
        // return($department);




        if (!$department)
            return redirect('survey');

            $p_ids = employees_dept::where('dept_id', $department->dept_id)->pluck('p_id');
            $employees = employees::whereIn('p_id', $p_ids)->get();
            $dept_serv = departments_service::where('dept_id',$department->dept_id)->get();





        return view('user.department', compact('department','employees','dept_serv'));
    }

    public function start_survey(Request $request)
    {

        if($request->service_others)

        {

           $service = $request->service_others;
           
        }

        else

        $service = $request->service;

        $dept_id = Crypt::decryptString($request->dept);

        $p_id = Crypt::decryptString($request->staff);

        $department = departments::where('dept_id', $dept_id)->first();

        $employee = employees::where('p_id', $p_id)->first();

        $items = survey_items::where('status', 1)->orderBy('item_id')->get();

        return view('user.survey', compact('items','employee','department','service'));
    }

    public function save_survey(Request $request)
    {
        $rules = [
            'dept' => 'required|string',
            'category' => 'required|integer',
            'client' => 'required|string',
            'name' => 'required|string',
            'employee' => 'required|string',
            'service' => 'required|string',
            'type' => 'string',
        ];



        if (Validator::make($request->all(), $rules)->fails())
            return ['error' => true, 'message' => 'An error was detected. Survey response cannot be saved.'];



        $responses = [];
        for ($id = 0; $id < 10; $id++)
            $responses[] = intval($request['items_'.$id]);

        $delivery = ($responses[0] + $responses[1] + $responses[2]) / 3;
        $communications = ($responses[3] + $responses[4]) / 2;
        $quality = ($responses[5] + $responses[6] + $responses[7]) / 3;

        $average = [
            number_format($delivery, 2, '.', ','),
            number_format($communications, 2, '.', ','),
            number_format($quality, 2, '.', ','),
            number_format($responses[8], 2, '.', ','),
            number_format($responses[9], 2, '.', ','),
        ];

        $rating = ($delivery + $communications + $quality + $responses[8] + $responses[9]) / 5;

        $r = new survey_responses;
        $r->dept_id = Crypt::decryptString($request->dept);
        $r->category = $request->category;
        $r->service = $request->service;
        $r->staff =  Crypt::decryptString($request->employee);
        $r->type = $request->type;
        $r->client_id = Crypt::decryptString($request->client);
        $r->name = $request->name;
        $r->responses = json_encode($responses);
        $r->average = json_encode($average);
        $r->rating = number_format($rating, 2, '.', ',');
        $r->comment = $request->comment;
        $r->status = 1;
        $r->save();

       return redirect('survey')->with('message','succesfully added');
    }

    public function validatemessage(){

        session()->forget('message');
    }


}
