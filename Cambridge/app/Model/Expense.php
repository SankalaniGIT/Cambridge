<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Expense extends Model
{
    protected $table = 'expense_master_tbl';
    public $timestamps = false;

    function getTotExp($date)
    {
        $exp = DB::select(DB::raw('SELECT EM.expense_type,IFNULL(SUM(ET.amount),0) AS totExp
FROM expense_tbl AS E
INNER JOIN expense_transaction_tbl AS ET
ON E.expense_inv_id=ET.expense_inv_id
INNER JOIN expense_master_tbl AS EM
ON EM.expense_m_id=ET.expense_m_id
WHERE E.date="' . $date . '"
GROUP BY ET.expense_m_id'));

        return $exp;
    }//return total expense according to date

    function getMonthlyExp($Fd, $Td)
    {
        $Mexp = DB::select(DB::raw('SELECT E.date,EM.expense_type,ET.description,E.receiver_name,ET.amount
FROM expense_tbl AS E
INNER JOIN expense_transaction_tbl AS ET
ON ET.expense_inv_id=E.expense_inv_id
INNER JOIN expense_master_tbl AS EM
ON EM.expense_m_id=ET.expense_m_id
WHERE E.date BETWEEN "' . $Fd . '" AND "' . $Td . '"'));

        return $Mexp;
    }//return all monthly expenses

    function getPNLexpTot($Fd, $Td)
    {
        $tbl = DB::select(DB::raw('SELECT EM.expense_type,IFNULL(SUM(ET.amount),0) AS Tamt
FROM expense_tbl AS E
INNER JOIN expense_transaction_tbl AS ET
ON E.expense_inv_id=ET.expense_inv_id
INNER JOIN expense_master_tbl AS EM
ON EM.expense_m_id=ET.expense_m_id
WHERE E.date BETWEEN "' . $Fd . '" AND "' . $Td . '"
GROUP BY ET.expense_m_id'));

        return $tbl;
    }//return total monthly expenses (PNL)
}
