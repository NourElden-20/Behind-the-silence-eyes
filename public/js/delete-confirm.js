/**
 * delete-confirm.js
 * Handles delete confirmation for patient records using Bootstrap Modal.
 * Place this file in: public/js/delete-confirm.js
 */

document.addEventListener('DOMContentLoaded', function () {

    // ── 1. Create modal using Bootstrap modal structure 
    const modalHTML = `
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Patient</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this patient? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="modalConfirmBtn">Yes, Delete</button>
                    </div>
                </div>
            </div>
        </div>
    `;

    document.body.insertAdjacentHTML('beforeend', modalHTML);

    // ── 2. References 
    const confirmBtn = document.getElementById('modalConfirmBtn');
    let targetForm = null;

    // ── 3. Open modal when delete button is clicked 
    document.addEventListener('click', function (e) {
        const deleteBtn = e.target.closest('.btn-delete-patient');
        if (!deleteBtn) return;

        e.preventDefault();
        targetForm = deleteBtn.closest('form');
        $('#deleteModal').modal('show');
    });

    // ── 4. Confirm — submit the form 
    confirmBtn.addEventListener('click', function () {
        if (targetForm) {
            targetForm.submit();
        }
        $('#deleteModal').modal('hide');
    });

});


// ```javascript
// /**
//  * delete-confirm.js
//  * Handles delete confirmation for patient records.
//  * Place this file in: public/js/delete-confirm.js
//  */

// document.addEventListener('DOMContentLoaded', function () {

//     // Event delegation: listens on the document for any delete button click
//     document.addEventListener('click', function (e) {
//         const deleteBtn = e.target.closest('.btn-delete-patient');

//         if (!deleteBtn) return;

//         e.preventDefault();

//         const confirmed = window.confirm('Are you sure you want to delete this patient?');

//         if (confirmed) {
//             // Find the closest form and submit it
//             const form = deleteBtn.closest('form');
//             if (form) {
//                 form.submit();
//             }
//         }
//         // If cancelled, do nothing — operation is aborted
//     });

// }); 

