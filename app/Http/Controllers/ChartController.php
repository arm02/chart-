<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ConsoleTVs\Charts\Facades\Charts;
use \App\Log;
use \App\User;
use Mail;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
	public function ismail($r)
  {
  		
  	   	date_default_timezone_set('Asia/Jakarta');

     	$query = $r;
     	
      	$tahun = '2016';
      	$time = time('H:i:s');


      	$awal_tanggal = $tahun.'-'.$query.'-01 00:00:01';
      	$akhir_tanggal = $tahun.'-'.$query.'-31 23:59:59';
      	$jml = Log::where('created_at','>=', $awal_tanggal)->where('created_at','<=', $akhir_tanggal)->count();
      	

      $chart = Charts::database(Log::where('created_at','>=', $awal_tanggal)->where('created_at','<=', $akhir_tanggal)->get(), 'line', 'highcharts')
   		->Title('Berdasarkan User Agent')
   		->ElementLabel("Total")
	    ->Dimensions(1000, 500)
	    ->Responsive(false)
	    ->groupBy('user_agent');

	    $chart2 = Charts::database(Log::where('created_at','>=', $awal_tanggal)->where('created_at','<=', $akhir_tanggal)->get(), 'bar', 'highcharts')
	    ->Title('Berdasarkan  Url')
   		->ElementLabel("Total")
	    ->Dimensions(500, 250)
	    ->Responsive(false)
	    ->groupBy('url');

	    $chart3 = Charts::database(Log::where('created_at','>=', $awal_tanggal)->where('created_at','<=', $akhir_tanggal)->get(), 'bar', 'highcharts')
	    ->Title('Berdasarkan Http Host')
   		->ElementLabel("Total")
	    ->Dimensions(500, 250)
	    ->Responsive(false)
	    ->groupBy('http_host');

		    Mail::send('mail', ['chart' => $chart, 'chart2' => $chart2, 'chart3' => $chart3], function ($m) use ($chart,$chart2,$chart3) {
		    $m->from('arm.adrian02@gmail.com', 'Chart ( Adrian Milano (02))');
		    $m->to('adrianmilano3322@gmail.com', 'Dwiky')->subject('Tugas Kak Arief');
		    });


		    return 'berhasil';
	    
  }



    public function index(Request $req)
    { 
    	$log = Log::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();

   		$chart = Charts::database(Log::get(), 'line', 'highcharts')->dateColumn('created_at')
   		->Title('Berdasarkan User Agent')
   		->ElementLabel("Total")
	    ->Dimensions(1000, 500)
	    ->Responsive(false)
	    ->groupBy('user_agent');

	    $chart2 = Charts::database($log, 'line', 'highcharts')
	    ->Title('Berdasarkan Url')
   		->ElementLabel("Total")
	    ->Dimensions(500, 250)
	    ->Responsive(false)
	    ->groupBy('url');

	    $chart3 = Charts::database($log, 'bar', 'highcharts')
	    ->Title('Berdasarkan Http Host')
   		->ElementLabel("Total")
	    ->Dimensions(500, 250)
	    ->Responsive(false)
	    ->groupBy('http_host');


        return view('welcome')->with('chart',$chart)->with('chart2',$chart2)->with('chart3',$chart3);
    }

    public function search(Request $r)
    {

    	date_default_timezone_set('Asia/Jakarta');
     	$query = $r->input('query');
      	$tahun = '2016';
      	$time = time('H:i:s');


      	$awal_tanggal = $tahun.'-'.$query.'-01 00:00:01';
      	$akhir_tanggal = $tahun.'-'.$query.'-31 23:59:59';
      	$jml = Log::where('created_at','>=', $awal_tanggal)->where('created_at','<=', $akhir_tanggal)->count();
      	if ($query == '1') {
      		$bulan = 'January';
      	}
      	elseif ($query == '2') {
      		$bulan = 'Februari';
      	}
      	elseif ($query == '3') {
      		$bulan = 'Maret';
      	}
      	elseif ($query == '4') {
      		$bulan = 'April';
      	}
      	elseif ($query == '5') {
      		$bulan = 'Mei';
      	}
      	elseif ($query == '6') {
      		$bulan = 'Juni';
      	}
      	elseif ($query == '7') {
      		$bulan = 'July';
      	}
      	elseif ($query == '8') {
      		$bulan = 'Agustus';
      	}
      	elseif ($query == '9') {
      		$bulan = 'September';
      	}
      	elseif ($query == '10') {
      		$bulan = 'Oktober';
      	}
      	elseif ($query == '11') {
      		$bulan = 'November';
      	}
      	elseif ($query == '12') {
      		$bulan = 'Desember';
      	}

      $chart = Charts::database(Log::where('created_at','>=', $awal_tanggal)->where('created_at','<=', $akhir_tanggal)->get(), 'line', 'highcharts')
   		->Title('Berdasarkan User Agent dari tanggal '.$bulan.'')
   		->ElementLabel("User Agent")
	    ->Dimensions(1000, 500)
	    ->Responsive(false)
	    ->groupBy('user_agent');

	    $chart2 = Charts::database(Log::where('created_at','>=', $awal_tanggal)->where('created_at','<=', $akhir_tanggal)->get(), 'bar', 'highcharts')
	    ->Title('Berdasarkan  Url '.$bulan.'')
   		->ElementLabel("URL")
	    ->Dimensions(500, 250)
	    ->Responsive(false)
	    ->groupBy('url');

	    $chart3 = Charts::database(Log::where('created_at','>=', $awal_tanggal)->where('created_at','<=', $akhir_tanggal)->get(), 'bar', 'highcharts')
	    ->Title('Berdasarkan Http Host '.$bulan.'')
   		->ElementLabel("Http Host")
	    ->Dimensions(500, 250)
	    ->Responsive(false)
	    ->groupBy('http_host');

	    $this->ismail($query);

      return view('cari')->with('query', $query)->with('jml',$jml)->with('chart',$chart)->with('chart2',$chart2)->with('chart3',$chart3);
    }

  /*  public function test()
    {
    	$chart = Charts::multi('bar', 'material')
            // Setup the chart settings
            ->title("Test")
            // A dimension of 0 means it will take 100% of the space
            ->dimensions(0, 400) // Width x Height
            // This defines a preset of colors already done:)
            ->template("material")
            // You could always set them manually
            // ->colors(['#2196F3', '#F44336', '#FFC107'])
            // Setup the diferent datasets (this is a multi chart)
            ->dataset('Element 1', [5,20,100])
            ->dataset('Element 2', [15,30,80])
            ->dataset('Element 3', [25,10,40])
            // Setup what the values mean
            ->labels(['One', 'Two', 'Three']);

            return view('test')->with('test',$chart);
    }*/
}
