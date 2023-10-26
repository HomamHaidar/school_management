<?php

namespace App\Repository;

use App\Models\FundAccount;
use App\Models\PaymentStudent;
use App\Models\Student;
use App\Models\StudentAccount;
use Exception;
use Illuminate\Support\Facades\DB;

class PaymentRepository implements PaymentRepositoryInterface
{


    public function index()
    {
        $payment_students = PaymentStudent::all();
        return view('pages.Payment.index', compact('payment_students'));
    }

    public function Store($request)
    {
        DB::beginTransaction();

        try {
            $PaymentStudent = new PaymentStudent ();
            $PaymentStudent->date = date('Y-m-d');
            $PaymentStudent->student_id = $request->student_id;
            $PaymentStudent->amount = $request->Debit;
            $PaymentStudent->description = $request->description;

            $PaymentStudent->save();

            $student_accounts = new StudentAccount();

            $student_accounts->date=date('Y-m-d');
            $student_accounts->type='payment';
            $student_accounts->payment_id=$PaymentStudent->id;
            $student_accounts->student_id=$request->student_id;
            $student_accounts->Debit=$request->Debit;
            $student_accounts->credit=0.00;
            $student_accounts->description=$request->description;
            $student_accounts->save();

            $FundAccount = new FundAccount();
            $FundAccount->date = date('Y-m-d');
            $FundAccount->payment_id=$PaymentStudent->id;
            $FundAccount->Debit = 0.00;
            $FundAccount->credit = $request->Debit;
            $FundAccount->description = $request->description;
            $FundAccount->save();

            DB::commit();
            noty()->addSuccess(trans('messages.success'));
            return redirect()->route('Payment_Students.index');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.Payment.add', compact('student'));
    }

    public function edit($id)
    {
        $payment_student=PaymentStudent::findOrfail($id);
        return view('pages.Payment.edit', compact('payment_student'));
    }

    public function update($request)
    {
        DB::beginTransaction();

        try {
            $PaymentStudent =PaymentStudent::findOrFail($request->id);
            $PaymentStudent->date = date('Y-m-d');
            $PaymentStudent->student_id = $request->student_id;
            $PaymentStudent->amount = $request->Debit;
            $PaymentStudent->description = $request->description;
            $PaymentStudent->save();

            $student_accounts =StudentAccount::where('payment_id',$request->id )->first();
            $student_accounts->date=date('Y-m-d');
            $student_accounts->type='payment';
            $student_accounts->payment_id=$PaymentStudent->id;
            $student_accounts->student_id=$request->student_id;
            $student_accounts->Debit=$request->Debit;
            $student_accounts->credit=0.00;
            $student_accounts->description=$request->description;
            $student_accounts->save();

            $FundAccount =FundAccount::where('payment_id',$request->id)->first();
            $FundAccount->date = date('Y-m-d');
            $FundAccount->payment_id=$PaymentStudent->id;
            $FundAccount->Debit = 0.00;
            $FundAccount->credit = $request->Debit;
            $FundAccount->description = $request->description;
            $FundAccount->save();

            DB::commit();
            noty()->addInfo(trans('messages.Update'));
            return redirect()->route('Payment_Students.index');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy($request)
    {
        PaymentStudent::destroy($request->id);
        noty()->addError(trans('messages.Delete'));
        return redirect()->back();
    }
}
