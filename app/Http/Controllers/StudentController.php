<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $students = Student::where('name', 'LIKE', '%' .
        $request->search_student. '%')->orderBy('name', 'ASC')
        ->simplePaginate(10);
        return view('student.index', compact('students'));


        // $students = Student::all();
        // return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|min:3',
           'type' => 'required|in:pria,wanita',
            'nis' => 'required|numeric',
            'rombel' => 'required|min:3',
        ]);

        Student::create([
            'name' => $request->name,
            'type' => $request->type,
            'nis' => $request->nis,
            'rombel' => $request->rombel,
        ]);


        return redirect()->back()->with('success', 'Berhasil menambah data siswa!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $student = Student::find($id);
        return view('student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required|min:3',
            'type' => 'required',
            'nis' => 'required|numeric',
        ]);

        Student::where('id', $id)->update([
            'name' => $request->name,
            'type' => $request->type,
            'nis' => $request->nis,
        ]);


            return redirect()->route('student.home')->with('success', 'Berhasil mengubah data obat!');
    }

    public function updateStock(Request $request, $id)
    {
        $studentBefore = Student::where('id', $id)->first();
        // validasi tidak dapat digunakan jika form disimpan dimodal dan tidak mengunakan ajax, penggantinya dengan isset
        if(!isset($request->rombel)) {
            return redirect()->back()->with([
                'failed' => 'pastikan rombel disini',
                 'id' => $id,
                  'name' => $studentBefore['name'],
                   'rombel' => $studentBefore['rombel'],
        ]);
        }
        // stock input tidak boleh kurang dari stock sebelumnya
        if ((string)$request->rombel < (string)$studentBefore['rombel']) {
            return redirect()->back()->with([
                'failed' => 'rombel baru tidak boleh sama dari rombel sebelumnnya!',
                'id' => $id,
                'name' => $studentBefore['name'],
                'rombel' => $studentBefore['student'],
            ]);
        }
        // jika tidak kosong atau stok baru input lebih dari sebelumnya data diupdate
        $studentBefore->update(['rombel' => $request->rombel]);
        return redirect()->back()->with('success', 'Berhasil mengubah data rombel siswa!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $student = Student::where('id', $id)->delete();


            return redirect()->back()->with('success', 'Berhasil menghapus data siswa!');
    }
}
