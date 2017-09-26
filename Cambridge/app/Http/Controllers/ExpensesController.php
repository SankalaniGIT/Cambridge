<?php

namespace App\Http\Controllers;

use App\Model\Expense;
use App\Model\CashInHand as CashInHand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Http\Controllers\RevenueController;

class ExpensesController extends Controller
{

    /********************************************    Pay Expenses    ***********************************************/

    public function viewPayExpenses()
    {
        $invNo = DB::table('expense_tbl')->select('expense_inv_id')->orderBy('expense_inv_id', 'desc')->limit(1)->get();//get last inserted expense_inv_id No in expense_tbl
        foreach ($invNo as $item) {
            $inv = $item->expense_inv_id + 1;
        }
        $exp = Expense::select('expense_m_id', 'expense_type')->get();
        return view('Activities.Expenses.payExpenses', array('expenses' => $exp, 'invNo' => $inv));
    }

    public function postPayExpenses(Request $request)
    {

        $Sname = $request->input('Sname');
        $Rname = $request->input('Rname');
        $date = $request->input('date');
        $invNo = $request->input('invNo');

        $count = count($request->input('id'));

        $typeId = $request->input('id');
        $type = $request->input('type');
        $description = $request->input('desc');
        $amount = $request->input('amount');

        try {
            DB::table('expense_tbl')->insert([
                'expense_inv_id' => $invNo,
                'sender_name' => $Sname,
                'receiver_name' => $Rname,
                'date' => $date
            ]);//add invoice no
            $total = 0;
            for ($i = 0; $i < $count; $i++) {
                try {

                    DB::table('expense_transaction_tbl')->insert([
                        'expense_m_id' => $typeId[$i],
                        'amount' => $amount[$i],
                        'description' => $description[$i],
                        'expense_inv_id' => $invNo
                    ]);//add Expense transaction data

                    $total = $total + $amount[$i];

                } catch (QueryException $ex) {
                    return redirect('viewPayExpenses')->with('error_code', 111);
                }
            }
            $disc = $total;
            $paid = 0;

            $CashInHand= new CashInHand();
            $returnCIH=$CashInHand->saveCashInHand($date, $disc, $paid);//add expenses to cash in hand table

            if ($returnCIH==1) {
                return view('Invoice.expensesInv', ['invNo' => $invNo, 'date' => $date, 'Sname' => $Sname, 'Rname' => $Rname, 'type' => $type, 'description' => $description, 'amount' => $amount, 'total' => $total, 'count' => $count]);
            }
            else{
                return redirect('viewPayExpenses')->with('error_code', 111);
            }
//            app('App\Http\Controllers\RevenueController')->saveCashInHand($date, $disc, $paid);//add expenses to cash in hand table

        } catch (QueryException $ex) {
            return redirect('viewPayExpenses')->with('error_code', 111);
        }

    }

    /********************************************    View Expenses    ***********************************************/

    public function viewExpenses()
    {
        $exp = DB::select(DB::raw('SELECT expense_tbl.date,expense_master_tbl.expense_type,expense_transaction_tbl.description,expense_tbl.sender_name,
expense_tbl.receiver_name,expense_transaction_tbl.amount
FROM expense_tbl
JOIN expense_transaction_tbl ON expense_tbl.expense_inv_id=expense_transaction_tbl.expense_inv_id
JOIN expense_master_tbl ON expense_transaction_tbl.expense_m_id=expense_master_tbl.expense_m_id'));
        return view('Activities.Expenses.viewExpenses', array('expenses' => $exp));
    }
}
