<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

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
}
