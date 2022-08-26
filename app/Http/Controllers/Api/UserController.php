<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $users = $request->user();
        // if ($users->id_usersTypes === "1") {
        //     return UserResource::collection(User::all());
        // }else{
        //     return UserResource::collection(User::where('id','==', $users->id)->get());
        // }


     //   return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {

        $data = $request->validated();

        var_dump($data['photo']);
        if (isset($data['photo'])) {
            $relativePath  = $this->saveImage($data['photo']);
            $data['photo'] = $relativePath;
        }else{
            $data['photo'] = '';
        }

        $user = new User;
        $user->name =  $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->photo =  $data['photo'];
        $user->instagram = $data['instagram'];
        $user->birthday= $data['birthday'];
        $user->id_usersTypes = $data['id_usersTypes'];
        $user->save();

        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user' => new UserResource($user),
            'token' => $token
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Request $request)
    {
        $users = $request->user();
        if ($users->id !== $user->id) {
          //  dd($users->id , $user->id);
           return abort(403,'Usuário não Autorizado');
        }
        return new UserResource($user, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

       //dd($data['photo']);

        if (isset($data['photo'])) {
            $relativePath = $this->saveImage($data['photo']);
            $data['photo'] = $relativePath;


            if ($user->photo) {
                $absolutePath = public_path($user->photo);
                File::delete($absolutePath);
            }
        }

        $user->update($data);

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,Request $request)
    {
        $user->delete();

        // If there is an old image, delete it
        if ($user->photo) {
            $absolutePath = public_path($user->photo);
            File::delete($absolutePath);
        }

        return response('Deletado com sucesso!', 204);
    }

    private function saveImage($image)
    {

        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {

            $image = substr($image, strpos($image, ',') + 1);

            $type = strtolower($type[1]);


            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('invalid image type');
            }
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }

        $dir = 'images/users';
        $file = Str::random() . '.' . $type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;
        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }
        file_put_contents($relativePath, $image);

        return $relativePath;
    }
}
