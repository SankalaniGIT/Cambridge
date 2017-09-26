<?php

namespace App\Http\Controllers;
use App\Model\Charge;
use Illuminate\Http\Request;

class ChargesController extends Controller
{
    public function getallCharges()
    {
        return $allcharges = Charge::all();
    }

    public function index()
    {
        return view('Activities.Charges.viewCharges', array('charges' => $this->getallCharges()));//view all charges
    }

    public function viewUpdate()
    {
        return view('Activities.Charges.updateCharges', array('updateCharges' => $this->getallCharges()));//view all Charges to update
    }

    public function saveUpdate(Request $request)
    {
        $Data = $request->input();
        $ChargesUpdate = Charge::where('main_class_id', $Data['main_class_id']);

        if ($ChargesUpdate->first()) {
            $status = $ChargesUpdate->update([
                'cls_name' => $Data['cls_name'],
                'adm_fee' => $Data['adm_fee'],
                'ref_deposit' => $Data['ref_deposit'],
                'term_fee' => $Data['term_fee'],
                'exam_fee' => $Data['exam_fee'],
                'extra_cur_fee' => $Data['extra_cur_fee']
            ]);
        }
        return $status;
    }
}
