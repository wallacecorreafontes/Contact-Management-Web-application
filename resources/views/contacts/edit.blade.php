@extends('layout')

@section('content')
    <div class="max-w-xl mx-auto mt-10">
        <h2 class="text-2xl font-bold text-slate-800 mb-6">
            {{ isset($contact) ? 'Editar Contato' : 'Novo Contato' }}
        </h2>

        @if ($errors->any())
            <div class="mb-6 p-4 rounded bg-red-100 text-red-700 border border-red-300 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ isset($contact) ? route('contacts.update', $contact) : route('contacts.store') }}">
            @csrf
            @if (isset($contact))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1" for="name">Nome</label>
                <input type="text" name="name" id="name" value="{{ old('name', $contact->name ?? '') }}"
                    class="w-full border border-slate-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-slate-400">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1" for="contact">Contato</label>
                <input type="text" name="contact" id="contact" value="{{ old('contact', $contact->contact ?? '') }}"
                    class="w-full border border-slate-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-slate-400">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-700 mb-1" for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $contact->email ?? '') }}"
                    class="w-full border border-slate-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-slate-400">
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('contacts.index') }}" class="text-slate-600 text-sm hover:underline">← Voltar</a>
                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                    {{ isset($contact) ? 'Atualizar' : 'Salvar' }}
                </button>
            </div>
        </form>
    </div>
@endsection
