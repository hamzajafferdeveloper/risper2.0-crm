<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        return view("admin.employees.index");
    }

    public function add(){
        return view("admin.employees.add");
    }

    public function store(Request $request){
        //
    }

    public function show($id){
        // return view("");
    }

    public function edit($id){
        // return view("");
    }

    public function update(Request $request, $id){
        //
    }

    public function destroy($id){
        //
    }
}
