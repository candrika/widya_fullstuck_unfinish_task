<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterTutorController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function MasterTutor()
    {
        $lists = Tutor::Where('display')->get();
        return response()->json([
            'status' => 'true',
            'data' => $lists,
            'record' => count($lists)
        ], 200);
    }


    public function MasterTutorAdd(Request $request)
    {
        $roles = [
            'tutor_email' => 'required'
        ];

        $message = [
            'tutor_email.required' => 'Email tidak boleh kosong'
        ];

        $valid = Validator::make($request->all(), $roles, $message);

        if ($valid->fails()) {
            return response()->json(['status' => 'false', 'message' => $valid->errors()], 400);
        }

        Tutor::Create([
            'tutor_name' => $this->request->input('tutor_name'),
            'tutor_address' => $this->request->input('tutor_address'),
            'tutor_email' => $this->request->input('tutor_email'),
            'roles_id' => $this->request->input('roles_id')
        ]);

        // DB::table('users')->insert([
        //     'username' => $this->request->input('tutor_name'),
        //     'realname' => $this->request->input('tutor_address'),
        //     'roles_id' => $this->request->input('roles_id'),
        // ]);

        return response()->json(
            [
                'status' => 'true',
                'message' => 'Successfuly'
            ],
            200
        );
    }

    public function MasterTutorEdit(Request $request)
    {
        $list = Tutor::where('display')->where('tutor_id', $this->request->input('id'))->get();
        if (count($list) === 0) {
            return response()->json(
                [
                    'status' => 'true',
                    'message' => 'Data tidak dtemukan',
                    'record' => count($list)
                ],
                404
            );
        }

        return response()->json(
            [
                'status' => 'true',
                'data' => $list,
                'record' => count($list)
            ],
            200
        );
    }

    public function MasterTutorUpdate(Request $request)
    {
        $roles = [
            'tutor_email' => 'required'
        ];

        $message = [
            'tutor_email.required' => 'Email tidak boleh kosong'
        ];

        $valid = Validator::make($request->all(), $roles, $message);

        if ($valid->fails()) {
            return response()->json(['status' => 'false', 'message' => $valid->errors()], 400);
        }

        $tutor = Tutor::find($this->request->input('tutor_id'));

        $tutor_list = $tutor->get();

        if (count($tutor_list) === 0) {
            return response()->json(
                [
                    'status' => 'false',
                    'message' => 'Data tidak ditemukan atau tutor id salah'
                ],
                404
            );
        }

        $tutor->update([
            'tutor_name' => $this->request->input('tutor_name') ? $this->request->input('tutor_name') : $tutor_list[0]->tutor_name,
            'tutor_gender' => $this->request->input('tutor_gender') ? $this->request->input('tutor_gender') : $tutor_list[0]->tutor_gender,
            'tutor_address' => $this->request->input('tutor_address') ? $this->request->input('tutor_address') : $tutor_list[0]->tutor_address,
            'tutor_email' => $this->request->input('tutor_email') ? $this->request->input('tutor_email') : $tutor_list[0]->tutor_email,

        ]);

        return response()->json(
            [
                'status' => 'true',
                'message' => 'Successfuly'
            ],
            200
        );
    }

    public function MasterTutorDelete($id)
    {
        $tutor = Tutor::Where('tutor_id', $id);

        $tutor_list = $tutor->get();
        if (count($tutor_list) === 0) {
            return response()->json(
                [
                    'status' => 'false',
                    'message' => 'Data tidak ditemukan atau tutor id salah'
                ],
                404
            );
        }

        $tutor->update([
            'display' => 1,
        ]);

        return response()->json(
            [
                'status' => 'true',
                'message' => 'Successfuly'
            ],
            200
        );
    }
}
