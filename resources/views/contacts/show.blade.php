@extends('layout')

@section('content')
    <div class="max-w-xl mx-auto mt-10">
        <h2 class="text-2xl font-bold text-slate-800 mb-6">Detalhes do Contato</h2>

        <div class="mb-4">
            <strong>Nome:</strong>
            <p>{{ $contact->name }}</p>
        </div>

        <div class="mb-4">
            <strong>Contato:</strong>
            <p>{{ $contact->contact }}</p>
        </div>

        <div class="mb-6">
            <strong>Email:</strong>
            <p>{{ $contact->email }}</p>
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('contacts.index') }}" class="text-slate-600 text-sm hover:underline">← Voltar</a>

            <div class="flex gap-2">
                <a href="{{ route('contacts.edit', $contact) }}"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                    Editar
                </a>

                <form action="{{ route('contacts.destroy', $contact) }}" method="POST"
                    onsubmit="return confirm('Tem certeza que deseja excluir?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700">
                        Deletar
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
