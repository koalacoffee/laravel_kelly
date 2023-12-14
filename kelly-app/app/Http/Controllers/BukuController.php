<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Buku::latest()->paginate(10);
        return view('buku.index',compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buku.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $foto = $request->file('foto');
        $foto->storeAs('public/buku',$foto->hashName());
        $buku = Buku::create([
            'nama' => $request->nama,
            'foto' => $foto->hashName(),
            'penerbit' => $request->penerbit,
            'pengarang' => $request->pengarang,
        ]);
        if  ($buku){
            return redirect()->route('buku.index')->with(['success'=>'Data Berhasil Disimpan!']);
        } else{
            return redirect()->route('buku.index')->with(['error'=>'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = buku::find($id);
        return view('buku.update', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);
        if ($request->file('foto')==""){
            $buku->update([
                'nama'=>$request->nama,
                'penerbit'=>$request->penerbit,
                'pengarang'=>$request->pengarang
            ]);
        } else{
            Storage::disk('local')->delete('public/buku'.$buku->foto);
            $foto = $request->file('foto');
            $foto->storeAs('public/buku',$foto->hashName());
            $buku->update([
                'nama'=>$request->nama,
                'foto'=>$foto->hashName(),
                'penerbit'=>$request->penerbit,
                'pengarang'=>$request->pengarang,
            ]);
        }
        if ($buku){
            return redirect()->route('buku.index')->with(['success'=>'Data Berhasil Diubah!']);
        } else{
            return redirect()->route('buku.index')->with(['error'=>'Data Gagal Diubah!']);    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        Storage::disk('local')->delete('public/buku/'.$buku->gambar);
        $buku->delete();
        if ($buku){
            return redirect()->route('buku.index')->with(['success'=>'Data Berhasil Dihapus']);
        } else{
            return redirect()->route('buku.index')->with(['error'=>'Data Gagal Dihapus']);    
        }
    }
}