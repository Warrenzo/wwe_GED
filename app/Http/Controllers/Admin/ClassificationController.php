<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classification;
use App\Models\Document;
use Illuminate\Http\Request;

class ClassificationController extends Controller
{
    public function index()
    {
        $classifications = Classification::whereNull('parent_id')->with('children')->get();
        return view('admin.classifications.index', compact('classifications'));
    }

    public function create()
    {
        $classifications = Classification::all();
        return view('admin.classifications.create', compact('classifications'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'parent_id' => 'nullable|exists:classifications,id',
        ]);

        Classification::create($request->all());

        return redirect()->route('classifications.index')->with('success', 'Classification created successfully.');
    }

    public function edit(Classification $classification)
    {
        $classifications = Classification::all();
        return view('admin.classifications.edit', compact('classification', 'classifications'));
    }

    public function update(Request $request, Classification $classification)
    {
        $request->validate([
            'name' => 'required',
            'parent_id' => 'nullable|exists:classifications,id',
        ]);

        $classification->update($request->all());

        return redirect()->route('classifications.index')->with('success', 'Classification updated successfully.');
    }

    public function destroy(Classification $classification)
    {
        $classification->delete();

        return redirect()->route('classifications.index')->with('success', 'Classification deleted successfully.');
    }

    // Méthode pour afficher les documents associés à une classification et ses sous-classifications
    public function showDocuments($classificationId)
    {
        $classification = Classification::findOrFail($classificationId);

        // Récupérer les IDs de la classification et de toutes ses sous-classifications
        $allClassificationIds = $this->getAllClassificationIds($classification);

        // Récupérer tous les documents associés à ces classifications
        $documents = Document::whereIn('classification_id', $allClassificationIds)->get();

        return view('admin.classifications.documents', compact('classification', 'documents'));
    }

    // Méthode pour récupérer les IDs de la classification et de toutes ses sous-classifications
    private function getAllClassificationIds(Classification $classification)
    {
        $ids = collect([$classification->id]);

        foreach ($classification->children as $child) {
            $ids = $ids->merge($this->getAllClassificationIds($child));
        }

        return $ids;
    }
}
