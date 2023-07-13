<?php

namespace App\Http\Controllers;

use App\Models\Lending;
use App\Http\Requests\StoreLendingRequest;
use App\Http\Requests\UpdateLendingRequest;
use Illuminate\Http\Request;

class LendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lend = Lending::all();
        return response()->json(["data" => $lend]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lend = Lending::create(["borrow_start" => $request->borrow_start, "borrow_end" => $request->borrow_end, "book_id" => $request->book_id, "librarian_id" => $request->librarian_id, "student_id" => $request->student_id]);
        return response()->json(["data" => $lend]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lending $lend)
    {
        return response()->json(["data" => $lend]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lending $lend)
    {
        $lend->update(["borrow_start" => $request->borrow_start, "borrow_end" => $request->borrow_end, "book_id" => $request->book_id, "librarian_id" => $request->librarian_id, "student_id" => $request->student_id]);
        return response()->json(["data" => $lend]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lending $lend)
    {
        $lend->delete();
        return response()->json(["data" => $lend], 204);
    }
}
