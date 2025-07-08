$(document).ready(function () {

    // dragula([document.getElementById('chip-drag-area')]);


    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('collection-list-table');
        if (!container) return;
        dragula([container]).on('drop', function () {
            document.getElementById('sort-actions').classList.remove('d-none');
            document.getElementById('sort-actions').classList.add('d-flex');
        });
    });



});
