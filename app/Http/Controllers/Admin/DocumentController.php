<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Classification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        $classifications = Classification::all();
        return view('admin.documents.create', compact('classifications'));
    }
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'classification_id' => 'required|exists:classifications,id',
            'file' => 'nullable|mimes:pdf,doc,docx,xls,xlsx|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('documents', 'public');
        }

        // Si content est nul ou vide, on utilise le nom du fichier (sans l'extension) comme contenu par défaut
        $content = $request->content ?? ($filePath ? pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME) : 'No content provided');

        Document::create([
            'title' => $request->title,
            'classification_id' => $request->classification_id,
            'file_path' => $filePath,
            'content' => $content,
        ]);

        return redirect()->route('documents.index')->with('success', 'Document created successfully.');
    }

    public function edit(Document $document)
    {
        $classifications = Classification::all();
        return view('admin.documents.edit', compact('document', 'classifications'));
    }

    public function update(Request $request, Document $document)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'classification_id' => 'required|exists:classifications,id',
            'file' => 'nullable|mimes:pdf,doc,docx,xls,xlsx|max:2048',
        ]);

        if ($request->hasFile('file')) {
            if ($document->file_path) {
                Storage::disk('public')->delete($document->file_path);
            }
            $filePath = $request->file('file')->store('documents', 'public');
            $document->file_path = $filePath;
        }

        // Si content est nul ou vide, on utilise le nom du fichier (sans l'extension) comme contenu par défaut
        $content = $request->content ?? ($document->file_path ? pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME) : $document->content);

        $document->update([
            'title' => $request->title,
            'classification_id' => $request->classification_id,
            'content' => $content,
        ]);

        return redirect()->route('documents.index')->with('success', 'Document updated successfully.');
    }

    public function destroy(Document $document)
    {
        if ($document->file_path) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Document deleted successfully.');
    }

    public function download($id)
    {
        $document = Document::findOrFail($id);

        if (Storage::disk('public')->exists($document->file_path)) {
            return Storage::disk('public')->download($document->file_path);
        } else {
            return redirect()->back()->with('error', 'Le fichier n\'existe pas.');
        }
    }


}
