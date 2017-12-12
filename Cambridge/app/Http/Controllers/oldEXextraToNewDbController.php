<?php

namespace App\Http\Controllers;

use App\Model\GetOldTF;
use App\Model\NewEXextra;
use App\Model\NewTF;
use Illuminate\Http\Request;

class oldEXextraToNewDbController extends Controller
{
    ##########################################  Only for database conversion ##########################################################

    function oldExExFtoNew()
    {
        ini_set('max_execution_time', 0);

        $oldTF = new GetOldTF();

        $oldExExFee = $oldTF->getAllOldExExF();//get all exam & extra fee data
        $oldExExFee->each(function ($OExExF) {

            $oldTF = new GetOldTF();
            $NewExEx = new NewEXextra();
            $NTF=new NewTF();

            $adNo = $OExExF->addmission_no;
            $amt = $OExExF->amount;
            $date = $OExExF->term_invoice_date;
            $pmethod = $OExExF->payment_method;
            $year = substr($OExExF->term_invoice_date, 0, 4);
            $inv = $OExExF->term_fee_id;
            $c_cat = $OExExF->c_catetory;
            $p_type = $OExExF->payment_type;

            $cat = $oldTF->getCategory($OExExF->class_category);
            $term = $oldTF->getTerm($OExExF->term_id);

            if ($p_type == "Extra Curricular Fees") {
                if($c_cat=="nc"){
                    $UpdateExt = $NewExEx->addExtExmFee($term,$adNo,$cat,$amt,$year,"Ext","new_nc_ex_curr_tbl","NCEXTF",$inv,$date,$pmethod);
                }
                elseif($c_cat=="bc"){
                    $UpdateExt = $NewExEx->addExtExmFee($term,$adNo,$cat,$amt,$year,"Ext","new_bc_ex_curr_tbl","BCEXTF",$inv,$date,$pmethod);
                }
            } //add extra fee
            elseif ($p_type == "Exam Fees") {
                if($c_cat=="nc"){
                    $UpdateExm = $NewExEx->addExtExmFee($term,$adNo,$cat,$amt,$year,"Exm","new_nc_exam_tbl","NCEF",$inv,$date,$pmethod);
                }
                elseif($c_cat=="bc"){
                    $UpdateExm = $NewExEx->addExtExmFee($term,$adNo,$cat,$amt,$year,"Exm","new_bc_exam_tbl","BCEF",$inv,$date,$pmethod);
                }
            }//add exam fee
            else {
                if($c_cat=="nc"){
                    $else = $NewExEx->addExtExmFee($term,$adNo,$cat,$amt,$year,"err",0,0,0,$date,$pmethod);
                }
                elseif($c_cat=="bc"){
                    $else = $NewExEx->addExtExmFee($term,$adNo,$cat,$amt,$year,"err",0,0,0,$date,$pmethod);
                }
            }//detect fault data
        });

    }

}
