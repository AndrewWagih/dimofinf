<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Services\ExportService;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class ExportController extends Controller
{
    protected $exportService;

    public function __construct(ExportService $exportService)
    {
        $this->exportService = $exportService;
    }

    public function exportUsers(){
        $users = $this->exportService->exportUsers();
        return (new FastExcel($users))->export('users report ( '.now()->subDays(1)->format('Y-m-d').' ).xlsx');
    }

    public function exportPosts(){
        $posts =  $this->exportService->exportPosts();
        return (new FastExcel($posts))->export('posts report ( '.now()->subDays(1)->format('Y-m-d').' ).xlsx');
    }
}
