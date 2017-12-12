<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\addInventoryRequest;
use App\Http\Requests\updateInventoryRequest;
use App\Model\Stationary;


class InventoriesController extends Controller
{

    public function viewInventory()
    {
        return view('Activities.Inventories.viewInventory', array('inventory' => Stationary::all()));
    }//view Inventory Details

    public function updateInventory()
    {
        $stObj = new Stationary();
        $st = $stObj->getStationary();
        return view('Activities.Inventories.updateInventory', array('inventories' => $st));
    }//View Update Inventory Details

    public function fillInventory(Request $request)
    {
        $stObj = new Stationary();
        $st = $stObj->fillInven($request->id);
        return array($st[0]->price, $st[0]->quantity,$st[0]->purchase_price);
    }//fill Selling price,Purchasing price,quantity according to item

    public function postAddInven(addInventoryRequest $request)
    {
        $stObj = new Stationary();
        $values=$stObj->insertInventory($request);
        if ($values){
            return redirect('updateInventory')->with('error_code', 23);
        }else{
            return redirect('updateInventory')->with('error_code', 111);
        }
    }//insert Inventory details

    public function postUpdateInven(updateInventoryRequest $request)
    {
        $stObj = new Stationary();
        if ((is_null($request->ckAdd) && is_null($request->ckRe))||($request->ckAdd==1 && $request->ckRe==1))
        {
            return redirect('updateInventory')->with('error_code', 25);//please select one option from add & remove
        }
        else if (is_null($request->ckAdd)){
            //remove
            $reval=$stObj->removeInventory($request);
            if ($reval){
                return redirect('updateInventory')->with('error_code', 24);
            }else{
                return redirect('updateInventory')->with('error_code', 111);
            }
        }
        else if (is_null($request->ckRe)){
            //add
            $addval=$stObj->addInventory($request);
            if ($addval){
                return redirect('updateInventory')->with('error_code', 24);
            }else{
                return redirect('updateInventory')->with('error_code', 111);
            }
        }
    }//Update Inventory Details


}
