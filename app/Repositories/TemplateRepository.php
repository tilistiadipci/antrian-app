<?php

namespace App\Repositories;

use App\Models\Counter;
use App\Models\Department;
use App\Template;

class TemplateRepository
{
    public function getAll()
    {
        $templates = Template::get()->map(function ($template) {
            $departments = Department::whereIn('id', json_decode($template->department_ids))->get()->pluck('name')->implode(', ');
            $resultsCounter = Counter::whereIn('id', json_decode($template->counter_ids))->get();

            $counters = [];
            foreach ($resultsCounter as $counter) {
                if ($counter->call_type == "text") {
                    $counters[] = str_replace('.mp3', '', $counter->dinamic_call);
                } else {
                    $counters[] = $counter->name . ' ' . $counter->idcounter;
                }
            }

            return [
                'id' => $template->id,
                'name' => $template->name,
                'departments' => $departments,
                'counters' => implode(', ', $counters)
            ];    
        });

        return $templates;
    }

    // table->string('name', 200);
    //         $table->json('content')->nullable();
    //         $table->json('department_ids')->nullable();
    //         $table->json('counter_ids')->nullable();

    public function getById($id)
    {
        return Template::find($id);
    }
}
