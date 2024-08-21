import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

window.Echo.channel('tasks')
    .listen('TaskCreated', e => {
        alert(`Created New Task : ${e.task.title}`)
    })
    .listen('TaskUpdated', e => {
        alert(`Updated Task : ${e.task.title}`)
    })
    .listen('TaskDeleted', e => {
        alert(`Delete Task : ${e.taskId}`)
    })
