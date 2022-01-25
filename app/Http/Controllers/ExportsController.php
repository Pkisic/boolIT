<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Exports\ProductExport;
use Illuminate\Http\Request;

class ExportsController extends Controller
{
    public function exportProductsCategory(Request $request , Category $category)
    {
        $fileName = $category->name . ' ' . date('Y-m-d H:i');
        $fileName = \Str::of($fileName)->slug('_');
//        dd($fileName);
//        return (new ProductExport($category->id))->download('new.csv');
        
        return \Excel::store(new ProductExport($category->id), $fileName . '.csv','exports');
    }
}
