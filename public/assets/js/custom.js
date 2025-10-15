function confirmDelete(action) {
    Swal.fire({
        title: "Are you sure?",
        text: "This record will be deleted permanently!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "Cancel",
        customClass: {
            confirmButton: "swal-confirm-btn",
            cancelButton: "swal-cancel-btn",
        },
        buttonsStyling: false, // disable default SweetAlert2 styling
        didRender: () => {
            // optional: you can force a hover effect via JS if needed
        },
    }).then((result) => {
        if (result.isConfirmed) {
            action();
        }
    });
}
