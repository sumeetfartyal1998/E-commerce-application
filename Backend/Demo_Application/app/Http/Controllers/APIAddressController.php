<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class APIAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $rules=array(
            'fullname'=>'required',
            'mobile'=>'required|digits:10|numeric',
            'building'=>'required',
            'state'=>'required',
            'city'=>'required',
            'pincode'=>'required|numeric|digits:6',
        );
        $errMsg=array(
            'fullname.required'=>'Please enter a name.',
            'mobile.required'=>'Please enter a mobile number so we can call if there are any issues with delivery.',
            'mobile.numeric'=>'Please enter a valid mobile number.',
            'mobile.digits'=>'Please enter a 10 digit valid mobile number.',
            'building.required'=>'Please enter an address.',
            'state.required'=>'Please enter a state, region or province.',
            'city.required'=>'Please enter a city name.',
            'pincode.required'=>'Please enter a ZIP or postal code.',
            'pincode.numeric'=>'Please enter a valid 6 digit ZIP or postal code.',
            'pincode.digits'=>'Please enter a valid 6 digit ZIP or postal code.',
        );
        $validator=Validator::make($req->all(),$rules,$errMsg);
        if($validator->fails()){
            return response()->json($validator->errors());
        }else{
            $address=new Address();
            $address->user_id=$req->user_id;
            $address->fullname=$req->fullname;
            $address->mobile=$req->mobile;
            $address->building=$req->building;
            $address->area=$req->area;
            $address->landmark=$req->landmark;
            $address->state=$req->state;
            $address->city=$req->city;
            $address->pincode=$req->pincode;
            $address->address_type=$req->address_type;
            if($address->save()){
                return response()->json(["success"=>"Your address has been added successfully"]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(User::find($id)->getAddress);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address=Address::find($id);
        if($address->delete()){
            return response()->json(['success'=>"Address deleted successfully"]);
        }
    }
}
