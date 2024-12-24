<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\TodoModel;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max_data = 2;

        if(request('search')){
            $data = TodoModel::where('task', 'like','%'.request('search').'%')->paginate($max_data)->withQueryString();
        } else {
            $data = TodoModel::orderBy('task','asc')->paginate($max_data);
        }
        return view('to-do.app',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|min:3|max:25'
        ], [
            'task.required' => 'Isian task wajib diisi',
            'task.min' => 'Minimal isin task 3 karakter',
            'task.max' => 'Max isin task 25 karakter',
        ]);

        $data = [
            'task'=>$request->input('task')
        ];

        TodoModel::create($data);
        return redirect()->route('todo')->with('success','Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'task' => 'required|min:3|max:25'
        ], [
            'task.required' => 'Isian task wajib diisi',
            'task.min' => 'Minimal isin task 3 karakter',
            'task.max' => 'Max isin task 25 karakter',
        ]);

        $data = [
            'task'=>$request->input('task'),
            'is_done'=>$request->input('is_done')
        ];

        TodoModel::where('id', $id)->update($data);
        return redirect()->route('todo')->with('success','Data berhasil diubah');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        TodoModel::where('id',$id)->delete();
        return redirect()->route('todo')->with('success','Data berhasil dihapus');
    }
}
