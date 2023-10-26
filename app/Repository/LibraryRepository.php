<?php

namespace App\Repository;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Grade;
use App\Models\Library;
use Termwind\Components\Li;


class LibraryRepository implements LibraryRepositoryInterface
{
    use AttachFilesTrait;
    public function index()
    {
        $books=Library::all();
        return view('pages.library.index',compact('books'));
    }

    public function create()
    {
        $grades=Grade::all();
        return view('pages.library.create',compact('grades'));
    }

    public function edit($id)
    {
        $book=Library::findOrFail($id);
        $grades=Grade::all();
       return view('pages.library.edit',compact('book','grades'));
    }

    public function store($request)
    {
        try {

           $book=new Library();
           $book->title=$request->title;
           $book->file_name=$request->file('file_name')->getClientOriginalName();;
           $book->Grade_id=$request->Grade_id;
           $book->Classroom_id=$request->Classroom_id;
           $book->section_id=$request->section_id;
           $book->teacher_id=1;
           $book->save();

            $this->uploadFile($request,'file_name','library');

            noty()->addSuccess(trans('messages.success'));
            return redirect()->route('Library.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function update($request)
    {

        try {

            $book=Library::findOrFail($request->id);
            $book->title=$request->title;
            $book->Grade_id=$request->Grade_id;
            $book->Classroom_id=$request->Classroom_id;
            $book->section_id=$request->section_id;
            $book->teacher_id=1;

            if ($request->hasfile('file_name')){
                $this->deleteFile($book->file_name,'library');
                $this->uploadFile($request,'file_name','library');
                $file_name_new=$request->file('file_name')->getClientOriginalName();

                $book->file_name=$book->file_name !==$file_name_new ?$file_name_new:$book->file_name;
            }

            $book->save();

            noty()->addInfo(trans('messages.Update'));
            return redirect()->route('Library.index');
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $this->deleteFile($request->file_name,'library');
        Library::destroy($request->id);
        noty()->addError(trans('messages.Delete'));
        return redirect()->route('Library.index');
    }

    public function downloadAttachment($file_name)
    {
            return response()->download(public_path('attachments/library/'.$file_name));
    }
}
