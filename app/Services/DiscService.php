<?php
namespace App\Services;
use App\Disc;
use App\Transaction;
use App\ShippingRequest;

class DiscService
{

    public function destroy(Disc $disc) : void
    {
        Transaction::where('disc_id',$disc->id)->update(array('disc_id',NULL));
        ShippingRequest::where('disc_id',$disc->id)->update(array('disc_id',NULL));
        $disc->delete();
    }


}
