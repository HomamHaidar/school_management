<?php

namespace App\Repository;

use App\Models\Fee;
use App\Models\Fee_invoices;
use App\Models\Grade;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class FeeInvoicesRepository implements FeeInvoicesRepositoryInterface
{

    public function index()
    {

        $Fee_invoices = Fee_invoices::all();
        $Grades = Grade::all();
        return view('pages.Fees_Invoices.index',compact('Fee_invoices','Grades'));
    }

    public function Store($request)
    {
        $list=$request->List_Fees;
        DB::beginTransaction();
        try {
            foreach ($list as $l){

                $fee=new Fee_invoices();
                $fee->invoice_date=date('Y-m-d');
                $fee->student_id=$l['student_id'];
                $fee->Grade_id=$request->Grade_id;
                $fee->Classroom_id=$request->Classroom_id;
                $fee->fee_id=$l['fee_id'];
                $fee->amount=$l['amount'];
                $fee->description=$l['description'];
                $fee->save();

                $account=new StudentAccount();
                $account->student_id =$l['student_id'];
                $account->fee_invoice_id =$fee->id;
                $account->date=date('Y-m-d');
                $account->type ='invoice';
                $account->Debit =$l['amount'];
                $account->credit =0.00;
                $account->description =$l['description'];
                $account->save();
            }
            DB::commit();
            noty()->addSuccess(trans('messages.success'));
            return redirect()->route('Fees_invoices.index');

        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function show($id)
    {
        $student=Student::findOrFail($id);

        $fees=Fee::where('Classroom_id',$student->Classroom_id)->get();

        return view('pages.Fees_Invoices.add',compact('student','fees'));
    }

    public function edit($id)
    {
        $fee_invoices=Fee_invoices::findOrFail($id);
        $fees=Fee::where('Classroom_id',$fee_invoices->Classroom_id)->get();
        return view('pages.Fees_Invoices.edit',compact('fee_invoices','fees'));
    }

    public function update($request)
    {

        DB::beginTransaction();
        try {
            $fee_inv=Fee_invoices::findORFail($request->id);
            $fee_inv->fee_id=$request->fee_id;
            $fee_inv->amount=$request->amount;
            $fee_inv->description =$request->description;
            $fee_inv->save();

            $account= StudentAccount::where('fee_invoice_id',$request->id)->first();
            $account->Debit=$request->amount;
            $account->description =$request->description;
            $account->save();

            DB::commit();
            noty()->addInfo(trans('messages.Update'));
            return redirect()->route('Fees_invoices.index');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
         Fee_invoices::destroy($request->id);
        noty()->addError(trans('messages.Delete'));
        return redirect()->back();
    }
}
