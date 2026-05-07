document.addEventListener('DOMContentLoaded', function () {
    const totalEl = document.getElementById('task-total');
    const completedEl = document.getElementById('task-completed');
    const taskItems = document.querySelectorAll('[data-task-card]');

    if (totalEl) {
        totalEl.textContent = taskItems.length;
    }

    if (completedEl) {
        completedEl.textContent = Array.from(taskItems).filter((item) => item.dataset.completed === '1').length;
    }

    document.querySelectorAll('form[data-confirm-delete]').forEach((form) => {
        form.addEventListener('submit', function (event) {
            if (!confirm('Tem certeza de que deseja excluir esta tarefa?')) {
                event.preventDefault();
            }
        });
    });
});
