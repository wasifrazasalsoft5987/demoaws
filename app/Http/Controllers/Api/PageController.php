<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\MainController;
use App\Http\Requests\Common\SignupRequest;
use App\Http\Resources\DefaultResource;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends MainController
{
    public function user_create(SignupRequest $request)
    {
        if ($request->image) {
            $data = uploadFile($request->image);
            $request->merge(['avatar' => $data['data']]);
        }

        $user = User::create($request->all());

        return $this->response->success(new DefaultResource($user));
    }

    public function user_fetch(Request $request)
    {
        $user = User::where('email', 'like', '%' . $request->email . '%')->first();

        return $this->response->success(new DefaultResource($user));
    }
}
