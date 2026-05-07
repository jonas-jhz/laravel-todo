@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
    <div class="w-full max-w-5xl mx-auto space-y-8">
        <div class="flex flex-col gap-4 rounded-[2rem] border border-slate-700 bg-slate-900/90 p-8 shadow-2xl backdrop-blur-xl sm:flex-row sm:items-center sm:justify-between">
            <div class="text-center sm:text-left">
                <p class="text-sm uppercase tracking-[0.3em] text-cyan-300">Bem-vindo(a)</p>
                <h1 class="mt-3 text-4xl font-semibold text-white">{{ auth()->user()->name }}</h1>
                <p class="mt-2 text-slate-400">Suas tarefas estão aqui, sempre ao alcance.</p>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="self-start sm:self-auto">
                @csrf
                <button type="submit"
                    class="rounded-3xl bg-slate-100 px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-slate-200">
                    Logout
                </button>
            </form>
        </div>

        <div class="rounded-[2.5rem] border border-slate-700 bg-slate-900/90 p-8 shadow-[0_30px_80px_rgba(15,23,42,0.7)]">
            <div class="text-center">
                <p class="text-cyan-300 uppercase tracking-[0.3em] text-sm">Nova tarefa</p>
                <h2 class="mt-4 text-4xl font-semibold text-white">Crie sua task</h2>
                <p class="mx-auto mt-3 max-w-2xl text-slate-400">Use a barra abaixo para adicionar rapidamente uma tarefa com descrição.</p>
            </div>

            <div class="mt-10">
                <form action="{{ route('tasks.store') }}" method="POST" class="grid gap-4 sm:grid-cols-[1fr_auto]">
                    @csrf
                    <div class="space-y-4">
                        <input type="text" name="title" placeholder="Digite o título da task"
                            class="w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-5 py-4 text-slate-100 outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20"
                            required>
                        <textarea name="description" rows="3" placeholder="Descrição opcional"
                            class="w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-5 py-4 text-slate-100 outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20"></textarea>
                    </div>
                    <button type="submit"
                        class="rounded-3xl bg-cyan-500 px-8 py-4 text-sm font-semibold uppercase tracking-[0.15em] text-slate-950 transition hover:bg-cyan-400">
                        Adicionar
                    </button>
                </form>
            </div>

            <div class="mt-12 grid gap-4">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl border border-slate-700 bg-slate-950/70 p-6 text-center">
                        <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Total de tasks</p>
                        <p id="task-total" class="mt-3 text-3xl font-semibold text-white">0</p>
                    </div>
                    <div class="rounded-3xl border border-slate-700 bg-slate-950/70 p-6 text-center">
                        <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Completas</p>
                        <p id="task-completed" class="mt-3 text-3xl font-semibold text-white">0</p>
                    </div>
                </div>

                <div class="rounded-[2rem] border border-slate-700 bg-slate-950/80 p-6">
                    <h3 class="text-xl font-semibold text-white text-center">Suas tarefas</h3>
                    <p class="mt-2 text-slate-400 text-center">Abaixo estão as tasks criadas. Edite ou exclua quando quiser.</p>

                    <div class="mt-6 space-y-4">
                        @if ($tasks->isEmpty())
                            <div class="rounded-3xl border border-dashed border-slate-700 bg-slate-900/80 p-8 text-center text-slate-400">
                                Nenhuma task encontrada. Crie uma nova no topo da página.
                            </div>
                        @endif

                        @foreach ($tasks as $task)
                            <div data-task-card="true" data-completed="{{ $task->completed ? 1 : 0 }}"
                                class="rounded-3xl border border-slate-700 bg-slate-900/80 p-6 shadow-inner shadow-slate-950/30">
                                <div class="flex flex-col gap-3 items-center text-center">
                                    <div>
                                        <p class="text-sm uppercase tracking-[0.3em] text-cyan-300">Task</p>
                                        <h4 class="mt-2 text-2xl font-semibold text-white">{{ $task->title }}</h4>
                                        @if ($task->description)
                                            <p class="mt-3 text-slate-400">{{ $task->description }}</p>
                                        @endif
                                        <p class="mt-3 text-sm font-medium {{ $task->completed ? 'text-emerald-300' : 'text-amber-300' }}">
                                            {{ $task->completed ? 'Concluída' : 'Pendente' }}
                                        </p>
                                    </div>

                                    <div class="flex flex-wrap gap-2 justify-center pt-4">
                                        <a href="{{ route('tasks.edit', $task) }}"
                                            class="rounded-3xl border border-slate-700 bg-slate-950/90 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">
                                            Editar
                                        </a>
                                        <a href="{{ route('tasks.show', $task) }}"
                                            class="rounded-3xl border border-slate-700 bg-slate-950/90 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">
                                            Ver
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline" data-confirm-delete>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="rounded-3xl border border-red-500 bg-red-500/10 px-4 py-2 text-sm font-semibold text-red-300 transition hover:bg-red-500/20">
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection