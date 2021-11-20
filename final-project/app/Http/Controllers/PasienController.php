<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pasien = Pasien::all();

        $total = count($pasien);

        if ($total) {
            $data = [
                'message' => 'Get All Resource',
                'total' => $total,
                'data' => $pasien
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data is kosong'
            ];

            return response()->json($data, 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'nama' => 'required',
            'phone' => 'required',
            'alamat' => 'required',
            'status' => 'required',
            'tanggal_masuk' => 'required',
            'tanggal_keluar' => 'required'
        ])->validate();

        $pasien = Pasien::create([
            'nama' => $request->nama,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
            'status' => $request->status,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_keluar' => $request->tanggal_keluar
        ]);

        $data = [
            'pesan' => 'Resource is added successfully',
            'data' => $pasien
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($pasien)
    {
        $pasien = Pasien::find($pasien);

        if ($pasien) {
            $data = [
                'message' => 'Get Detail Resource',
                'data' => $pasien
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found'
            ];

            return response()->json($data, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pasien)
    {
        $pasien = Pasien::find($pasien);

        if ($pasien) {
            $pasien->update($request->all());
            $data = [
                'message' => 'Resource is update successfully',
                'data' => $pasien
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found'
            ];

            return response()->json($data, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function destroy($pasien)
    {
        $pasien = Pasien::find($pasien);

        if ($pasien) {
            $pasien->delete();
            $data = [
                'message' => 'Resource is delete successfully'
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found'
            ];

            return response()->json($data, 404);
        }
    }

    /**
     * Method (GET) Search Resource by name.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        $pasien = Pasien::where('nama', 'like', '%' . $name . '%')->get();

        $total = count($pasien);

        if ($total) {
            $data = [
                'message' => 'Get searched resource',
                'total' => $total,
                'data' => $pasien
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found'
            ];

            return response()->json($data, 404);
        }
    }

    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function searchByStatus($status)
    {
        $pasien = Pasien::where('status', $status)->get();

        $total = count($pasien);

        if ($total) {
            $data = [
                'message' => 'Get status resource',
                'total' => $total,
                'data' => $pasien
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found'
            ];

            return response()->json($data, 404);
        }
    }

    /**
     * Method (GET) Positive Resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function positive()
    {
        return $this->searchByStatus('positive');
    }

    /**
     * Method (GET) Recovered Resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function recovered()
    {
        return $this->searchByStatus('recovered');
    }

    /**
     * Method (GET) Dead Resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function dead()
    {
        return $this->searchByStatus('dead');
    }
}