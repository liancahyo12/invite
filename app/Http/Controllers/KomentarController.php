<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorekomentarRequest;
use App\Http\Requests\UpdatekomentarRequest;
use App\Models\komentar;
// use App\Response\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;

class KomentarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // private $json;

    // public function __construct(JsonResponse $json)
    // {
    //     $this->json = $json;
    // }

    private function getInnerkomentar(string $id)
    {
        return komentar::select(['uuid', 'nama', 'kehadiran', 'komentar', 'created_at'])
            ->where('pernikahan_id', 1)
            ->where('parent_id', $id)
            ->orderBy('id')
            ->get()
            ->map(
                function ($val) {
                    $val->created_at;
                    // $val->created_at = $val->created_at->diffForHumans();
                    $val->comment = $this->getInnerkomentar($val->uuid);
                    return $val;
                }
            );
    }
    
    public function index_api(Request $request)
    {
        $valid = $this->validate($request, [
            'next' => ['max:3'],
            'per' => ['max:3']
        ]);

        // if ($valid->fails()) {
        //     return response()
        //     ->json([$valid->messages()]);
        // }

        $request->next = intval($request->next);
        $request->per = intval($request->per);

        $data = komentar::select(['uuid', 'nama', 'kehadiran', 'komentar', 'created_at'])
            ->where('pernikahan_id', 1)
            ->whereNull('parent_id')
            ->orderBy('id', 'DESC');

        if ($request->next >= 0 && $request->per > 0) {
            $data = $data->limit($request->per)->offset($request->next);
        }

        $data = $data->get()
            ->map(
                function ($val) {
                    // $val->created_at = $val->created_at->diffForHumans();
                    $val->created_at;
                    // $val->komentar = $this->getInnerkomentar($val->uuid);
                    $val->comment = $this->getInnerkomentar($val->uuid);
                    return $val;
                }
            );

        return response()
            ->json(['code' => 200, 'data' => $data, 'error'=>[]]);
    }

    public function all(Request $request)
    {
        // if ($request->get('id', '') !== env('JWT_KEY')) {
        //     return $this->json->error(['unauthorized'], 401);
        // }

        $data = komentar::orderBy('id', 'DESC')
            ->get()
            ->map(
                function ($val) {
                    // $val->created_at = $val->created_at->diffForHumans();
                    $val->created_at;
                    return $val;
                }
            );

        return response()
            ->json(['code' => 200, 'data'=> $data, 'error'=>[]]);
    }

    public function destroy_api(string $id, Request $request)
    {
        if ($request->get('id', '') !== env('JWT_KEY')) {
            return $this->json->error(['unauthorized'], 401);
        }

        $data = komentar::where('uuid', $id)
            ->where('user_id', context()->user->id)
            ->limit(1)
            ->first()
            ->fail();

        if (!$data) {
            return $this->json->error(['not found'], 404);
        }

        $status = komentar::id($data->id)->delete();

        return $this->json->success([
            'status' => $status == 1
        ], 200);
    }

    public function create_api(Request $request)
    {
        $valid = $this->validate($request, [
            'id' => 'string',
            'nama' => 'required|string|max:50',
            'kehadiran' => 'bool',
            'komentar' => 'required|string|max:500',
            'user_agent' => 'string',
            'ip' => 'string|max:50'
        ]);

        // if ($valid->fails()) {
        //     return $this->json->error($valid->messages(), 400);
        // }

        // $data = $valid->except(['id']);
        $data['parent_id'] = empty($request->id) ? null : $request->id;
        // $data['uuid'] = Uuid::uuid4()->toString();
        $data['nama'] = $request->nama;
        $data['komentar'] = $request->komentar;
        $data['kehadiran'] = $request->kehadiran;
        $data['pernikahan_id'] = 1;
        $data['uuid'] = Str::uuid();

        $data = komentar::create($data);
        // $data->created_at = $data->created_at->diffForHumans();
        $data->created_at = $data->created_at;
        
        return response()
            ->json(['code' => 201, 'data'=> $data, 'error'=>[]]);
        
        
    }

    public function show_api($id)
    {
        // $valid = $this->validate($request, [
        //     'id' => 'required|string|trim|max:37',
        // ]);

        // if ($valid->fails()) {
        //     return $this->json->error($valid->messages(), 400);
        // }

        $data = komentar::where('uuid', $id)
            ->where('pernikahan_id', 1)
            ->limit(1)
            ->select(['nama', 'komentar', 'created_at'])
            ->first();

        if (!$data) {
            return response()
            ->json(['code' => 40, 'error'=>['not found']]);
        }

        // $data->created_at = $data->created_at->diffForHumans();
        $data->created_at = $data->created_at;

        return response()
            ->json(['code' => 200, 'data'=> $data, 'error'=>[]]);
    }

    public function index()
    {
        return view('boilerplate::komentar.index');
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
    public function store(StorekomentarRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(komentar $komentar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(komentar $komentar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatekomentarRequest $request, komentar $komentar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(komentar $komentar)
    {
        //
    }
}
