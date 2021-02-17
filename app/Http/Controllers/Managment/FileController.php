<?php

namespace App\Http\Controllers\Managment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\BookImage;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function __construct(){
        $this->middleware('authorization');
	}

	public function storeBookImage($request){
		if($request->hasFile('image')){
			// 2mb
			if($request->file('image')->getClientSize() / 1024 / 1024 < 2){
				if($request->file('image')->extension() == 'png' || $request->file('image')->extension() == 'jpg' || $request->file('image')->extension() == 'jpeg'){
					$image = New BookImage;
					$image->user_id = auth()->user()->id;
					$image->save();
                    $image->code = 'BBOOK'.$image->id;
					$image->update();
					$s3 = Storage::disk('s3');
					$s3File = 'bahai-dev/'.$image->code;
					$s3->put($s3File, file_get_contents($request->file('image')), 'public');
					return $image->id;
				}
				else{
					return redirect()->back()->withErrors(['file' => 'file extension is not correct']);				
				}
			}
			else{
				return redirect()->back()->withErrors(['file' => 'file is to big']);
			}
		}else{
			return redirect()->back()->withErrors(['file' => 'file input is null']);
		}
	}

}
