<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $countries = explode(", ",$request->country);
        $users = User::whereIn("country", $countries)->get();
        return $users;
    }
}
