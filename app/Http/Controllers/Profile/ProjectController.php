<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // For demo: replace with real model / DB query
    protected $sample = [
        'laravel' => [
            ['title'=>'Shop Backend (Laravel)', 'description'=>'E-commerce backend with orders, products, API', 'url'=>'/projects/shop-backend'],
            ['title'=>'Admin Panel', 'description'=>'Admin dashboard built with Laravel & Livewire', 'url'=>'/projects/admin-panel'],
        ],
        'react' => [
            ['title'=>'Product Catalog (React)', 'description'=>'SPA with React + Vite', 'url'=>'/projects/catalog-react'],
        ],
        'typescript' => [],
        'testing' => [],
        'ci-cd' => [],
        'cloud' => [],
    ];

    public function index(Request $request)
    {
        $tech = Str::lower($request->query('tech', ''));
        $projects = $this->sample[$tech] ?? [];

        if ($request->wantsJson()) {
            return response()->json($projects);
        }

        // non-json: render full projects page
        return view('projects.index', ['tech' => $tech, 'projects' => $projects]);
    }
}
