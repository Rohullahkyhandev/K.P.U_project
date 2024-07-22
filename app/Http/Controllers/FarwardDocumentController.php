<?php

namespace App\Http\Controllers;

use App\Models\FarwardDocument;
use Illuminate\Http\Request;


class FarwardDocumentController extends Controller
{

    public function destroy($id)
    {
        $farward_document = FarwardDocument::find($id);
        $result =  $farward_document->delete();
        return $result;
    }
}
