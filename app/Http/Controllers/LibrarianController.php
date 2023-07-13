<?php

namespace App\Http\Controllers;

use App\Models\Librarian;
use Illuminate\Http\Request;

class LibrarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $librarians = Librarian::all();
        return response()->json(["data" => $librarians]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $path = $request->hasFile("image") ?  $request->file("image")->store("image/librarian") : null;
        $librarian = Librarian::create(["nama" => $request->nama, "alamat" => $request->alamat, "telepon" => $request->telepon, "image" => $path]);
        return response()->json(["data" => $librarian]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Librarian $librarian)
    {
        return response()->json(["data" => $librarian]);
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Librarian $librarian)
    {
        if (!$request->hasFile("image")) {
            $librarian->update(["nama" => $request->nama, "alamat" => $request->alamat, "telepon" => $request->telepon]);
            return response()->json(["data" => $librarian]);
        }
        if ($librarian->image) {
            unlink(public_path() . '/storage/' . $librarian->image);
        }
        $path =  $request->file("image")->store("image/librarian");
        $librarian->update(["nama" => $request->nama, "alamat" => $request->alamat, "telepon" => $request->telepon, "image" => $path]);

        return response()->json(["data" => $librarian]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Librarian $librarian)
    {
        $librarian->delete();
        return response()->json(["data" => $librarian], 204);
    }
}
