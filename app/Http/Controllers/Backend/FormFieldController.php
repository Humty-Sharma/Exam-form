<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ExamForm;
use App\Models\FormField;
use Illuminate\Http\Request;

class FormFieldController extends Controller
{
    public function index(ExamForm $examForm)
    {
        $fields = $examForm->fields()->orderBy('order')->get();
        return view('backend.pages.form_fields.index', compact('examForm', 'fields'));
    }

    public function create(ExamForm $examForm)
    {
        return view('backend.pages.form_fields.create', compact('examForm'));
    }

    public function store(Request $request, ExamForm $examForm)
    {
        $request->validate([
            'field_key' => 'required|string|max:100',
            'label' => 'required|string|max:255',
            'type' => 'required|string',
        ]);

        $examForm->fields()->create($request->all());

        return redirect()->route('admin.form_fields.index', $examForm->id)
            ->with('success', 'Field added successfully!');
    }

    public function edit(ExamForm $examForm, FormField $formField)
    {
        return view('backend.pages.form_fields.create', compact('examForm', 'formField'));
    }

    public function update(Request $request, ExamForm $examForm, FormField $formField)
    {
        $request->validate([
            'field_key' => 'required|string|max:100',
            'label' => 'required|string|max:255',
            'type' => 'required|string',
        ]);

        $formField->update($request->all());

        return redirect()->route('admin.form_fields.index', $examForm->id)
            ->with('success', 'Field updated successfully!');
    }

    public function destroy(ExamForm $examForm, FormField $formField)
    {
        $formField->delete();

        return redirect()->route('admin.form_fields.index', $examForm->id)
            ->with('success', 'Field deleted!');
    }
}
