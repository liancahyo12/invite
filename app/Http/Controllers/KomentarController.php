<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorekomentarRequest;
use App\Http\Requests\UpdatekomentarRequest;
use App\Models\komentar;
use App\Response\JsonResponse;

class KomentarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     private $json;

    public function __construct(JsonResponse $json)
    {
        $this->json = $json;
    }

    private function getInnerkomentar(string $id)
    {
        return komentar::select(['uuid', 'nama', 'kehadiran', 'komentar', 'created_at'])
            ->where('user_id', context()->user->id)
            ->where('parent_id', $id)
            ->orderBy('id')
            ->get()
            ->map(
                function ($val) {
                    $val->created_at = $val->created_at->diffForHumans();
                    $val->komentar = $this->getInnerkomentar($val->uuid);
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

        if ($valid->fails()) {
            return $this->json->error($valid->messages(), 400);
        }

        $valid->next = intval($valid->next);
        $valid->per = intval($valid->per);

        $data = komentar::select(['uuid', 'nama', 'hadir', 'komentar', 'created_at'])
            ->where('user_id', context()->user->id)
            ->whereNull('parent_id')
            ->orderBy('id', 'DESC');

        if ($valid->next >= 0 && $valid->per > 0) {
            $data = $data->limit($valid->per)->offset($valid->next);
        }

        $data = $data->get()
            ->map(
                function ($val) {
                    $val->created_at = $val->created_at->diffForHumans();
                    $val->komentar = $this->getInnerkomentar($val->uuid);
                    return $val;
                }
            );

        return $this->json->success($data, 200);
    }

    public function all(Request $request)
    {
        if ($request->get('id', '') !== env('JWT_KEY')) {
            return $this->json->error(['unauthorized'], 401);
        }

        $data = komentar::orderBy('id', 'DESC')
            ->get()
            ->map(
                function ($val) {
                    $val->created_at = $val->created_at->diffForHumans();
                    return $val;
                }
            );

        return $this->json->success($data, 200);
    }

    public function show_api(string $id)
    {
        $valid = Validator::make(
            [
                'id' => $id
            ],
            [
                'id' => ['required', 'str', 'trim', 'max:37']
            ]
        );

        if ($valid->fails()) {
            return $this->json->error($valid->messages(), 400);
        }

        $data = komentar::where('uuid', $valid->id)
            ->where('user_id', context()->user->id)
            ->limit(1)
            ->select(['nama', 'komentar', 'created_at'])
            ->first()
            ->fail();

        if (!$data) {
            return $this->json->error(['not found'], 404);
        }

        $data->created_at = $data->created_at->diffForHumans();

        return $this->json->success($data, 200);
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
        $valid = Validator::make(
            array_merge(
                $request->only(['id', 'nama', 'hadir', 'komentar']),
                [
                    'ip' => $request->ip(),
                    'user_agent' => $request->server('HTTP_USER_AGENT')
                ]
            ),
            [
                'id' => ['str', 'trim', 'max:37'],
                'nama' => ['required', 'str', 'max:50'],
                'hadir' => ['bool'],
                'komentar' => ['required', 'str', 'max:500'],
                'user_agent' => ['str', 'trim'],
                'ip' => ['str', 'trim', 'max:50']
            ]
        );

        if ($valid->fails()) {
            return $this->json->error($valid->messages(), 400);
        }

        $data = $valid->except(['id']);
        $data['parent_id'] = empty($valid->id) ? null : $valid->id;
        $data['uuid'] = Uuid::uuid4()->toString();
        $data['user_id'] = context()->user->id;

        $data = komentar::create($data)->except(['uuid', 'parent_id', 'id', 'user_id', 'user_agent', 'ip', 'updated_at']);
        $data->created_at = $data->created_at->diffForHumans();

        return $this->json->success($data, 201);
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
