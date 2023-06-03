<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;

class ApiUser extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->has('user_id')) {
            $id = $request->input("user_id");

            $user = User::where('users.id', $id)->join('user_infos', 'users.id', "=", 'user_infos.user_id')->first();
            return $user;
        } else {
            return ['error' => true, "msg" => "An error occured", "type" => "INVALID_CREDENTIAL"];
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $id = $request->user_id;

            $user = User::findOrFail($id);
            if ($user) {
                $userInfo = UserInfo::where('user_id', $id)->firstOrFail();
                $user->update($request->except(['_token', 'roles']));
                $userInfo->update($request->except(['_token', 'roles', 'email']));

                $imageUpdated = false;
                $kycUpdated = false;
                if ($request->file('image') != null) {
                    $imageName = time() . '.' . $request->image->extension();
                    $path = $request->image->move(public_path('uploads'), $imageName);
                    $userInfo->image = $imageName;
                    $userInfo->update();
                    $imageUpdated = true;
                }

                if ($request->file('kyc') != null) {
                    $imageName = time() . '.' . $request->kyc->extension();
                    $path = $request->kyc->move(public_path('uploads'), $imageName);
                    $userInfo->kyc = $imageName;
                    $userInfo->update();
                    $kycUpdated = true;
                }

                return ["success" => true, "msg" => 'User data updated ', "image_status" => $imageUpdated, "kyc_status" => $kycUpdated];
            } else {
                return ['error' => true, "msg" => "user not found", "type" => "INVALID_CREDENTIAL"];
            }

        } catch (\Exception$e) {
            return ['msg' => "error uploading image", "error" => true, "type" => "NO_FILE_ATTACHMENT"];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user) {
                if ($request->email == $user->email) {
                    $userInfo = UserInfo::where('user_id', $id)->firstOrFail();
                    $user->update($request->except(['_token', 'roles']));
                    $userInfo->update($request->except(['_token', 'roles', 'email']));

                    if ($request->file('image') != null) {
                        $imageName = time() . '.' . $request->image->extension();

                        $path = $request->image->move(public_path('uploads'), $imageName);
                        $userInfo->image = $imageName;
                        $userInfo->update();
                        return ["success" => true, "msg" => 'User image updated '];
                    } else {
                        return ['msg' => "Invalid email address", "type" => "INVALID_CREDENTIAL", "error" => true];
                    }
                } else {
                    return ['msg' => "error uploading image", "type" => "NO_FILE_ATTACHMENT", "error" => true];
                }

            } else {
                return ['error' => true, "msg" => "user not found", "type" => "INVALID_CREDENTIAL"];
            }

        } catch (\Exception$e) {

            return ['msg' => "error uploading image", "type" => "NO_FILE_ATTACHMENT", "error" => $e];
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
