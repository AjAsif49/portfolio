<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HeroController extends Controller
{
    public function Hero(){
        $heros = Hero::all();
        return view('admin.hero.index', compact('heros'));
    }

    public function AddHero(){
        return view('admin.hero.create');
    }

    public function StoreHero(Request $request){
        $image = $request->file('image');

        $name_generate   = hexdec(uniqid());
        $img_ext         = strtolower($image->getClientOriginalExtension());
        $img_name        = $name_generate.'.'.$img_ext;
        $upload_location = 'image/hero/';
        $last_img        = $upload_location.$img_name;
        $image -> move($upload_location, $img_name);

        Hero::insert([
            'name'       => $request->name,
            'role'       => $request->role,
            'image'      => $last_img,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->route('home.hero')->with('success','Hero Inserted Successfully');
    }

    public function EditHero($id){
        $heros = Hero::find($id);
        return view('admin.hero.edit', compact('heros'));
    }

    public function UpdateHero(Request $request, $id){
        $old_image = $request->old_image;

        $image = $request->file('image');

        if($image){
        $name_generate   = hexdec(uniqid());
        $img_ext         = strtolower($image->getClientOriginalExtension());
        $img_name        = $name_generate.'.'.$img_ext;
        $upload_location = 'image/hero/';
        $last_img        = $upload_location.$img_name;
        $image -> move($upload_location, $img_name);
        unlink($old_image);

        Hero::find($id)->update([
            'name'       => $request->name,
            'role'       => $request->role,
            'image'      => $last_img,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->route('home.hero')->with('success','Hero Updated Successfully');
    }else{
        Hero::find($id)->update([
            'name'       => $request->name,
            'role'       => $request->role,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->route('home.hero')->with('success','Hero Updated Successfully');
    }
    }

    public function DeleteHero($id){
        $hero = Hero::find($id);
        $old_image = $hero->image;
        unlink($old_image);
        
        Hero::find($id)->delete();
        return Redirect()->back()->with('success','Slider Deleted Successfully');

    }
    
}
