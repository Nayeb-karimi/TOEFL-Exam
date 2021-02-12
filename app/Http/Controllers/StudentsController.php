<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Record;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
  public function import(Request $request)
  {
      $request->validate([
          'import_file' => 'required|file|mimes:xls,xlsx',
      ]);

      $path = $request->file('import_file');
      $data = Excel::import(new StudentsImport, $path);

      Record::create([
        'date' => date('Y-m-d'),
        'user_id' => auth()->user()->id,
      ]);

      return response()->json(['message' => 'uploaded successfully'], 200);
  }

  public function index(){
      $record = Record::latest()->where('user_id', auth()->user()->id)->first();
      if($record === null){
        return [];
      }else{
        return Student::all()->where('created_at' , '=', $record->created_at);
      }
  }

  public function update(Request $request, $id){
      $student = Student::findOrFail($id);
      $request->merge(['scored'=>true]);
      $student->update($request->all());
      return "Updated!";
  }

  public function store(Request $request){
      Student::create($request->all());
      return "Stored!";
  }

  public function destroy($id){
      $student = Student::findOrFail($id);
      $student->delete();
      return "Deleted!";
  }

  public function search($text){
      return DB::table('students')
      ->where('first_name', 'like', '%' . ucwords($text) . '%')
      ->orWhere('last_name', 'like', '%' . ucwords($text) . '%')
      ->get();
  }

  public function undo(Student $student)
  {
      $student->update([
          'scored' => false,
          'task_completion' => 0,
          'comprehensibility' => 0,
          'fluency' => 0,
          'vocabulary' => 0,
          'language_control' => 0,
          'score' => 0,
          'comment' => ''
      ]);
      return 'Done!';
  }

  public function records(){
    return Record::all()->where('user_id', auth()->user()->id);
  }

  public function show($id){
    $record = Record::findOrFail($id);
    return Student::all()->where('created_at', '=', $record->created_at);
  }
}
