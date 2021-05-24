<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Models\MasterBankSoal;
use Exception;
use GrahamCampbell\ResultType\Result;

class BankSoalController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function BankSoal(Request $request)
    {
        if ($this->request->input('tutor_id') !== null) {
            $bank_soal = MasterBankSoal::select("*")
                ->join('mapel', 'mapel.mapel_id', '=', 'master_bank_soal.mapel_id')
                ->join('tutor', 'tutor.tutor_id', '=', 'master_bank_soal.tutor_id')
                ->where('master_bank_soal.display')
                ->where('master_bank_soal.tutor_id', $this->request->input('tutor_id'))->get();
        } else {
            $bank_soal = MasterBankSoal::select("*")
                ->join('mapel', 'mapel.mapel_id', '=', 'master_bank_soal.mapel_id')
                ->join('tutor', 'tutor.tutor_id', '=', 'master_bank_soal.tutor_id')
                ->where('master_bank_soal.display')->get();
        }

        return response()->json([
            'status' => 'true',
            'data' => $bank_soal,
            'record' => count($bank_soal)
        ], 200);
    }

    public function BankSoalAdd(Request $request)
    {
        $data = $this->request->input();

        foreach ($data as $key => $v) {
            $master = new MasterBankSoal();

            $master->mapel_id = $v['mapel_id'];
            $master->tutor_id = $v['tutor_id'];
            $master->durasi = $v['durasi'];
            $master->jumlah_soal = $v['jumlah_soal'];
            $master->descripsi = $v['descripsi'];
            $master->save();

            foreach ($v['data_soal'] as $key => $soal) {
                // echo $master->master_bank_soal_id;
                DB::table('evaluasi')->insert([
                    "evaluasi_content_text" => $soal['evaluasi_content_text'],
                    "evaluasi_content_img" => $soal['evaluasi_content_img'],
                    "pilhan_ganda_satu" => $soal['pilihan_ganda_satu'],
                    "pilihan_ganda_dua" => $soal['pilihan_ganda_dua'],
                    "pilihan_ganda_tiga" => $soal['pilihan_ganda_tiga'],
                    "pilihan_ganda_empat" => $soal['pilihan_ganda_empat'],
                    "master_bank_soal_id" => $master->master_bank_soal_id
                ]);
            }
        }


        return response()->json([
            'status' => 'true',
            'message' => 'successfuly'
        ], 200);
    }

    public function EvaluasiAll(Request $request)
    {
        $roles = [
            'master_bank_soal_id' => 'required'
        ];

        $message = [
            'master_bank_soal_id.required' => 'master bank soal id tidak boleh kosong',
        ];

        $valid = Validator::make($request->all(), $roles, $message);

        if ($valid->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => $valid->errors(),

            ], 500);
        };

        $evaluasi = DB::table('evaluasi')
            ->where('display')
            ->where('master_bank_soal_id', $this->request->input('master_bank_soal_id'))->get();

        if (count($evaluasi) === 0) {
            return response()->json([
                'status' => 'false',
                'message' => 'Data tidak dapat ditemukan',

            ], 404);
        }

        return response()->json([
            'status' => 'true',
            'data' => $evaluasi,
            'record' => count($evaluasi),
            'message' => 'Data berhasil ditemukan',
        ], 200);
    }

    public function EvaluasiList(Request $request)
    {
        $roles = [
            'master_bank_soal_id' => 'required',
            'evaluasi_id' => 'required'
        ];

        $message = [
            'master_bank_soal_id.required' => 'master bank soal id tidak boleh kosong',
            'evaluasi_id.required' => 'evaluasi id tidak boleh kosong',
        ];

        $valid = Validator::make($request->all(), $roles, $message);

        if ($valid->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => $valid->errors(),

            ], 500);
        };

        $evaluasi = DB::table('evaluasi')
            ->where('display')
            ->where('master_bank_soal_id', $this->request->input('master_bank_soal_id'))
            ->where('evaluasi_id', $this->request->input('evaluasi_id'))
            ->get();

        if (count($evaluasi) === 0) {
            return response()->json([
                'status' => 'false',
                'message' => 'Data tidak dapat ditemukan',

            ], 404);
        }

        return response()->json([
            'status' => 'true',
            'data' => $evaluasi,
            'record' => count($evaluasi),
            'message' => 'Data berhasil ditemukan',
        ], 200);
    }

    public function EvaluasiUpdate(Request $request)
    {
        $roles = [
            'evaluasi_id' => 'required',
        ];

        $message = [
            'evaluasi_id.required' => 'tevaluasi id boleh kosong'
        ];

        $valid = Validator::make($request->all(), $roles, $message);

        if ($valid->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => $valid->errors(),

            ], 500);
        };

        $evaluasi = DB::table('evaluasi')
            ->whereNull('display')
            ->where('evaluasi_id', $this->request->input('evaluasi_id'));

        if (count($evaluasi->get()) === 0) {
            return response()->json([
                'status' => 'false',
                'message' => 'Data tidak dapat ditemukan',

            ], 404);
        }

        try {
            $evaluasi->update([
                "evaluasi_content_text" => $this->request->input('evaluasi_content_text'),
                "evaluasi_content_img" => $this->request->input('evaluasi_content_img'),
                "pilhan_ganda_satu" => $this->request->input('pilhan_ganda_satu'),
                "pilihan_ganda_dua" => $this->request->input('pilihan_ganda_dua'),
                "pilihan_ganda_tiga" => $this->request->input('pilihan_ganda_tiga'),
                "pilihan_ganda_empat" => $this->request->input('pilihan_ganda_empat'),
            ]);

            return response()->json([
                'status' => 'true',
                'message' => 'Successfuly',

            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'false',
                'message' => $e,

            ], 400);
        }
    }

    public function EvaluasiDelete($id)
    {
        if ($id === null) {
            return response()->json([
                'status' => 'false',
                'message' => 'id tidak boleh kosong',

            ], 500);
        };

        $bank_soal = DB::table('evaluasi')->where('evaluasi_id', $id);

        if (count($bank_soal->get()) === 0) {
            return response()->json([
                'status' => 'false',
                'message' => 'Data tidak dapat ditemukan',

            ], 404);
        }

        try {

            $evaluasi = DB::table('evaluasi')->where('evaluasi_id', $id);
            $evaluasi->delete();

            return response()->json([
                'status' => 'true',
                'message' => 'Successfuly',

            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'false',
                'message' => $e,

            ], 400);
        }
    }

    public function BankSoalEdit(Request $request)
    {

        $roles = [
            'tutor_id' => 'required',
            'master_bank_soal_id' => 'required'
        ];

        $message = [
            'tutor_id.required' => 'tutor id tidak boleh kosong',
            'master_bank_soal_id.required' => 'master bank soal id tidak boleh kosong',
        ];

        $valid = Validator::make($request->all(), $roles, $message);

        if ($valid->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => $valid->errors(),

            ], 500);
        };

        $bank_soal = MasterBankSoal::select("*")
            ->join('mapel', 'mapel.mapel_id', '=', 'master_bank_soal.mapel_id')
            ->join('tutor', 'tutor.tutor_id', '=', 'master_bank_soal.tutor_id')
            ->whereNull('master_bank_soal.display')
            ->where('master_bank_soal.tutor_id', $this->request->input('tutor_id'))
            ->where('master_bank_soal.master_bank_soal_id', $this->request->input('master_bank_soal_id'))->get();
        if (count($bank_soal) === 0) {
            return response()->json([
                'status' => 'false',
                'message' => 'Data tidak ditemukan',
                'data' => $bank_soal,
                'record' => count($bank_soal)

            ], 404);
        }

        return response()->json([
            'status' => 'false',
            'message' => 'Data ditemukan',
            'data' => $bank_soal,
            'record' => count($bank_soal)

        ], 200);
    }

    public function BankSoalUpdate(Request $request)
    {

        $roles = [
            'master_bank_soal_id' => 'required',
            'jumlah_soal' => 'required',
            'durasi' => 'required',
            'descripsi' => 'required'
        ];

        $message = [
            'master_bank_soal_id.required' => 'master bank soal id tidak boleh kosong',
            'jumlah_soal.required' => 'jumlah soal tidak boleh kosong',
            'durasi.required' => 'durasi tidak boleh kosong',
            'descripsi.required' => 'descripsi tidak boleh kosong',
        ];

        $valid = Validator::make($request->all(), $roles, $message);

        if ($valid->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => $valid->errors(),

            ], 500);
        };

        $bank_soal = MasterBankSoal::Where('master_bank_soal_id', $this->request->input('master_bank_soal_id'));

        if (count($bank_soal->get()) === 0) {
            return response()->json([
                'status' => 'false',
                'message' => 'Data tidak dapat ditemukan',

            ], 404);
        }

        try {

            $bank_soal->update([
                "jumlah_soal" => $this->request->input('jumlah_soal'),
                "durasi" => $this->request->input('durasi'),
                "descripsi" => $this->request->input('descripsi')
            ]);

            return response()->json([
                'status' => 'true',
                'message' => 'Successfuly',

            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'false',
                'message' => $e,

            ], 400);
        }
    }

    public function BankSoalDelete($id)
    {
        if ($id === null) {
            return response()->json([
                'status' => 'false',
                'message' => 'id tidak boleh kosong',

            ], 500);
        };

        $bank_soal = MasterBankSoal::find($id);

        if (count($bank_soal->get()) === 0) {
            return response()->json([
                'status' => 'false',
                'message' => 'Data tidak dapat ditemukan',

            ], 404);
        }

        try {

            $evaluasi = DB::table('evaluasi')->where('master_bank_soal_id', $id);
            $evaluasi->delete();

            $bank_soal->delete();
            return response()->json([
                'status' => 'true',
                'message' => 'Successfuly',

            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'false',
                'message' => $e,

            ], 400);
        }
    }
}
