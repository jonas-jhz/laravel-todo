@extends('layouts.app')

@section('title', 'Detalhes da Task')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-2xl rounded-[2rem] border border-slate-700 bg-slate-900/90 p-10 shadow-2xl backdrop-blur-lg">
        <div class="mb-8 text-center">
            <p class="text-cyan-300 uppercase tracking-[0.3em] text-sm">Detalhes da tarefa</p>
            <h1 class="mt-4 text-4xl font-semibold text-white">{{ $task->title }}</h1>
        </div>

        <div class="space-y-6 rounded-3xl border border-slate-700 bg-slate-950/80 p-6">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Descrição</p>
                <p class="mt-3 text-lg text-slate-100">{{ $task->description ?? 'Sem descrição.' }}</p>
            </div>
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Status</p>
                <span class="mt-2 inline-flex rounded-full px-4 py-2 text-sm font-semibold" style="background-color: {{ $task->completed ? 'rgba(16,185,129,0.15)' : 'rgba(245,158,11,0.15)' }}; color: {{ $task->completed ? '#34d399' : '#f59e0b' }};">
                    {{ $task->completed ? 'Concluída' : 'Pendente' }}
                </span>
            </div>
        </div>

        <div class="mt-8 flex flex-col gap-4 sm:flex-row sm:justify-between">
            <a href="{{ route('tasks.index') }}"
                class="inline-flex items-center justify-center rounded-3xl border border-slate-700 bg-slate-950/80 px-6 py-3 text-sm font-semibold text-slate-200 transition hover:bg-slate-800">
                Voltar
            </a>
            <a href="{{ route('tasks.edit', $task) }}"
                class="inline-flex items-center justify-center rounded-3xl bg-cyan-500 px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-400">
                Editar tarefa
            </a>
        </div>
    </div>
</div>
@endsection