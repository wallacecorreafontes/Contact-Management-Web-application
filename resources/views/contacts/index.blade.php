@extends('layout')

@section('content')
    <div class="max-w-[1200px] mx-auto">
        <div class="flex justify-between items-center mb-6 mt-5 px-3">
            <div>
                <h3 class="text-lg font-semibold text-slate-800">
                    Listagem de Contatos
                </h3>
                <a href="{{ route('contacts.create') }}" class="underline italic"> + Criar novo contato</a>
            </div>
            <div class="relative w-full max-w-sm min-w-[200px]">
                <input
                    class="w-full pr-11 h-10 pl-3 text-sm border border-slate-200 rounded placeholder:text-slate-400 text-slate-700 shadow-sm focus:outline-none focus:border-slate-400 hover:border-slate-400 focus:shadow-md"
                    placeholder="Busque um contato..." />
                <button class="absolute right-1 top-1 h-8 w-8 flex items-center justify-center rounded bg-white"
                    type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"
                        class="w-5 h-5 text-slate-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">#ID</th>
                        <th class="px-6 py-3">Nome</th>
                        <th class="px-6 py-3">Contato</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4 text-gray-900">{{ $contact->id }}</td>
                            <td class="px-6 py-4">{{ $contact->name }}</td>
                            <td class="px-6 py-4">{{ $contact->contact }}</td>
                            <td class="px-6 py-4">{{ $contact->email }}</td>
                            <td class="px-6 py-4 flex gap-1 flex-wrap">
                                <a href="{{ route('contacts.show', $contact->id) }}"
                                    class="px-3 py-1 text-xs font-medium text-blue-700 bg-blue-100 border border-blue-300 rounded hover:bg-blue-200">
                                    Visualizar
                                </a>
                                <a href="{{ route('contacts.edit', $contact->id) }}"
                                    class="px-3 py-1 text-xs font-medium text-green-700 bg-green-100 border border-green-300 rounded hover:bg-green-200">
                                    Editar
                                </a>
                                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST"
                                    onsubmit="return confirm('Tem certeza que deseja deletar este contato?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 text-xs font-medium text-red-700 bg-red-100 border border-red-300 rounded hover:bg-red-200">
                                        Deletar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 px-3">
            {{ $contacts->links() }}
        </div>
    </div>
@endsection
