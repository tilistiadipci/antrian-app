<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TemplateRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\CounterRepository;
use App\Template;
use Illuminate\Support\Facades\Log;

class TemplateController extends Controller
{
    protected $templates;
    protected $departments;
    protected $counters;

    public function __construct(TemplateRepository $templates, DepartmentRepository $departments, CounterRepository $counters)
    {
        $this->templates = $templates;
        $this->departments = $departments;
        $this->counters = $counters;
    }

    public function index()
    {
        $this->authorize('access', Template::class);

        return view('user.templates.index', [
            'templates' =>$this->templates->getAll(),
        ]);
    }

    public function create()
    {
        $this->authorize('access', Template::class);

        return view('user.templates.create', [
            'departments' => $this->departments->getAll(),
            'counters' => $this->counters->getAll(),
        ]);
    }

    private function uploadVideoManual($fileField)
    {
        if (!isset($_FILES[$fileField]) || $_FILES[$fileField]['name'] == '') {
            return null;
        }

        $maxSize = 512000000; // 500MB
        $targetDir = base_path('assets/video/'); // ROOT folder project

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $originalName = $_FILES[$fileField]['name'];
        $tmpName = $_FILES[$fileField]['tmp_name'];
        $fileSize = $_FILES[$fileField]['size'];

        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        if ($extension !== 'mp4') {
            throw new \Exception('File harus MP4');
        }

        if ($fileSize <= 0 || $fileSize > $maxSize) {
            throw new \Exception('Ukuran file maksimal 500MB');
        }

        $filename = pathinfo($originalName, PATHINFO_FILENAME) . '_' . date('YmdHis') . '.' . $extension;
        $targetFile = $targetDir . $filename;

        if (!move_uploaded_file($tmpName, $targetFile)) {
            throw new \Exception('Gagal upload video');
        }

        return $filename;
    }


    public function store(Request $request)
    {
        $this->authorize('access', Template::class);

        try {
            // Validasi sederhana
            $this->validate($request, [
                'template_name' => 'required'
            ]);

            $content = [
                'header_background_color' => $request->header_background_color,
                'header_text_color' => $request->header_text_color,
                'header_date_text_color' => $request->header_date_text_color,
                'queue_background_color' => $request->queue_background_color,
                'queue_text_color' => $request->queue_text_color,
                'queue_active_text_color' => $request->queue_active_text_color,
                'service_text_color' => $request->service_text_color,
                'service_background_color_1' => $request->service_background_color_1,
                'service_background_color_2' => $request->service_background_color_2,
                'footer_background_color' => $request->footer_background_color,
                'footer_text_color' => $request->footer_text_color,
                'text_footer' => $request->text_footer,
                'size_logo' => $request->size_logo,
                'service_font_size' => $request->service_font_size,
                'queue_font_size' => $request->queue_font_size,
                'queue_active_font_size' => $request->queue_active_font_size,
                'footer_font_size' => $request->footer_font_size,
            ];

            $template = new Template();
            $template->name = $request->template_name;
            $template->content = json_encode($content);
            $template->department_ids = json_encode($request->department_ids);
            $template->counter_ids = json_encode($request->counters ?? []);
            $template->save();
            
            return redirect()->route('templates.index')->with('success', 'Template berhasil disimpan');
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->withInput()->withErrors(['error' => "Internal server error"]);
        }
    }


    public function edit(Request $request, Template $template)
    {
        $this->authorize('access', Template::class);


        return view('user.templates.edit', [
            'template' => $template,
            'departments' => $this->departments->getAll(),
            'counters' => $this->counters->getAll(),
        ]);
    }

    public function update(Request $request, Template $template)
    {
        $this->authorize('access', Template::class);

        $this->validate($request, [
            'template_name' => 'required',
        ]);

        try {
            $template->name = $request->template_name;
            $content = [
                'title' => $request->title,
                'title_font_size' => $request->title_font_size,
                'header_background_color' => $request->header_background_color,
                'header_text_color' => $request->header_text_color,
                'header_date_text_color' => $request->header_date_text_color,
                'queue_background_color' => $request->queue_background_color,
                'queue_text_color' => $request->queue_text_color,
                'queue_active_text_color' => $request->queue_active_text_color,
                'service_text_color' => $request->service_text_color,
                'service_background_color_1' => $request->service_background_color_1,
                'service_background_color_2' => $request->service_background_color_2,
                'footer_background_color' => $request->footer_background_color,
                'footer_text_color' => $request->footer_text_color,
                'text_footer' => $request->text_footer,
                'size_logo' => $request->size_logo,
                'service_font_size' => $request->service_font_size,
                'queue_font_size' => $request->queue_font_size,
                'queue_active_font_size' => $request->queue_active_font_size,
                'footer_font_size' => $request->footer_font_size,
            ];

            $template->content = json_encode($content);
            $template->department_ids = json_encode($request->department_ids);
            $template->counter_ids = json_encode($request->counters ?? []);
        
            $template->save();

            flash()->success('template updated');
            return redirect()->route('templates.index')->with('success', 'Template berhasil disimpan');
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->withInput()->withErrors(['error' => "Internal server error"]);
        }
    }

    public function destroy(Request $request, Template $template)
    {
        $this->authorize('access', Template::class);

        $template->delete();

        flash()->success('Template deleted');
        return redirect()->route('templates.index');
    }
}
