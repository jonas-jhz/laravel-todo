@extends('layouts.app')

@section('title', 'Editar Task')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-2xl rounded-[2rem] border border-slate-700 bg-slate-900/90 p-10 shadow-2xl backdrop-blur-lg">
        <div class="mb-8 text-center">
            <p class="text-cyan-300 uppercase tracking-[0.3em] text-sm">Editar tarefa</p>
            <h1 class="mt-4 text-4xl font-semibold text-white">{{ $task->title }}</h1>
        </div>

        <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-slate-300">Título</label>
                <input type="text" name="title" value="{{ $task->title }}" required
                    class="mt-3 w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-5 py-4 text-slate-100 outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20" />
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300">Descrição</label>
                <textarea name="description" rows="4"
                    class="mt-3 w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-5 py-4 text-slate-100 outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20">{{ $task->description }}</textarea>
            </div>

            <div class="flex items-center gap-3">
                <input id="completed" type="checkbox" name="completed" value="1" {{ $task->completed ? 'checked' : '' }}
                    class="h-5 w-5 rounded border-slate-600 bg-slate-800 text-cyan-500 focus:ring-cyan-400" />
                <label for="completed" class="text-sm font-medium text-slate-200">Concluída</label>
            </div>

            <div class="flex flex-col gap-4 sm:flex-row sm:justify-between">
                <a href="{{ route('tasks.index') }}"
                    class="inline-flex items-center justify-center rounded-3xl border border-slate-700 bg-slate-950/80 px-6 py-3 text-sm font-semibold text-slate-200 transition hover:bg-slate-800">
                    Voltar
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-3xl bg-cyan-500 px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-400">
                    Salvar alterações
                </button>
            </div>
        </form>
    </div>
</div>
@endsection