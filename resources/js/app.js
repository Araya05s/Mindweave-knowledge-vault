import './bootstrap';
import interact from 'interactjs';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.body.addEventListener('htmx:afterRequest', function (evt) {
    if (evt.detail.elt.tagName === 'FORM') {
        const modalElement = document.getElementById('nodeModal');
        const modalInstance = bootstrap.Modal.getInstance(modalElement);
        if (modalInstance) {
            modalInstance.hide();
        }
    }
});

function showNodeModal() {
    const modalElement = document.getElementById('nodeModal');
    const modal = new bootstrap.Modal(modalElement);
    modal.show();
}

function closeNodeModal() {
    const modalElement = document.getElementById('nodeModal');
    const modal = bootstrap.Modal.getInstance(modalElement);
    if (modal) {
        modal.hide();
    }
}

interact('.draggable-node').draggable({
    listeners: {
        move(event) {
            const target = event.target;

            let x = (parseFloat(target.dataset.x) || 0) + event.dx;
            let y = (parseFloat(target.dataset.y) || 0) + event.dy;

            target.style.left = `${x}px`;
            target.style.top = `${y}px`;

            target.dataset.x = x;
            target.dataset.y = y;
        },

        end(event) {
            const target = event.target;
            const container = document.getElementById('sortable-nodes');

            let x = Number(target.dataset.x);
            let y = Number(target.dataset.y);

            const maxX = container.clientWidth - target.offsetWidth;
            const maxY = container.clientHeight - target.offsetHeight;

            x = Math.max(0, Math.min(x, maxX));
            y = Math.max(0, Math.min(y, maxY));

            target.style.left = `${x}px`;
            target.style.top = `${y}px`;

            target.dataset.x = x;
            target.dataset.y = y;

            fetch(`/app/nodes/${target.dataset.id}/move`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ x_pos: x, y_pos: y })
            });
        }
    }
});
