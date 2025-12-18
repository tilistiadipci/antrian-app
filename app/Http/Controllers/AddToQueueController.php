<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Setting;
use App\Repositories\AddToQueueRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class AddToQueueController extends Controller
{
    protected $add_to_queues;

    public function __construct(AddToQueueRepository $add_to_queues)
    {
        $this->add_to_queues = $add_to_queues;

        
    }

    public function index(Request $request)
    {
        $settings = Setting::first();

        App::setLocale($settings->language->code);

        return view('addtoqueue.index', [
            'settings' => $settings,
            'departments' => $this->add_to_queues->getDepartments(),
            'sales' => \App\Sales::all(),
            'sales_assigned' => \App\Sales::where('is_sales_assigned', 1)->first()
        ]);
    }

    public function index1($id)
    {
        // taambahkan id template disini
        if (!in_array($id, [2])) {
            abort(404);
        }

        $settings = Setting::first();

        App::setLocale($settings->language->code);

        $view = 'addtoqueue.index'.$id;
        return view($view, [
            'settings' => $settings,
            'departments' => $this->add_to_queues->getDepartments(),
            'sales' => \App\Sales::all(),
            'sales_assigned' => \App\Sales::where('is_sales_assigned', 1)->first()
        ]);
    }

    public function guestRegister(Request $request) {
        try {
            $guest = new \App\Guest;
            $guest->name = $request->name;
            $guest->no_hp = $request->no_hp;
            $guest->dinas = $request->dinas;
            $guest->sales_id = $request->sales;

            $guest->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'log' => $guest
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan. Silahkan coba lagi',
                'log' => $e
            ]);
        }
    }

    public function postDept(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $department = Department::findOrFail($request->department);

            $last_token = $this->add_to_queues->getLastToken($department);

            if($last_token) {
                $queue = $department->queues()->create([
                    'number' => ((int)$last_token->number)+1,
                    'called' => 0,
                    'id_member' => 0,
                ]);
            } else {
                $queue = $department->queues()->create([
                    'number' => $department->start,
                    'called' => 0,
                    'id_member' => 0,
                ]);
            }

            $total = $this->add_to_queues->getCustomersWaiting($department);
            $number = ($department->letter!='') ? $department->letter.'-'.$queue->number : $queue->number;
            $settings = Setting::first();

            event(new \App\Events\TokenIssued());

            // if ($settings->printer_type == 'LAN') {
            //     $connector = new NetworkPrintConnector($settings->ip_address, 9100);
            // } else {
            //     $connector = new WindowsPrintConnector($settings->port_usb);
            // }
            
            // $printer = new Printer($connector);

            // App::setLocale($settings->language->code);
            
            // $logoPath = app_path().'/../assets/images/'.$settings->logo;

            // // dd($logoPath);
            // $tempLogoPath = $this->resizeImage($logoPath);

            // $logo = EscposImage::load($tempLogoPath, false);

            // // Print logo
            // $printer->setJustification(Printer::JUSTIFY_CENTER);
            // $printer->bitImage($logo);
            // $printer->feed();
            
            // unlink($tempLogoPath);

            // // dd('asdfsa');
            // // Print company name
            // $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            // $printer->setTextSize(2, 2);
            // $printer->setEmphasis(true);
            // $printer->text($settings->name . "\n\n");
            // $printer->selectPrintMode();

            // // Print department name
            // $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            // $printer->setTextSize(2, 2);
            // $printer->text($department->name . "\n\n");
            // $printer->selectPrintMode();

            // // Print queue number
            // $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            // $printer->text("No Antrian Anda\n\n");
            // $printer->selectPrintMode(Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
            // $printer->setTextSize(4, 4);
            // $printer->setEmphasis(true);
            // $printer->text($number . "\n\n");
            // $printer->selectPrintMode();

            // // Print additional information
            // $printer->text("Harap tunggu giliran Anda\n\n");
            // $printer->text("Menunggu: " . $total . " orang\n\n\n");
            // $printer->selectPrintMode();

            // $carbonDate = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now())
            //                 ->setTimezone('Asia/Jakarta');

            // $date = $carbonDate->format('d-m-Y');
            // $time = $carbonDate->format('h:i:s A');

            // // Menghitung panjang teks untuk penyesuaian posisi
            // $totalLength = strlen($date) + strlen($time);

            // // Hitung jumlah spasi untuk penyesuaian posisi
            // $spacesCount = 45 - $totalLength;

            // // Set left justification untuk tanggal
            // $printer->setJustification(Printer::JUSTIFY_LEFT);
            // $printer->text("  ".$date);

            // // Tambahkan spasi di antara tanggal dan waktu
            // for ($i = 0; $i < $spacesCount; $i++) {
            //     $printer->text(" ");
            // }

            // // Set right justification untuk waktu
            // $printer->setJustification(Printer::JUSTIFY_RIGHT);
            // $printer->text($time . "\n");

            // // Kembali ke penjustifikasi default (center) jika diperlukan
            // $printer->setJustification(Printer::JUSTIFY_CENTER);

            // // Feed and cut
            // $printer->feed();
            // $printer->cut();
            // $printer->close();

            flash()->success('Token Added');
            DB::commit();
            return response()->json(['success' => true, 'antrian' => $number], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function resizeImage($logoPath) {
        $logo = imagecreatefrompng($logoPath);
    
        $newWidth = 200;
        $oldWidth = imagesx($logo);
        $oldHeight = imagesy($logo);
        $newHeight = floor($oldHeight * ($newWidth / $oldWidth));
    
        $newLogo = imagecreatetruecolor($newWidth, $newHeight);
    
        // Set background to white
        $white = imagecolorallocate($newLogo, 255, 255, 255);
        imagefill($newLogo, 0, 0, $white);
    
        imagecopyresampled($newLogo, $logo, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);
    
        // Change bright colors to black except white and yellow to white
        for ($x = 0; $x < $newWidth; $x++) {
            for ($y = 0; $y < $newHeight; $y++) {
                $rgb = imagecolorat($newLogo, $x, $y);
                $colors = imagecolorsforindex($newLogo, $rgb);
                if ($colors['red'] > 200 && $colors['green'] > 200 && $colors['blue'] > 200) {
                    // Keep white as is
                    continue;
                } elseif ($colors['red'] > 200 && $colors['green'] > 200 && $colors['blue'] < 100) {
                    // Set yellow to white
                    imagesetpixel($newLogo, $x, $y, $white);
                } elseif ($colors['red'] > 200 || $colors['green'] > 200 || $colors['blue'] > 200) {
                    // Set bright colors to black
                    $black = imagecolorallocate($newLogo, 0, 0, 0);
                    imagesetpixel($newLogo, $x, $y, $black);
                }
            }
        }
    
        $tempLogoPath = public_path('templogo.png');
        imagepng($newLogo, $tempLogoPath);
    
        imagedestroy($logo);
        imagedestroy($newLogo);
    
        return $tempLogoPath;
    }
}