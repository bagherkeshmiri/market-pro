<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;

class FaqController extends Controller
{
    public function delete(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faq.index');
    }
}
