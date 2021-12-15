<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUpload()
    {
        return view('welcome');
    }
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUploadPost(Request $request)
    {
        $fileName = $request->file('file');
        $contents=file_get_contents($fileName);
        $lines=explode("\n",$contents);
        $arrayFinal = [];
        foreach($lines as $line){
            $arrayFinal[] = json_decode($line, true);
        }
        $dublinLat = 53.3340285;
        $dublinLng = -6.2535495;
        $dstArray = [];
        $finalData = collect($arrayFinal)->map(function ($value) use($dublinLat, $dublinLng){
            $dstArray['distance'] = $this->getDistanceBetweenPointsNew(
                $dublinLat,
                $dublinLng, 
                $value['latitude'], 
                $value['longitude'],
                'Km'
            );
            $dstArray["latitude"] = $value["latitude"];
            $dstArray["affiliate_id"] = $value["affiliate_id"];
            $dstArray["name"] = $value["name"];
            $dstArray["longitude"] = $value["longitude"];
            return $dstArray;
        });
        
        return view('list', compact('finalData'));
    }

/**
 * Method to find the distance between 2 locations from its coordinates.
 * 
 * @param latitude1 LAT from point A
 * @param longitude1 LNG from point A
 * @param latitude2 LAT from point A
 * @param longitude2 LNG from point A
 * 
 * @return Float Distance in Kilometers.
 */
public function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'Km') {
    $theta = $longitude1 - $longitude2;
    $distance = sin(deg2rad($latitude1)) * sin(deg2rad($latitude2)) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta));

    $distance = acos($distance); 
    $distance = rad2deg($distance); 
    $distance = $distance * 60 * 1.1515;

    switch($unit) 
    { 
        case 'Mi': break;
        case 'Km' : $distance = $distance * 1.609344; 
    }
    if ($distance<100) {
        return (round($distance,2)); 
    }
}
}
