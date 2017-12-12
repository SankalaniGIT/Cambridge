<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OtherIncome extends Model
{
    protected $table = 'other_income_tbl';
    public $timestamps = false;

    function totOincome($date)
    {
        $OI = OtherIncome::select(DB::raw('type,SUM(amount) AS totOincome'))
            ->where('date', '=', $date)
            ->groupBy('type')
            ->get();
        return $OI;
    }//return total daily income

    function getMonthlyOI($Fd, $Td)
    {
        $MOI = OtherIncome::select('date', 'type', 'amount')
            ->whereBetween('date', [$Fd, $Td])
            ->get();
        return $MOI;
    }///return all monthly other income

    function getPNLotherTot($Fd, $Td)
    {
        $OI = DB::select(DB::raw('SELECT IFNULL(SUM(amount),0) AS Tamt
FROM other_income_tbl
WHERE DATE BETWEEN "' . $Fd . '" AND "' . $Td . '"'));

        return $OI[0]->Tamt;
    }//return total monthly other income (PNL)
}
