<?php

namespace App\Http\Controllers;

use App\Http\Requests\admissionRefundRequest;
use App\Http\Requests\otherIncomeRequest;
use App\Http\Requests\stationaryRequest;
use Illuminate\Http\Request;
use App\Model\Student_nc; //use NC student model in controller
use App\Model\Student_bc;
use App\Model\Admission;
use App\Model\OtherIncome;
use App\Model\CashInHand as CashInHand;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class RevenueController extends Controller
{


    public function getAddNos(Request $request)
    {
        $query = $request->get('term', '');

        if (substr($query, 0, 2) == 'nc') {
            $products = Student_nc::select('admission_no', 'std_fname', 'std_lname')->where('admission_no', 'LIKE', $query . '%')->orderBy('admission_no', 'DESC')->limit(10)->get();
        }
        if (substr($query, 0, 2) == 'bc') {
            $products = Student_bc::select('admission_no', 'std_fname', 'std_lname')->where('admission_no', 'LIKE', $query . '%')->orderBy('admission_no', 'DESC')->limit(10)->get();
        }
        $data = array();
        foreach ($products as $product) {
            $data[] = array('value' => $product->std_fname . ' ' . $product->std_lname . ' --' . $product->admission_no, 'id' => $product->admission_no);
        }
        if (count($data))
            return $data;
        else
            return ['value' => 'No Result Found', 'id' => ''];
    }


    /**************************************  Get Admission and Refund  ***********************************************/

    public function admissionRef()
    {

        $adNo = DB::table('admission_tbl')->select('ad_payment_invoice')->orderBy('id', 'desc')->limit(1)->get();//get last inserted ad_payment_invoice No in admission_tbl

        foreach ($adNo as $item) {
            $x = $item->ad_payment_invoice;
            $inv = $x + 1;
        }
        return view('Activities.Revenue.Admission&Ref')->with('AddInv', $inv);
    }

    public function getAdRef(Request $request)
    {
        $name = '';
        $class = '';
        $ammount = 0;
        $paid = 0;

        if (substr($request['id'], 0, 2) == 'nc') {
            $adData = DB::table('nc_student_details_tbl')->select('std_fname', 'std_lname')->where('admission_no', '=', $request['id'])->get();
            foreach ($adData as $d) {
                $fname = $d->std_fname;
                $lname = $d->std_lname;
            }
            $name = $fname . ' ' . $lname;
            $adData2 = DB::table('student_class_tbl')->select('class_cat_id')->where('admission_no', '=', $request['id'])->get();
            foreach ($adData2 as $cat) {
                $catid = $cat->class_cat_id;
            }
            $adData3 = DB::table('class_category_tbl')->select('class_category', 'main_class_id')->where('class_cat_id', '=', $catid)->get();
            foreach ($adData3 as $i) {
                $class = $i->class_category;
                $mid = $i->main_class_id;
            }
            $adData4 = DB::table('main_class_tbl')->select('adm_fee', 'ref_deposit')->where('main_class_id', '=', $mid)->get();
            foreach ($adData4 as $gd) {
                $adm_fee = $gd->adm_fee;
                $ref_deposit = $gd->ref_deposit;
            }

        } elseif (substr($request['id'], 0, 2) == 'bc') {
            $adData = DB::table('bc_student_details_tbl')->select('std_fname', 'std_lname')->where('admission_no', '=', $request['id'])->get();
            foreach ($adData as $d) {
                $fname = $d->std_fname;
                $lname = $d->std_lname;
            }
            $name = $fname . ' ' . $lname;
            $adData2 = DB::table('student_class_tbl')->select('class_cat_id')->where('admission_no', '=', $request['id'])->get();
            foreach ($adData2 as $cat) {
                $catid = $cat->class_cat_id;
            }
            $adData3 = DB::table('class_category_tbl')->select('class_category', 'main_class_id')->where('class_cat_id', '=', $catid)->get();
            foreach ($adData3 as $i) {
                $class = $i->class_category;
                $mid = $i->main_class_id;
            }
            $adData4 = DB::table('main_class_tbl')->select('adm_fee', 'ref_deposit')->where('main_class_id', '=', $mid)->get();
            foreach ($adData4 as $gd) {
                $adm_fee = $gd->adm_fee;
                $ref_deposit = $gd->ref_deposit;
            }

        }


        if ($request['category'] == 'Admission Fee') {
            $searchData = DB::table('admission_tbl')->select('ad_paid_amount')->where('ad_payment_type', '=', 'Admission Fee')->where('admission_no', '=', $request['id'])->get();
            $ammount = $adm_fee;

            $count = Admission::where('admission_no', '=', $request['id'])->where('ad_payment_type', '=', 'Admission Fee')->count();

            $dis = DB::table('admission_tbl')->select(DB::raw('SUM(discount) AS discount'))->where('ad_payment_type', '=', 'Admission Fee')->where('admission_no', '=', $request['id'])->get();

            $discount=$dis[0]->discount;
        } elseif ($request['category'] == 'Refundable Deposit') {
            $searchData = DB::table('admission_tbl')->select('ad_paid_amount')->where('ad_payment_type', '=', 'Refundable Deposit')->where('admission_no', '=', $request['id'])->get();
            $ammount = $ref_deposit;

            $count = Admission::where('admission_no', '=', $request['id'])->where('ad_payment_type', '=', 'Refundable Deposit')->count();

            $discount=0;
        }

            $paid = $searchData[0]->ad_paid_amount;


        return [$name, $class, $ammount, $discount, $paid, $count];

    }//get Admission and Refund details according to admission no

    public function postAdmissionRef(admissionRefundRequest $request)
    {
        $addNo = $request->input('adNo');
        $ptype = $request->input('category');
        $pinv = $request->input('InvNo');
        $disc = $request->input('discount');
        $date = $request->input('date');
        $name = $request->input('name');
        $class = $request->input('class');
        $amount = $request->input('amount');
        $fPart = $request->input('1stPart');
        $secPart = $request->input('2ndPart');

        $val = $this->getAdmissionRefCondition($ptype, $addNo, $request->input('amount'));

        if (substr($addNo, 0, 2) == 'nc')
            $Curriculum = 'National Curriculum';
        else $Curriculum = 'British Curriculum';

        if ($request->input('category') == 'Admission Fee') {
            if ($val == 4 || $val == 1) {
                if ($request->input('Payment_Type') == 'Full') {
                    if ($val == 4) {
                        //new full payment
                        $paid = $request->input('amount');
                        $this->saveAdd($addNo, $paid, $ptype, $pinv, $disc, 2);
                        $this->saveCashInHand($date, $disc, $paid);
                        return view('Invoice.admissionInv', ['form' => 'ADMISSION FEE', 'part' => '', 'Curriculum' => $Curriculum, 'invNo' => $pinv, 'date' => $date,
                            'AdNo' => $addNo, 'name' => $name, 'class' => $class, 'amount' => $amount, 'paid' => $paid, 'totPaid' => $paid, 'bottom' => 'ADMISSION FEE']);
                    } else return redirect('admission&Ref')->with('error_code', 6);//1st part paid
                } else {
                    if ($request->input('2ndPart') == null) {
                        if ($val == 4) {
                            //new 1st part payment
                            $paid = $request->input('1stPart');
                            $this->saveAdd($addNo, $paid, $ptype, $pinv, $disc, 1);
                            $this->saveCashInHand($date, $disc, $paid);
                            return view('Invoice.admissionInv', ['form' => 'ADMISSION FEE', 'part' => '1st Installment', 'Curriculum' => $Curriculum, 'invNo' => $pinv, 'date' => $date,
                                'AdNo' => $addNo, 'name' => $name, 'class' => $class, 'amount' => $amount, 'paid' => $paid, 'totPaid' => $paid, 'bottom' => 'ADMISSION FEE']);
                        } else {
                            //1st part paid
                            return redirect('admission&Ref')->with('error_code', 6);
                        }
                    } else {
                        if ($val == 1) {
                            //2nd part payment
                            if ($fPart + $secPart == $amount) {
                                $val = Admission::where('admission_no', '=', $addNo)->where('ad_payment_type', '=', 'Admission Fee')->where('discount', '>', 0)->count();
                                if ($val == 0) {
                                    $paid = $request->input('2ndPart');
                                    $this->saveAdd($addNo, $paid, $ptype, $pinv, $disc, 2);
                                    $this->saveCashInHand($date, $disc, $paid);
                                    return view('Invoice.admissionInv', ['form' => 'ADMISSION FEE', 'part' => '2nd Installment', 'Curriculum' => $Curriculum, 'invNo' => $pinv, 'date' => $date,
                                        'AdNo' => $addNo, 'name' => $name, 'class' => $class, 'amount' => $amount, 'paid' => $paid, 'totPaid' => $amount, 'bottom' => 'ADMISSION FEE']);
                                } else {
                                    $disc = 0;
                                    $paid = $request->input('2ndPart');
                                    $this->saveAdd($addNo, $paid, $ptype, $pinv, $disc, 2);
                                    $this->saveCashInHand($date, $disc, $paid);
                                    return view('Invoice.admissionInv', ['form' => 'ADMISSION FEE', 'part' => '2nd Installment', 'Curriculum' => $Curriculum, 'invNo' => $pinv, 'date' => $date,
                                        'AdNo' => $addNo, 'name' => $name, 'class' => $class, 'amount' => $amount, 'paid' => $paid, 'totPaid' => $amount, 'bottom' => 'ADMISSION FEE']);
                                    //already given discount
                                }

                            } else return redirect('admission&Ref')->with('error_code', 9);//sum of 1st and 2nd part is not equal to amount

                        }
                    }
                }
            } else {
                //already saved
                return redirect('admission&Ref')->with('error_code', 7);
            }
        } else {
            if ($val == 6) {
                //new Refund payment
                $paid = $request->input('amount');
                $this->saveAdd($addNo, $paid, $ptype, $pinv, $disc, 2);
                $this->saveCashInHand($date, $disc, $paid);
                return view('Invoice.admissionInv', ['form' => 'REFUNDABLE FEE', 'part' => '', 'Curriculum' => $Curriculum, 'invNo' => $pinv, 'date' => $date,
                    'AdNo' => $addNo, 'name' => $name, 'class' => $class, 'amount' => $amount, 'paid' => $paid, 'totPaid' => $paid, 'bottom' => 'REFUNDABLE DEPOSIT']);
            } else {
                //already saved
                return redirect('admission&Ref')->with('error_code', 8);
            }
        }

    }

    public function saveAdd($addNo, $paid, $ptype, $pinv, $disc, $part)
    {
        try {
            $add = new Admission();
            $add->admission_no = $addNo;
            $add->ad_paid_amount = $paid;
            $add->ad_payment_type = $ptype;
            $add->ad_payment_invoice = $pinv;
            $add->discount = $disc;
            $add->part = $part;
            $add->save();
        } catch (QueryException $ex) {
            return redirect('admission&Ref')->with('error_code', 111);
        }

    }//save admission table data


    public function saveCashInHand($date, $disc, $paid)
    {

        $CashInHand = new CashInHand();
        $returnCIH = $CashInHand->saveCashInHand($date, $disc, $paid);

        if ($returnCIH == 1) {
        } else {
            return redirect('admission&Ref')->with('error_code', 111);
        }

    }//save income and expenses to cash_in_hand table


    public function getAdmissionRefCondition($category, $id, $amount)
    {
        if ($category == 'Admission Fee') {
            $count = Admission::where('admission_no', '=', $id)->where('ad_payment_type', '=', 'Admission Fee')->count();
            if ($count > 0) {
                if ($count == 1) {
                    $val = Admission::where('admission_no', '=', $id)->where('ad_payment_type', '=', 'Admission Fee')->where('ad_paid_amount', '<', $amount)->count();
                    if ($val == 1) {
                        //1st part paid
                        return 1;
                    } else {
                        //full paid
                        return 2;
                    }
                } else if ($count == 2) {
                    //2nd part paid
                    return 3;
                }
            } else {
                //new admission
                return 4;
            }

        } elseif ($category == 'Refundable Deposit') {
            $count = Admission::where('admission_no', '=', $id)->where('ad_payment_type', '=', 'Refundable Deposit')->count();
            if ($count > 0) {
                //paid refund
                return 5;
            } else {
                //new Refund
                return 6;
            }
        }
    }

    /****************************************** Stationary ************************************************************/

    public function viewStationary()
    {
        $invNo = DB::table('stationary_inv_tbl')->select('st_inv_id')->orderBy('st_inv_id', 'desc')->limit(1)->get();//get last inserted st_inv_id No in stationary_inv_tbl
        foreach ($invNo as $item) {
            $inv = $item->st_inv_id + 1;
        }
        $stationary = DB::table('stationary_tbl')->select('st_id', 'st_type')->get();
        return view('Activities.Revenue.stationary', array('stationary' => $stationary, 'invNo' => $inv));
    }//view stationary

    public function getStationaryData(Request $request)
    {
        $data = DB::table('stationary_tbl')->select('st_id', 'st_type', 'price', 'quantity')->where('st_id', '=', $request->item)->get();
        foreach ($data as $da) {
            $type = $da->st_type;
            $price = $da->price;
            $qty = $da->quantity;
        }
        $tot = $price * $request->Qty;

        if ($request->Qty > $qty) {
            //stock is not enough
            $enough = 0;
            return $type . '--' . $request->Qty . '--' . $price . '--' . $tot . '--' . $enough;
        } else {
            $enough = 1;
            return $type . '--' . $request->Qty . '--' . $price . '--' . $tot . '--' . $enough;
        }
    }//fill stationary data to grid

    public function postStationary(Request $request)
    {
        $name = $request->input('name');
        $invNo = $request->input('invNo');
        $date = $request->input('date');

        $count = count($request->input('item'));//count no of items

        $item = $request->input('item');
        $qty = $request->input('qty');
        $tot = $request->input('tot');


        try {
            DB::table('stationary_inv_tbl')->insert([
                'st_inv_id' => $invNo,
                'admission_no' => $name,
                'st_date' => $date
            ]);//add invoice no
            $total = 0;
            for ($i = 0; $i < $count; $i++) {
                try {

                    $items = $this->getItemNO($item[$i]);

                    foreach ($items as $itm) {
                        $ino = $itm->st_id;
                        $StockQty = $itm->quantity;
                    }
                    DB::table('stationary_transaction_tbl')->insert([
                        'st_id' => $ino,
                        'quantity' => $qty[$i],
                        'amount' => $tot[$i],
                        'st_inv_id' => $invNo
                    ]);//add stationary data


                    DB::table('stationary_tbl')
                        ->where('st_id', $ino)
                        ->update(['quantity' => $StockQty - $qty[$i]]);//deduct stationary stock quantity

                    $total = $total + $tot[$i];

                } catch (QueryException $ex) {
                    return redirect('viewStationary')->with('error_code', 111);
                }
            }
            $disc = 0;
            $paid = $total;
            $this->saveCashInHand($date, $disc, $paid);//add income to cash in hand tabel
            return view('Invoice.stationaryInv', ['invNo' => $invNo, 'date' => $date, 'AdNo' => $name, 'total' => $total, 'count' => $count, 'item' => $item, 'qty' => $qty, 'tot' => $tot]);
        } catch (QueryException $ex) {
            return redirect('viewStationary')->with('error_code', 111);
        }

    }//insert stationary data and income

    public function getItemNO($itemNo)
    {
        $item = DB::table('stationary_tbl')->select('st_id', 'quantity')->where('st_type', 'LIKE', $itemNo)->get();
        return $item;
    }//get item no according to item name


    /****************************************** Other Income ************************************************************/

    public function viewOtherIncome()
    {
        return view('Activities.Revenue.otherIncome');
    }//View Other Income

    public function postOtherIncome(otherIncomeRequest $request)
    {
        try {
            $OIncome = new OtherIncome();
            $OIncome->date = $request->date;
            $OIncome->type = $request->type;
            $OIncome->amount = $request->amount;
            $OIncome->save();
        } catch (QueryException $ex) {
            return redirect('viewOtherIncome')->with('error_code', 111);
        }

        try {
            $disc = 0;
            $this->saveCashInHand($request->date, $disc, $request->amount);
        } catch (QueryException $ex) {
            return redirect('viewOtherIncome')->with('error_code', 111);
        }
        return redirect('viewOtherIncome')->with('error_code', 10);
    }//insert Other Income


}
