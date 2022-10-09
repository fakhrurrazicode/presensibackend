<?php

namespace App\Http\Controllers;

use App\Models\PolygonPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function polygon()
    {
        $polygon_points = PolygonPoint::all();
        return view('setting.polygon', ['polygon_points' => $polygon_points]);
    }

    public function addPolygonPoint(Request $request)
    {
        // $validation = Validator::make($request->all(), [
        //     'lat' => ['required'],
        //     'lng' => ['required'],
        //     // 'singkatan' => ['required'],
        // ]);

        // if ($validation->fails()) {
        //     return response()->json([
        //         'errors' => $validation->errors(),
        //     ], 400);
        // }
        PolygonPoint::truncate();

        $polygon_points = PolygonPoint::insert($request->get('polygonCoordinates'));


        return response()->json([
            'polygon_points' => $polygon_points
        ]);
    }

    public function removePolygonPoint()
    {
    }
}
