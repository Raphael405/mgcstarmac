<?php

namespace App\Http\Controllers;

use App\Models\services;
use App\Models\services_images;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function edit(Request $request){
        $this->validate($request, [
            'price' => 'required|max:255',
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'images.*' => 'image',
        ]); 
        $service = services::find($request->id);
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();
        $filename="";
        $x= 0;
        $time = date('m-d-Y-H-i-s');
        if($files=$request->file('images')){
            foreach ($files as $key=>$file) {
                $filename = $time. $x .'.png';
                $file->move('uploads/services',$filename);
                $filename = 'uploads/services/'.$filename;
                services_images::create([
                    'services_id' =>$request->id,
                    'location' => $filename,
                    'description' => "Image"
                ]);
                $x+=1;
            }
        }
        return redirect()->route('services');
    }
    public function add(Request $request){
        $this->validate($request, [
            'price' => 'required|max:255',
            'name' => 'required|max:255',
            'services_types_id' => 'required|',
            'description' => 'required|max:255',
            'images.*' => 'image',
        ]); 
        services::create([
            'name' => $request->name,
            'services_types_id' => $request->services_types_id,
            'description' => $request->description,
            'price' => $request->price,
            'location' => $request->location,
        ]); 
        $id = services::latest()->first();
        $filename="";
        $x= 0;
        $time = date('m-d-Y-H-i-s');
        if($files=$request->file('images')){
            foreach ($files as $key=>$file) {
                $filename = $time. $x .'.png';
                $file->move('uploads/services',$filename);
                $filename = 'uploads/services/'.$filename;
                services_images::create([
                    'services_id' =>$id->id,
                    'location' => $filename,
                    'description' => "Image"
                ]);
                $x+=1;
            }
        }
        return redirect()->route('services');
    }
}
