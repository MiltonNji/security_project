<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HouseController extends Controller
{


    public function generateChart()

    {


        $houses = House::all();

        $labels = ['Living Rooms', 'Bedrooms', 'Bathrooms'];
        $data = [
            $houses->sum('living_rooms'),
            $houses->sum('bedrooms'),
            $houses->sum('bathrooms'),
        ];

        $chartType = request()->input('chartType', 'bar');

        $queryParameters = [
            'cht' => $chartType,
            'chxt' => 'x,y',
            'chxl' => '0:|Rooms|1:|Living Rooms|Bedrooms|Bathrooms',
            'chd' => 't:' . implode(',', $data),
            'chs' => '500x300',
        ];

        $url = 'https://image-charts.com/chart?' . http_build_query($queryParameters);

        return view('chart')->with([
            'chartUrl' => $url,
            'chartData' => [
                'labels' => $labels,
                'data' => $data,
            ],
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('home');
    }
    public function randomPage()
    {
        // Generate a random number to simulate a not found error
        $randomNumber = rand(1, 10);

        // If the random number is odd, throw a 404 error
        if ($randomNumber % 2 != 0) {
            abort(404);
        }

        else {
            abort(500);
        }

        // If the random number is even, redirect to a different page
        return redirect()->route('another-page');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(House $house)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(House $house)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, House $house)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(House $house)
    {
        //
    }
}
