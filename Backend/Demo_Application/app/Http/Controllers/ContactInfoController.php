<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function contactInfoForm(){
        $contactInfo=ContactInfo::find(1);
        return view('/contactInfo')->with('contactInfo',$contactInfo);
    }

    public function contactInfo(Request $req){
        $contactInfo=contactInfo::find(1);
        $contactInfo->website_title=$req->title;
        $contactInfo->area=$req->area;
        $contactInfo->country=$req->country;
        $contactInfo->state=$req->state;
        $contactInfo->city=$req->city;
        $contactInfo->pincode=$req->pincode;
        $contactInfo->mobile=$req->mobile;
        $contactInfo->email=$req->email;
        if($contactInfo->save()){
            return back()->with('success','Contact Info and address has been updated.');
        }
    }
}
