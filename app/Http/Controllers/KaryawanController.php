<?php

namespace App\Http\Controllers;
use App\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::all();
        
        return response()->json([
            'success' => true,
            'message' =>'Data karyawan yang tersedia',
            'data'    => $karyawan
        ], 200);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_karyawan'   => 'required',
            'nip' => 'required',
            'jabatan' => 'required',
            'alamat' => 'required',
        ]);
        
        if ($validator->fails()) {
            
            return response()->json([
                'success' => false,
                'message' => 'Semua kolom wajib diisi!',
                'data'   => $validator->errors()
            ],401);
            
        } else {
            
            $karyawan = Karyawan::create([
                'nama_karyawan'     => $request->input('nama_karyawan'),
                'nip'   => $request->input('nip'),
                'jabatan'   => $request->input('jabatan'),
                'alamat'   => $request->input('alamat'),
            ]);
            
            if ($karyawan) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Karyawan Berhasil Disimpan!',
                    'data' => $karyawan
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Karyawan Gagal Disimpan!',
                ], 400);
            }
            
        }
    }
    
    public function show($id)
    {
        $karyawan = Karyawan::find($id);
        
        if ($karyawan) {
            return response()->json([
                'success'   => true,
                'message'   => 'Detail Data Karyawan',
                'data'      => $karyawan
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Karaywan Tidak Ditemukan!',
            ], 404);
        }
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_karyawan'   => 'required',
            'nip' => 'required',
            'jabatan' => 'required',
            'alamat' => 'required',
        ]);
        
        if ($validator->fails()) {
            
            return response()->json([
                'success' => false,
                'message' => 'Semua Kolom Wajib Diisi!',
                'data'   => $validator->errors()
            ],401);
            
        } else {
            
            $karyawan = Karyawan::whereId($id)->update([
                'nama_karyawan'     => $request->input('nama_karyawan'),
                'nip'   => $request->input('nip'),
                'jabatan'   => $request->input('jabatan'),
                'alamat'   => $request->input('alamat'),
            ]);
            
            if ($karyawan) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Karyawan Berhasil Diupdate!',
                    'data' => $karyawan
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Karyawan Gagal Diupdate!',
                ], 400);
            }
            
        }
    }
    
    public function destroy($id)
    {
        $karyawan = Karyawan::whereId($id)->first();
        $karyawan->delete();
        
        if ($karyawan) {
            return response()->json([
                'success' => true,
                'message' => 'Data Karyawan Berhasil Dihapus!',
            ], 200);
        }
        
    }
    
    
}