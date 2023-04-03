<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Document;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $category_count = Category::count();
        $document_count = Document::count();
        $user_count = User::count();

        return view('dashboard.index', compact('category_count', 'document_count', 'user_count'));
    }
}
