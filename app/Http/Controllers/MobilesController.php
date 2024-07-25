<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MobilesRepository;
use App\Models\Language;
use App\Models\Mobile;


class MobilesController extends Controller
{
    protected $mobiles;

    public function __construct(MobilesRepository $mobiles)
    {
        $this->mobiles = $mobiles;
    }

    public function index(Request $request)
    {
        return view('user.mobiles.index', [
            'mobiles' => $this->mobiles->getMobiles(),
            'languages' => $this->mobiles->getLanguages(),

        ]);


    }

    public function update(Request $request)
    {
        
        $this->validate($request, [
                'slider_jdl1' => 'bail|required',
                'slider_jdl2' => 'bail|required',
                'slider_jdl3' => 'bail|required',
                'sdb2_jdl' => 'bail|required',
                'sdb2_des' => 'bail|required',
                
            ]);
            $mobiles = $this->mobiles->getMobiles();
            $mobiles->slider_jdl1 = $request->slider_jdl1;
            $mobiles->slider_jdl2 = $request->slider_jdl2;
            $mobiles->slider_jdl3 = $request->slider_jdl3;
            $mobiles->slider_des1 = $request->slider_des1;
            $mobiles->slider_des2 = $request->slider_des2;
            $mobiles->slider_des3 = $request->slider_des3;
            $mobiles->sdb2_jdl = $request->sdb2_jdl;
            $mobiles->sdb2_des = $request->sdb2_des;
            $mobiles->banner1 = $request->banner1;
            $mobiles->banner2 = $request->banner2;

            if(($_FILES['file1']['name'] != '')){
                $mobiles->sliderbg1 = $_FILES['file1']['name'];
             }else{
              $mobiles->sliderbg1 = $request->sliderbg1;
             
             }

            if(($_FILES['file2']['name'] != '')){
                $mobiles->sliderbg2 = $_FILES['file2']['name'];
             }else{
              $mobiles->sliderbg2 = $request->sliderbg2;
             
             } 

            if(($_FILES['file3']['name'] != '')){
                $mobiles->sliderbg3 = $_FILES['file3']['name'];
             }else{
              $mobiles->sliderbg3 = $request->sliderbg3;
             
             }  

            if(($_FILES['filebanner1']['name'] != '')){
                $mobiles->banner1 = $_FILES['filebanner1']['name'];
             }else{
              $mobiles->banner1 = $request->banner1;
             
            }

            if(($_FILES['filebanner2']['name'] != '')){
                $mobiles->banner2 = $_FILES['filebanner2']['name'];
             }else{
              $mobiles->banner2 = $request->banner2;
             
            }


            if(isset($_POST['but_upload'])){
                 $maxsize = 5242880; // 5MB
                //video
                 $name = $_FILES['file1']['name'];
                 $target_dir = "assets/images/bg/";
                 $target_file = $target_dir . $_FILES["file1"]["name"];

                 // Select file type
                 $sliderbg1FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                 // Valid file extensions
                 $extensions_arr = array("jpg","png","gif");

                 // Check extension
                 if( in_array($sliderbg1FileType,$extensions_arr) ){
                 
                 // Check file size
                 if(($_FILES['file1']['size'] >= $maxsize) || ($_FILES["file1"]["size"] == 0)) {
                 echo "File too large. File must be less than 5MB.";
                 }else{
                 // Upload
                 if(move_uploaded_file($_FILES['file1']['tmp_name'],$target_file)){
                 
                 }
                 }

                 }else{
                 echo "Invalid file extension.";
                 }
         
            }

            if(isset($_POST['but_upload'])){
                 $maxsize = 5242880; // 5MB
                //video
                 $name = $_FILES['file2']['name'];
                 $target_dir = "assets/images/bg/";
                 $target_file = $target_dir . $_FILES["file2"]["name"];

                 // Select file type
                 $sliderbg2FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                 // Valid file extensions
                 $extensions_arr = array("jpg","png","gif");

                 // Check extension
                 if( in_array($sliderbg2FileType,$extensions_arr) ){
                 
                 // Check file size
                 if(($_FILES['file2']['size'] >= $maxsize) || ($_FILES["file2"]["size"] == 0)) {
                 echo "File too large. File must be less than 5MB.";
                 }else{
                 // Upload
                 if(move_uploaded_file($_FILES['file2']['tmp_name'],$target_file)){
                 
                 }
                 }

                 }else{
                 echo "Invalid file extension.";
                 }
         
            } 

            if(isset($_POST['but_upload'])){
                 $maxsize = 5242880; // 5MB
                //video
                 $name = $_FILES['file3']['name'];
                 $target_dir = "assets/images/bg/";
                 $target_file = $target_dir . $_FILES["file3"]["name"];

                 // Select file type
                 $sliderbg3FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                 // Valid file extensions
                 $extensions_arr = array("jpg","png","gif");

                 // Check extension
                 if( in_array($sliderbg3FileType,$extensions_arr) ){
                 
                 // Check file size
                 if(($_FILES['file3']['size'] >= $maxsize) || ($_FILES["file3"]["size"] == 0)) {
                 echo "File too large. File must be less than 5MB.";
                 }else{
                 // Upload
                 if(move_uploaded_file($_FILES['file3']['tmp_name'],$target_file)){
                 
                 }
                 }

                 }else{
                 echo "Invalid file extension.";
                 }
         
            }

            if(isset($_POST['but_upload'])){
                 $maxsize = 524288; // 5MB
                //video
                 $name = $_FILES['filebanner1']['name'];
                 $target_dir = "assets/images/banner/";
                 $target_file = $target_dir . $_FILES["filebanner1"]["name"];

                 // Select file type
                 $filebanner1FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                 // Valid file extensions
                 $extensions_arr = array("jpg","png","gif");

                 // Check extension
                 if( in_array($filebanner1FileType,$extensions_arr) ){
                 
                 // Check file size
                 if(($_FILES['filebanner1']['size'] >= $maxsize) || ($_FILES["filebanner1"]["size"] == 0)) {
                 echo "File too large. File must be less than 5MB.";
                 }else{
                 // Upload
                 if(move_uploaded_file($_FILES['filebanner1']['tmp_name'],$target_file)){
                 
                 }
                 }

                 }else{
                 echo "Invalid file extension.";
                 }
         
            }

            if(isset($_POST['but_upload'])){
                 $maxsize = 524288; // 5MB
                //video
                 $name = $_FILES['filebanner2']['name'];
                 $target_dir = "assets/images/banner/";
                 $target_file = $target_dir . $_FILES["filebanner2"]["name"];

                 // Select file type
                 $filebanner2FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                 // Valid file extensions
                 $extensions_arr = array("jpg","png","gif");

                 // Check extension
                 if( in_array($filebanner2FileType,$extensions_arr) ){
                 
                 // Check file size
                 if(($_FILES['filebanner2']['size'] >= $maxsize) || ($_FILES["filebanner2"]["size"] == 0)) {
                 echo "File too large. File must be less than 5MB.";
                 }else{
                 // Upload
                 if(move_uploaded_file($_FILES['filebanner2']['tmp_name'],$target_file)){
                 
                 }
                 }

                 }else{
                 echo "Invalid file extension.";
                 }
         
            }

            $mobiles->save();
        
        flash()->success('Account updated');
        return redirect()->route('mobiles');
    }

}
