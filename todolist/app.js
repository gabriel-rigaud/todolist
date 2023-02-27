const form = document.getElementById('todo-form');
const taskList = document.getElementById('task-list');
const EDIT_BUTTON_TEXT = 'Modifier';
const SAVE_BUTTON_TEXT = 'Sauvegarder';
const DELETE_BUTTON_TEXT = 'Supprimer';

form.addEventListener('submit', (event) => {
    event.preventDefault();
    addTask();
});

function createButton(text, listener) {
    const button = document.createElement('button');
    button.textContent = text;
    button.addEventListener('click', listener);
    return button;
}

function createTextSpan(text) {
    const span = document.createElement('span');
    span.textContent = text;
    return span;
}

function createInput(type, value) {
    const input = document.createElement('input');
    input.type = type;
    input.value = value;
    return input;
}

function createTask(task) {
    const li = document.createElement('li');

    const taskSpan = createTextSpan(task);

    const editButton = createButton(EDIT_BUTTON_TEXT, () => {
        editTask(li);
    });

    const deleteButton = createButton(DELETE_BUTTON_TEXT, () => {
        deleteTask(li);
    });

    const dateSpan = createTextSpan(new Date().toLocaleString());

    li.appendChild(editButton);
    li.appendChild(deleteButton);
    li.appendChild(taskSpan);
    li.appendChild(dateSpan);

    return li;
}

function addTask() {
    const taskInput = document.getElementById('new-task');
    const task = taskInput.value;
    taskInput.value = '';

    const li = createTask(task);

    taskList.appendChild(li);

    const tasks = localStorage.getItem('tasks') ? JSON.parse(localStorage.getItem('tasks')) : [];
    tasks.push({ task: task, completed: false });
    localStorage.setItem('tasks', JSON.stringify(tasks));
}

function editTask(li) {
    const taskSpan = li.querySelector('span');
    const taskText = taskSpan.textContent;
    const taskInput = createInput('text', taskText);
    li.replaceChild(taskInput, taskSpan);

    const saveButton = createButton(SAVE_BUTTON_TEXT, () => {
        const newTaskText = taskInput.value;
        const newTaskSpan = createTextSpan(newTaskText);
        li.replaceChild(newTaskSpan, taskInput);
        toggleSaveButton(saveButton);
    });
    saveButton.classList.add('hidden');
    li.appendChild(saveButton);

    toggleSaveButton(saveButton);
}

function deleteTask(li) {
    taskList.removeChild(li);
}

function toggleSaveButton(saveButton) {
    saveButton.classList.toggle('hidden');
}
