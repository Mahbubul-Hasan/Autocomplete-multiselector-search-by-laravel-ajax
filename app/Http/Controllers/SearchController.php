<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function countryList(Request $request)
    { 
        $countries = Country::select("name")->where("name", "LIKE", "%".$request->term."%")->orderBy("name", "ASC")->get();
        
        if (count($countries)) {
            foreach ($countries as $country) {
                $availableCountries[] = $country->name;
            }
        } else {
            $availableCountries[] = "Not Found";
        }
        return $availableCountries;
    }

    public function peoples(Request $request)
    {  
        $users = User::select("name")->where("country", $request->country)->orderBy("name", "ASC")->get();
        return $users;
    }
}
