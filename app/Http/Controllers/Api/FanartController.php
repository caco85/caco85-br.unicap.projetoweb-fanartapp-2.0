<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fanart;
use App\Http\Requests\StoreFanartRequest;
use App\Http\Requests\UpdateFanartRequest;
use App\Http\Resources\FanartResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Evaluation;
use App\Models\User;
use App\Models\FanartCategory;
use Redirect;
use Illuminate\Support\Facades\Storage;
use Auth;

class FanartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $request->user();

        return FanartResource::collection(Fanart::where('id_users', $users->id)->orderBy('created_at', 'DESC')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFanartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFanartRequest $request)
    {
        $data = $request->validated();
        if (isset($data['image'])) {
            $relativePath  = $this->saveImage($data['image']);
            $data['image'] = $relativePath;
        }else{
            $data['image'] = '';
        }



        $fanart = new Fanart;
        $fanart->title =  $data['title'];
        $fanart->description = $data['description'];
        $fanart->id_users = $data['id_users'];
        $fanart->id_fanartCategories =$data['id_fanartCategories'];
        $fanart->image =  $data['image'];
        $fanart->save();

        return new FanartResource($fanart);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fanart  $fanart
     * @return \Illuminate\Http\Response
     */
    public function show(Fanart $fanart, Request $request)
    {
        $users = $request->user();
        if ($users->id !== $fanart->id_users) {
           return abort(403,'Usuário não Autorizado');
        }
        return new FanartResource($fanart);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFanartRequest  $request
     * @param  \App\Models\Fanart  $fanart
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFanartRequest $request, Fanart $fanart)
    {
        $data = $request->validated();

        //dd($data['image']);

         if (isset($data['image'])) {
             $relativePath = $this->saveImage($data['image']);
             $data['image'] = $relativePath;


             if ($fanart->image) {
                 $absolutePath = public_path($fanart->image);
                 File::delete($absolutePath);
             }
         }

         $fanart->update($data);

         return new FanartResource($fanart);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fanart  $fanart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fanart $fanart, Request $request)
    {
        $users = $request->user();

        if ($users->id !== $fanart->id_users) {
           return abort(403,'Usuário não Autorizado');
        }else{
            $fanart->delete();
            if ($fanart->image) {
                $absolutePath = public_path($fanart->image);
                File::delete($absolutePath);
            }

            return response('Deletado com sucesso!', 204);
        }
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

        $dir = 'images/fanarts';
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
