<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SettingsRepository;
use App\Models\Language;
use App\Models\Setting;
use App\Models\Call;
use App\Models\Queue;

class SettingsController extends Controller
{
    protected $settings;

    public function __construct(SettingsRepository $settings)
    {
        $this->settings = $settings;
    }

    public function index(Request $request)
    {
        return view('user.settings.index', [
            'settings' => $this->settings->getSettings(),
            'languages' => $this->settings->getLanguages(),
            'c_locale' => \App::getLocale(),
        ]);


    }

    public function update(Request $request)
    {
        $user = $request->user();

        if($request->password=='') {
            $this->validate($request, [
                'username' => 'bail|required|min:6|unique:users,username,'.$user->id,
                'name' => 'bail|required',
                'email' => 'bail|required|email',
            ]);

            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();
        } else {
            $this->validate($request, [
                'username' => 'bail|required|min:6|unique:users,username,'.$user->id,
                'name' => 'bail|required',
                'email' => 'bail|required|email',
                'password' => 'bail|required|min:6|confirmed',
            ]);

            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
        }

        flash()->success('Account updated');
        return redirect()->route('settings');
    }

    public function companyUpdate(Request $request)
    {
        $this->authorize('access', Setting::class);

        $this->validate($request, [
            'name' => 'bail|required',
            'email' => 'bail|email',
        ]);

        $settings = $this->settings->getSettings();
        $settings->name = $request->name;
        $settings->address = $request->address;
        $settings->email = $request->email;
        $settings->phone = $request->phone;
        $settings->location = $request->location;

        if(($_FILES['filelogo']['name'] != '')){
           $settings->logo = $_FILES['filelogo']['name'];
         }else{
          $settings->logo = $request->logo;
         
         }
        if(isset($_POST['but_upload_logo'])){
         $maxsizelogo = 524288000; // 5MB

        //logo
         $name = $_FILES['filelogo']['name'];
         $target_dir_logo = "assets/images/";
         $target_file_logo = $target_dir_logo . $_FILES["filelogo"]["name"];

         // Select file type
         $logoFileType = strtolower(pathinfo($target_file_logo,PATHINFO_EXTENSION));

         // Valid file extensions
         $extensions_arr_logo = array("png");

         // Check extension
         if( in_array($logoFileType,$extensions_arr_logo) ){
         
         // Check file size
         if(($_FILES['filelogo']['size'] >= $maxsizelogo) || ($_FILES["filelogo"]["size"] == 0)) {
         echo "File too large. File must be less than 5MB.";
         }else{
         // Upload
        if(move_uploaded_file($_FILES['filelogo']['tmp_name'],$target_file_logo)){
         
         }
         }


         }else{
         echo "Invalid file extension.";
         }
         } 


        $settings->save();

        flash()->success('Company updated');
        return redirect()->route('settings');

    }

    public function gambarUpdate(Request $request)
    {
        $this->authorize('access', Setting::class);

        $this->validate($request, [
            'background' => 'bail|required',
        ]);

        $settings = $this->settings->getSettings();

        if(($_FILES['filebackground']['name'] != '')){
           $settings->background = $_FILES['filebackground']['name'];
         }else{
          $settings->background = $request->background;
         
         }


         if(($_FILES['filebanner']['name'] != '')){
           $settings->banner = $_FILES['filebanner']['name'];
         }else{
          $settings->banner = $request->banner;
         
         }

        

        if(isset($_POST['but_upload_gambar'])){
         $maxsizebackground = 524288000; // 5MB

        //logo
         $name = $_FILES['filebackground']['name'];
         $target_dir_background = "assets/images/";
         $target_file_background = $target_dir_background . $_FILES["filebackground"]["name"];

         // Select file type
         $backgroundFileType = strtolower(pathinfo($target_file_background,PATHINFO_EXTENSION));

         // Valid file extensions
         $extensions_arr_background = array("jpg");

         // Check extension
         if( in_array($backgroundFileType,$extensions_arr_background) ){
         
         // Check file size
         if(($_FILES['filebackground']['size'] >= $maxsizebackground) || ($_FILES["filebackground"]["size"] == 0)) {
         echo "File too large. File must be less than 5MB.";
         }else{
         // Upload
        if(move_uploaded_file($_FILES['filebackground']['tmp_name'],$target_file_background)){
         
         }
         }


         }else{
         echo "Invalid file extension.";
         }
         } 

        if(isset($_POST['but_upload_gambar'])){
         $maxsizebanner = 524288000; // 5MB

        //logo
         $name = $_FILES['filebanner']['name'];
         $target_dir_banner = "assets/images/";
         $target_file_banner = $target_dir_banner . $_FILES["filebanner"]["name"];

         // Select file type
         $bannerFileType = strtolower(pathinfo($target_file_banner,PATHINFO_EXTENSION));

         // Valid file extensions
         $extensions_arr_banner = array("jpg", "png");

         // Check extension
         if( in_array($bannerFileType,$extensions_arr_banner) ){
         
         // Check file size
         if(($_FILES['filebackground']['size'] >= $maxsizebanner) || ($_FILES["filebanner"]["size"] == 0)) {
         echo "File too large. File must be less than 5MB.";
         }else{
         // Upload
        if(move_uploaded_file($_FILES['filebanner']['tmp_name'],$target_file_banner)){
         
         }
         }


         }else{
         echo "Invalid file extension.";
         }
         }     

        $settings->save();

        flash()->success('Company updated');
        return redirect()->route('settings');

    }

    public function overmissedUpdate(Request $request)
    {
        $this->authorize('access', Setting::class);

        $this->validate($request, [
            'over_time' => 'bail|required|numeric',
            'missed_time' => 'bail|required|numeric',
        ]);

        $settings = $this->settings->getSettings();
        $settings->over_time = $request->over_time;
        $settings->missed_time = $request->missed_time;
        $settings->jam_buka = $request->jam_buka;
        $settings->jam_tutup = $request->jam_tutup;
        $settings->jml_antrian_hari = $request->jml_antrian_hari;
        $settings->save();

        flash()->success('Settings updated');
        return redirect()->route('settings');
    }

    public function videoUpdate(Request $request)
    {
        $this->authorize('access', Setting::class);

        $this->validate($request, [
            'video' => 'bail|required',
        ]);

        $settings = $this->settings->getSettings();

        if(($_FILES['file1']['name'] != '')){
           $settings->video = $_FILES['file1']['name'];
         }else{
          $settings->video = $request->video;
         
         }

         if(($_FILES['file2']['name'] != '')){
           $settings->video1 = $_FILES['file2']['name'];
         }else{
          $settings->video1 = $request->video1;
         
         }

         if(($_FILES['file3']['name'] != '')){
           $settings->video2 = $_FILES['file3']['name'];
         }else{
          $settings->video2 = $request->video2;
         
         }

         if(($_FILES['file4']['name'] != '')){
           $settings->video3 = $_FILES['file4']['name'];
         }else{
          $settings->video3 = $request->video3;
         
         }

         if(($_FILES['file5']['name'] != '')){
           $settings->video4 = $_FILES['file5']['name'];
         }else{
          $settings->video4 = $request->video4;
         
         }

        if(isset($_POST['but_upload'])){
         $maxsize = 524288000; // 5MB
        //video
         $name = $_FILES['file1']['name'];
         $target_dir = "assets/video/";
         $target_file = $target_dir . $_FILES["file1"]["name"];

         // Select file type
         $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

         // Valid file extensions
         $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

         // Check extension
         if( in_array($videoFileType,$extensions_arr) ){
         
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
         $maxsize = 524288000; // 5MB
        //video
         $name = $_FILES['file2']['name'];
         $target_dir = "assets/video/";
         $target_file = $target_dir . $_FILES["file2"]["name"];

         // Select file type
         $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

         // Valid file extensions
         $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

         // Check extension
         if( in_array($videoFileType,$extensions_arr) ){
         
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
         $maxsize = 524288000; // 5MB
        //video
         $name = $_FILES['file3']['name'];
         $target_dir = "assets/video/";
         $target_file = $target_dir . $_FILES["file3"]["name"];

         // Select file type
         $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

         // Valid file extensions
         $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

         // Check extension
         if( in_array($videoFileType,$extensions_arr) ){
         
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
         $maxsize = 524288000; // 5MB
        //video
         $name = $_FILES['file4']['name'];
         $target_dir = "assets/video/";
         $target_file = $target_dir . $_FILES["file4"]["name"];

         // Select file type
         $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

         // Valid file extensions
         $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

         // Check extension
         if( in_array($videoFileType,$extensions_arr) ){
         
         // Check file size
         if(($_FILES['file4']['size'] >= $maxsize) || ($_FILES["file4"]["size"] == 0)) {
         echo "File too large. File must be less than 5MB.";
         }else{
         // Upload
         if(move_uploaded_file($_FILES['file4']['tmp_name'],$target_file)){
         
         }
         }

         }else{
         echo "Invalid file extension.";
         }
         
         }

          if(isset($_POST['but_upload'])){
         $maxsize = 524288000; // 5MB
        //video
         $name = $_FILES['file5']['name'];
         $target_dir = "assets/video/";
         $target_file = $target_dir . $_FILES["file5"]["name"];

         // Select file type
         $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

         // Valid file extensions
         $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

         // Check extension
         if( in_array($videoFileType,$extensions_arr) ){
         
         // Check file size
         if(($_FILES['file5']['size'] >= $maxsize) || ($_FILES["file5"]["size"] == 0)) {
         echo "File too large. File must be less than 5MB.";
         }else{
         // Upload
         if(move_uploaded_file($_FILES['file5']['tmp_name'],$target_file)){
         
         }
         }

         }else{
         echo "Invalid file extension.";
         }
         
         }

        $settings->save();

        flash()->success('Settings updated');
        return redirect()->route('settings');
    }

    public function localeUpdate(Request $request)
    {
        $this->authorize('access', Setting::class);

        $this->validate($request, [
            'language' => 'bail|required|exists:languages,id',
        ]);

        $settings = $this->settings->getSettings();
        $settings->language_id = $request->language;
        $settings->save();

        $locale = Language::find($request->language);
        $request->session()->put('locale', $locale->code);

        flash()->success('Language updated');
        return redirect()->route('settings');
    }

    public function hapusVideo(Request $request)
    {

        $this->authorize('access', Setting::class);

        $this->validate($request, [
            'video' => 'bail|required',
        ]);
        $settings = $this->settings->getSettings();
        $settings->video = $request->video;
        $target_hapusvideo = "assets/video/";
        $target_hapusvideofile = $target_hapusvideo . $request->videohap;
        unlink($target_hapusvideofile);
        $settings->save();

        flash()->success('Video dihapus');
        return redirect()->route('settings');
    }

    public function hapusVideo1(Request $request)
    {

        $this->authorize('access', Setting::class);

        $this->validate($request, [
            'video1' => 'bail|required',
        ]);
        $settings = $this->settings->getSettings();
        $settings->video1 = $request->video1;
        $target_hapusvideo1 = "assets/video/";
        $target_hapusvideo1file = $target_hapusvideo1 . $request->video1hap;
        unlink($target_hapusvideo1file);
        $settings->save();

        flash()->success('Video dihapus');
        return redirect()->route('settings');
    }

    public function hapusVideo2(Request $request)
    {

        $this->authorize('access', Setting::class);

        $this->validate($request, [
            'video2' => 'bail|required',
        ]);
        $settings = $this->settings->getSettings();
        $settings->video2 = $request->video2;
        $target_hapusvideo2 = "assets/video/";
        $target_hapusvideo2file = $target_hapusvideo2 . $request->video2hap;
        unlink($target_hapusvideo2file);
        $settings->save();

        flash()->success('Video dihapus');
        return redirect()->route('settings');
    }

    public function hapusVideo3(Request $request)
    {

        $this->authorize('access', Setting::class);

        $this->validate($request, [
            'video3' => 'bail|required',
        ]);
        $settings = $this->settings->getSettings();
        $settings->video3 = $request->video3;
        $target_hapusvideo3 = "assets/video/";
        $target_hapusvideo3file = $target_hapusvideo3 . $request->video3hap;
        unlink($target_hapusvideo3file);
        $settings->save();

        flash()->success('Video dihapus');
        return redirect()->route('settings');
    }

    public function hapusVideo4(Request $request)
    {

        $this->authorize('access', Setting::class);

        $this->validate($request, [
            'video4' => 'bail|required',
        ]);
        $settings = $this->settings->getSettings();
        $settings->video4 = $request->video4;
        $target_hapusvideo4 = "assets/video/";
        $target_hapusvideo4file = $target_hapusvideo4 . $request->video4hap;
        unlink($target_hapusvideo4file);
        $settings->save();

        flash()->success('Video dihapus');
        return redirect()->route('settings');
    }

     public function hapusBackground(Request $request)
    {

        $this->authorize('access', Setting::class);

        $this->validate($request, [
            'background' => 'bail|required',
        ]);
        $settings = $this->settings->getSettings();
        $settings->background = $request->background;
        $target_hapusbackground = "assets/images/";
        $target_hapusbackgroundfile = $target_hapusbackground . $request->backgroundhap;
        unlink($target_hapusbackgroundfile);
        $settings->save();

        

        flash()->success('Background dihapus');
        return redirect()->route('settings');
    }

     public function hapusBanner(Request $request)
    {

        $this->authorize('access', Setting::class);

        $this->validate($request, [
            'banner' => 'required',
        ]);
        $settings = $this->settings->getSettings();
        $settings->banner = $request->banner;
        $target_hapusbanner = "assets/images/";
        $target_hapusbannerfile = $target_hapusbanner . $request->bannerhap;
        unlink($target_hapusbannerfile);
        $settings->save();

        flash()->success('Banner dihapus');
        return redirect()->route('settings');
    }

    public function resetData(Request $request)
    {


        $call = Call::select()->orderBy('created_at', 'desc');  
        $call->delete();


        $queue = Queue::select()->orderBy('created_at', 'desc');  
        $queue->delete();          

        flash()->success('Berhasil Reset Data');
        return redirect()->route('settings');
    }

    public function printerUpdate(Request $request)
    {
        $this->authorize('access', Setting::class);

        $settings = $this->settings->getSettings();
        $settings->printer_type = $request->printer_type;
        $settings->ip_address = $request->ip_address;
        $settings->port_usb = $request->port_usb;
        
        $settings->save();

        flash()->success('Printer updated');
        return redirect()->route('settings');
    }
}
