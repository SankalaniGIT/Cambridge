<?php

namespace App\Http\Controllers;

use App\Model\GetOldTF;
use App\Model\NewTF;
use Illuminate\Http\Request;

class oldTFtoNewDbController extends Controller
{

    ##########################################  Only for database conversion ##########################################################

    public function oldTFtoNew()
    {
        ini_set('max_execution_time', 0);

        $OldTF = new GetOldTF();
        $NTF = new NewTF();

        $oldTFdata = $OldTF->getAllOldTF();//get all old term fee data

        $oldTFdata->each(function ($OTF) {
            $OldTF = new GetOldTF();
            $NTF = new NewTF();

            $adNo = $OTF->addmission_no;
            $amt = $OTF->amount;
            $date = $OTF->term_invoice_date;
            $pmethod = $OTF->payment_method;
            $year = substr($OTF->term_invoice_date, 0, 4);
            $inv = $OTF->term_fee_id;
            $c_cat = $OTF->c_catetory;

            $cat = $OldTF->getCategory($OTF->class_category);
            $term = $OldTF->getTerm($OTF->term_id);


            $PM = $OTF->payment_method;
            $lastPaid = $NTF->getLastInsertedPayment($term, $OTF->addmission_no, $cat);//get last inserted payment of new TF table
            $TCount = $lastPaid[2];

            if ($lastPaid[0] == 0) {//insert as new term

                if ($PM == 4) {
                    $state = $NTF->insertOldTFtoNew($adNo, $amt, $date, $pmethod, $year, $inv, $c_cat, $cat, $term, $count = 0);//insert full term fee
                } elseif ($PM == 3) {
                    $state = $NTF->insertOldTFtoNew($adNo, $amt / 3, $date, 1, $year, $inv, $c_cat, $cat, $term, $count = 0);//insert 1st payment term fee
                    $state = $NTF->insertOldTFtoNew($adNo, $amt / 3, $date, 2, $year, $inv, $c_cat, $cat, $term, $count = 0);//insert 2nd payment term fee
                    $state = $NTF->insertOldTFtoNew($adNo, $amt / 3, $date, 3, $year, $inv, $c_cat, $cat, $term, $count = 1);//insert 3rd payment term fee
                } elseif ($PM == 2) {
                    $state = $NTF->insertOldTFtoNew($adNo, $amt / 2, $date, 1, $year, $inv, $c_cat, $cat, $term, $count = 0);//insert 1st payment term fee
                    $state = $NTF->insertOldTFtoNew($adNo, $amt / 2, $date, 2, $year, $inv, $c_cat, $cat, $term, $count = 0);//insert 2nd payment term fee
                } elseif ($PM == 1) {
                    $state = $NTF->insertOldTFtoNew($adNo, $amt, $date, 1, $year, $inv, $c_cat, $cat, $term, $count = 0);//insert 1st payment term fee
                }
            } elseif ($lastPaid[1] == 1) {//already paid for 1st payment
                if ($PM == 4) {
                    $state = $NTF->insertOldTFtoNew($adNo, $amt / 4, $date, 2, $year, $inv, $c_cat, $cat, $term, $count = 0);//insert 2nd payment term fee
                    $state = $NTF->insertOldTFtoNew($adNo, $amt / 2, $date, 3, $year, $inv, $c_cat, $cat, $term, $count = 2);//insert 3rd payment term fee
                    if (substr($term, 1, 1) == 2) {
                        $state = $NTF->insertOldTFtoNew($adNo, $amt / 4, $date, 1, $year, $inv, $c_cat, $cat, "T3", $count = 0);//insert 1st payment next term fee
                    } elseif (substr($term, 1, 1) == 1) {
                        $state = $NTF->insertOldTFtoNew($adNo, $amt / 4, $date, 1, $year, $inv, $c_cat, $cat, "T2", $count = 0);//insert 1st payment next term fee
                    }
                } elseif ($PM == 3) {
                    $state = $NTF->insertOldTFtoNew($adNo, $amt / 3, $date, 2, $year, $inv, $c_cat, $cat, $term, $count = 0);//insert 2nd payment term fee
                    $state = $NTF->insertOldTFtoNew($adNo, ($amt / 3) * 2, $date, 3, $year, $inv, $c_cat, $cat, $term, $count = 2);//insert 3rd payment term fee
                } elseif ($PM == 2) {
                    $state = $NTF->insertOldTFtoNew($adNo, $amt / 2, $date, 2, $year, $inv, $c_cat, $cat, $term, $count = 0);//insert 2nd payment term fee
                    $state = $NTF->insertOldTFtoNew($adNo, $amt / 2, $date, 3, $year, $inv, $c_cat, $cat, $term, $count = 1);//insert 3rd payment term fee
                } elseif ($PM == 1) {
                    $state = $NTF->insertOldTFtoNew($adNo, $amt, $date, 2, $year, $inv, $c_cat, $cat, $term, $count = 0);//insert 2nd payment term fee
                }

            } elseif ($lastPaid[1] == 2) {//already paid for 2nd payment
                if ($PM == 4) {
                    $state = $NTF->insertOldTFtoNew($adNo, $amt / 2, $date, 3, $year, $inv, $c_cat, $cat, $term, $count = 2);//insert 3rd payment term fee

                    if (substr($term, 1, 1) == 2) {
                        $state = $NTF->insertOldTFtoNew($adNo, $amt / 4, $date, 1, $year, $inv, $c_cat, $cat, "T3", $count = 0);//insert 1st payment next term fee
                        $state = $NTF->insertOldTFtoNew($adNo, $amt / 4, $date, 2, $year, $inv, $c_cat, $cat, "T3", $count = 0);//insert 2nd payment term fee
                    } elseif (substr($term, 1, 1) == 1) {
                        $state = $NTF->insertOldTFtoNew($adNo, $amt / 4, $date, 1, $year, $inv, $c_cat, $cat, "T2", $count = 0);//insert 1st payment next term fee
                        $state = $NTF->insertOldTFtoNew($adNo, $amt / 4, $date, 2, $year, $inv, $c_cat, $cat, "T2", $count = 0);//insert 2nd payment term fee
                    }

                } elseif ($PM == 3) {
                    $state = $NTF->insertOldTFtoNew($adNo, ($amt / 3) * 2, $date, 3, $year, $inv, $c_cat, $cat, $term, $count = 2);//insert 3rd payment term fee

                    if (substr($term, 1, 1) == 2) {
                        $state = $NTF->insertOldTFtoNew($adNo, $amt / 3, $date, 1, $year, $inv, $c_cat, $cat, "T3", $count = 0);//insert 1st payment next term fee
                    } elseif (substr($term, 1, 1) == 1) {
                        $state = $NTF->insertOldTFtoNew($adNo, $amt / 3, $date, 1, $year, $inv, $c_cat, $cat, "T2", $count = 0);//insert 1st payment next term fee
                    }

                } elseif ($PM == 2) {
                    $state = $NTF->insertOldTFtoNew($adNo, $amt, $date, 3, $year, $inv, $c_cat, $cat, $term, $count = 2);//insert 3rd payment term fee
                } elseif ($PM == 1) {
                    $state = $NTF->insertOldTFtoNew($adNo, $amt, $date, 3, $year,$inv, $c_cat, $cat, $term, $count = 1);//insert 3rd payment term fee
                }
            } elseif ($lastPaid[1] == 3) {//already paid for 3rd payment
                if ($TCount == 1) {
                    $state = $NTF->updateOldTFtoNew( $lastPaid[0],$lastPaid[3]+$amt, $inv,$c_cat);//insert 3rd payment term fee
                }
            } elseif ($lastPaid[1] == 4) {//already paid for full payment

            }


        });//insert all term fee
    }

}
