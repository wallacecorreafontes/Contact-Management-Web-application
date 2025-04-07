<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }


    public function index()
    {
        $contacts = Contact::paginate(10);
        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.edit');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => [
                'required',
                'string',
                'max:9',
                Rule::unique('contacts', 'contact'),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('contacts', 'email'),
            ],
        ]);

        Contact::create($data);

        return redirect()->route('contacts.index')->with('success', 'Contato criado com sucesso!');
    }

    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show', compact('contact'));
    }

    public function edit(string $id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, string $id)
    {
        $contact = Contact::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => [
                'required',
                'string',
                'max:9',
                Rule::unique('contacts', 'contact')->ignore($contact->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('contacts', 'email')->ignore($contact->id),
            ],
        ]);

        $contact->update($data);

        return redirect()->route('contacts.index')->with('success', 'Contato atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contato removido com sucesso!');
    }
}
