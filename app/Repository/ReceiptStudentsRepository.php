<?php

namespace App\Repository;

use App\Models\FundAccount;
use App\Models\ReceiptStudent;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class ReceiptStudentsRepository implements ReceiptStudentsRepositoryInterface
{

    public function index()
    {
        $receipt_students=ReceiptStudent::all();
        return view('pages.Receipt.index',compact('receipt_students'));
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $receipt= new ReceiptStudent();
            $receipt->date=date('Y-m-d');
            $receipt->student_id=$request->student_id;
            $receipt->Debit=$request->Debit;
            $receipt->description=$request->description;
            $receipt->save();

            $account =new StudentAccount();
            $account->receipt_id=$receipt->id;
            $account->date=date('Y-m-d');
            $account->type='receipt';
            $account->student_id=$request->student_id;
            $account->Debit=0.00;
            $account->credit=$request->Debit;
            $account->description=$request->description;
            $account->save();

            $fund= new FundAccount();
            $fund->receipt_id=$receipt->id;
            $fund->date=date('Y-m-d');
            $fund->Debit=$request->Debit;
            $fund->credit=0.00;
            $fund->description=$request->description;
            $fund->save();

            DB::commit();
            noty()->addSuccess(trans('messages.success'));
            return redirect()->route('Receipt_Students.index');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function show($id)
    {
        $student=Student::findOrFail($id);
      return view('pages.fee.add',compact('student'));
    }

    public function edit($id)
    {
        $receipt_student=ReceiptStudent::findOrFail($id);
        return view('pages.fee.edit',compact('receipt_student'));
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {

            $receipt= ReceiptStudent::findOrFAil($request->id);
            $receipt->date=date('Y-m-d');
            $receipt->student_id=$request->student_id;
            $receipt->Debit=$request->Debit;
            $receipt->description=$request->description;
            $receipt->save();

            $account =StudentAccount::where('receipt_id',$request->id)->first();
            $account->receipt_id=$receipt->id;
            $account->date=date('Y-m-d');
            $account->type='receipt';
            $account->student_id=$request->student_id;
            $account->Debit=0.00;
            $account->credit=$request->Debit;
            $account->description=$request->description;
            $account->save();

            $fund=FundAccount::where('receipt_id',$request->id)->first();
            $fund->receipt_id=$receipt->id;
            $fund->date=date('Y-m-d');
            $fund->Debit=$request->Debit;
            $fund->credit=0.00;
            $fund->description=$request->description;
            $fund->save();

            DB::commit();
            noty()->addInfo(trans('messages.Update'));
            return redirect()->route('Receipt_Students.index');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {

        ReceiptStudent::destroy($request->id);
        noty()->addError(trans('messages.Delete'));
        return redirect()->back();
    }
}
