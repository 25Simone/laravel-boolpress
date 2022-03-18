<?php

namespace App\Http\Controllers\Admin;

use App\InfoUser;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        return view('admin.users.show', compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        return view("admin.users.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {
        // Save the request data in a variable and validate it
        $data = $request->validate([
            "name" => "required|min:2",
            "email" => "required|email" ,
            "phone" => "nullable|numeric",
            "address" => "nullable",
            "avatar" => "nullable|url"
        ]);

        // Update the user
        $user->update($data);

        // If infoUser doesn't exists
        if (!$user->infoUser) {
          // Instance a new line
          $infoUser = new InfoUser();
          // Fill the line with data
          $infoUser->fill($data);
          // Save the infoUser data
          $user->infoUser()->save($infoUser);
        } else {
            $user->infoUser->fill($data);
            $user->infoUser->save();
          }

        return redirect()->route("admin.users.show", $user->id);
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
