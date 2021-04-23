<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $categories = Categories::get();
        return view('categories', ['categories' => $categories]);
    }
    public function create(CategoryRequest $request)
    {
        Categories::create(['title' => $request->title]);
        return redirect('categories');
    }
    public function destroy($id)
    {
        DB::table('categories')->delete($id);
        return redirect('categories');
    }

}
