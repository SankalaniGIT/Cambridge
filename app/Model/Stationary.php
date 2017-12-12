<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use DateTime;

class Stationary extends Model
{
    protected $table = 'stationary_tbl';
    public $timestamps = false;

    function getStationary()
    {
        $sta = DB::table($this->table)->select('st_id', 'st_type')->get();
        return $sta;
    }//get all stationary

    function fillInven($id)
    {
        $sta = DB::table($this->table)->select('price', 'quantity', 'purchase_price')->where('st_id', '=', $id)->get();
        return $sta;
    }//get selected stationary details

    function insertInventory($values)
    {
        
        try {
            $sta = DB::table($this->table)
                ->insert([
                    'st_type' => $values->item,
                    'price' => $values->Sprice,
                    'quantity' => $values->qty,
                    'purchase_price' => $values->Pprice
                ]);

            return true;
        } catch (QueryException $ex) {
            return E111;
        }
    }//insert new stationary details

    function getItemQty($id)
    {
        $qty = DB::table($this->table)->select('quantity')->where('st_id', '=', $id)->get();
        return $qty[0]->quantity;
    }//get quantity of selected item

    function addInventory($values)
    {
        try {
            $qty = $this->getItemQty($values->item2);
            DB::table($this->table)
                ->where('st_id', '=', $values->item2)
                ->update([
                    'price' => $values->Sprice2,
                    'quantity' => $qty + $values->qty2,
                    'purchase_price' => $values->Pprice2
                ]);

            return true;
        } catch (QueryException $ex) {
            return E111;
        }
    }//add new inventory stock to update

    function removeInventory($values)
    {
        try {
            $qty = $this->getItemQty($values->item2);
            DB::table($this->table)
                ->where('st_id', '=', $values->item2)
                ->update([
                    'price' => $values->Sprice2,
                    'quantity' => $qty - $values->qty2,
                    'purchase_price' => $values->Pprice2
                ]);

            return true;
        } catch (QueryException $ex) {
            return E111;
        }
    }//remove inventory stock details to update

    function getSumStationary($date)
    {
        $sta = DB::select(DB::raw('SELECT  SUM(amount) AS staAmt
FROM stationary_transaction_tbl AS ST
INNER JOIN stationary_inv_tbl AS SI
ON SI.st_inv_id=ST.st_inv_id
WHERE SI.st_date="' . $date . '"'));
        return $sta[0]->staAmt;
    }//return sum of stationary amount according to date

    function getMonthlySta($Fd, $Td)
    {
        $s = DB::select(DB::raw('SELECT SI.st_date,S.st_type,SI.admission_no,ST.amount
FROM stationary_inv_tbl AS SI
INNER JOIN stationary_transaction_tbl AS ST 
ON ST.st_inv_id=SI.st_inv_id
INNER JOIN stationary_tbl AS S
ON S.st_id=ST.st_id
WHERE SI.st_date BETWEEN "' . $Fd . '" AND "' . $Td . '"'));

        return $s;
    }//return all monthly stationary

    function getPNLstaTot($Fd, $Td){
        $sta=DB::select(DB::raw('SELECT IFNULL(SUM(ST.amount),0) AS totAmt
FROM stationary_inv_tbl AS SI
INNER JOIN stationary_transaction_tbl AS ST
ON ST.st_inv_id=SI.st_inv_id
WHERE SI.st_date BETWEEN "'.$Fd.'" AND "'.$Td.'"'));
        return $sta[0]->totAmt;
    }//return total stationary profit for month (PNL)

}
