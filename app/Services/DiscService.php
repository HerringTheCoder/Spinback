<?php
namespace App\Services;
use App\Disc;
use Illuminate\Http\Request;
use Bouncer;

class DiscService
{

    public function index()
    {
        $disc = Disc::All();
        return $disc;
    }

    public function store(Request $request) :void
    {
        $disc=new Disc();
        $disc->metadata_id = $request->input('metadata_id');
        $disc->condition = $request->input('condition');
        $disc->photo_path = $request->input('photo_path');
        $disc->offer_price = $request->input('offer_price');
        $disc->sold = $request->input('sold');
        $disc->save();
        session()->flash('message', 'Disc added successfully');
        return;
    }

    public function update(Disc $disc, Request $request) : void
    {
        $disc->metadata_id = $request->input('metadata_id');
        $disc->condition = $request->input('condition');
        $disc->photo_path = $request->input('photo_path');
        $disc->offer_price = $request->input('offer_price');
        $disc->sold = $request->input('sold');
        $disc->save();
        session()->flash('message', 'Disc updated successfully');
        return;
    }


    public function destroy(Disc $disc) : void
    {

        $disc->delete();
        session()->flash('message','Disc deleted successfully');
        return;
    }

    public function validateUpdate(Request $request)
    {
        $request->validate([
            'condition'=>'alphanumeric|string',
            'photo_path'=>'photo_path',
            'offer_price'=>'digits_between:1,4',
            'sold'=>'boolean',
            'department_id'=>'exists|digits'
        ]);
    }

    public function validateStore(Request $request)
    {
        $request->validate([
            'condition'=>'alphanumeric|string',
            'photo_path'=>'photo_path',
            'offer_price'=>'digits_between:1,4',
            'sold'=>'boolean',
            'department_id'=>'exists|digits'
        ]);
    }

}
