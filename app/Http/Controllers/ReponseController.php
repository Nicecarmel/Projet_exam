<?php

// app/Http/Controllers/ReponseController.php

namespace App\Http\Controllers;

use App\Models\Reponse;
use Illuminate\Http\Request;

class ReponseController extends Controller
{
    public function store(Request $request)
    {
        // Déjà géré dans ExamController@store
    }

    public function showResults($id_et, $id_ep)
    {
        $reponses = Reponse::where('id_et', $id_et)
            ->whereHas('question', function ($q) use ($id_ep) {
                $q->where('id_ep', $id_ep);
            })
            ->with('question', 'option')
            ->get();

        return view('student.exams.show_results', compact('reponses'));
    }
}
