<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    public function register(Request $request){
        $dealer = new Dealer;
        $dealer->email = $request->input('email');
        $dealer->password = $request->input('password');
        $dealer->company_name = $request->input('company_name');
        $dealer->gst_number = $request->input('gst_number');
        $dealer->contact_person = $request->input('contact_person');
        $dealer->address = $request->input('address');
        $dealer->city = $request->input('city');
        $dealer->district = $request->input('district');
        $dealer->state = $request->input('state');
        $dealer->zip = $request->input('zip');
        $dealer->phone = $request->input('phone');
        $dealer->alternate_number = $request->input('alternate_number');

        $dealer->save();

        return response()->json([
            'status' => 200,
            'message' => 'Dealer registered successfully',
        ]);
    }

    public function get_dealer_requests(){

        $dealer_requests = Dealer::where('user_role','=','user')->where('user_status','=','false')->get();

        $dealer_list = Dealer::where('user_role','=','user')->where('user_status','=','true')->get();

        return response()->json([
            'status' => 200,
            'dealers' => $dealer_requests,
            'ondealers' => $dealer_list,
        ]);
    }

    public function update_dealer_status($id){

        $update_status = Dealer::where("id", $id)->update(["user_status" => "true"]);

        return response()->json([
            'status' => 200,
            'message' => 'Dealer status updated',
        ]);

    }

    public function delete_dealer($id){

        $dealer = Dealer::find($id);
        $dealer -> delete();

        return response()->json([
            'status' => 200,
            'message' => 'Dealer deleted successfully',
        ]);

    }

}
