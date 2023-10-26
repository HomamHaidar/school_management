<?php

namespace App\Repository;

use App\Models\ProcessingFee;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class ProcessingFeeRepository implements ProcessingFeeRepositoryInterface
{

    public function index()
    {
        $ProcessingFees=ProcessingFee::all();
        return view('pages.ProcessingFee.index',compact('ProcessingFees'));
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $prosess=new ProcessingFee();
            $prosess->date=date('Y-m-d');
            $prosess->student_id=$request->student_id;
            $prosess->amount=$request->Debit;
            $prosess->description=$request->description;
            $prosess->save();

            $account=new StudentAccount();
            $account->date=date('Y-m-d');
            $account->type='ProcessingFee';
            $account->student_id=$request->student_id;
            $account->processing_id=$prosess->id;
            $account->Debit=0.00;
            $account->credit=$request->Debit;
            $account->description=$request->description;
            $account->save();

            DB::commit();
            noty()->addSuccess(trans('messages.success'));
            return redirect()->route('Processing_Fee.index');

        } catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function show($id)
    {
        $student=Student::findOrFail($id);
        return view('pages.ProcessingFee.add',compact('student'));
    }

    public function edit($id)
    {
        $ProcessingFee=ProcessingFee::findOrFail($id);
        return view('pages.ProcessingFee.edit',compact('ProcessingFee'));
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {
            $prosess=ProcessingFee::findOrFail($request->id);
            $prosess->date=date('Y-m-d');
            $prosess->student_id=$request->student_id;
            $prosess->amount=$request->Debit;
            $prosess->description=$request->description;
            $prosess->save();

            $account=StudentAccount::where('processing_id',$request->id)->first();
            $account->date=date('Y-m-d');
            $account->type='ProcessingFee';
            $account->student_id=$request->student_id;
            $account->processing_id=$prosess->id;
            $account->Debit=0.00;
            $account->credit=$request->Debit;
            $account->description=$request->description;
            $account->save();

            DB::commit();
            noty()->addInfo(trans('messages.Update'));
            return redirect()->route('Processing_Fee.index');

        } catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        ProcessingFee::destroy($request->id);
        noty()->addError(trans('messages.Delete'));
        return redirect()->route('Processing_Fee.index');

    }
}
