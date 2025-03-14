<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Exception;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(){
        try{
            $countries = Country::all();
            return response()->json($countries, 200);
        } catch(Exception $e) {
            return response()->json(['message'=>"error", "error"=>$e->getMessage()], 401);
        }
    }

    public function show($id){
        $country = Country::find($id)->first()->get();

        if(empty($country)){
            return response()->json(['message'=>"there's no Country !"], 401);
        }

        return response()->json($country);
    }

    public function store(Request $request){
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'flag_url' => 'nullable|url',
            'currency' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'capital' => 'required|string|max:255',
        ]);

        $country = Country::create($validate);
        return response()->json($country);
    }

    public function update(Request $request, $id){
        $country = Country::findOrFail($id);
        $country->update($request->all());

        return response()->json($country);
    }

    public function destroy($id){
        $country = Country::findOrFail($id);
        $country->delete();

        return response()->json(null, 204);
    }

    // flags 
    public function getFlag($id){
        $flag = Country::findOrFail($id);
        return response()->json($flag->flag_url, 200);
    }

    public function uploadFlag(Request $request, $id){
        $country = Country::findOrFail($id);
        $country->flag_url = $request->name;
        $country->save();
        return response()->json($country, 200);
    }
}
