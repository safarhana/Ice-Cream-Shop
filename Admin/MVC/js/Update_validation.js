function handleUpdate() {
    const oldPass = document.getElementsByName("old_pass")[0];
    const newPass = document.getElementsByName("new_pass")[0];
    const cpass = document.getElementsByName("cpass")[0];
    const image = document.getElementsByName("image")[0];

    // Image validation
    if (image.files.length > 0) {
        const file = image.files[0];
        const fileName = file.name;
        const fileSize = file.size;
        const fileExtension = fileName.split('.').pop().toLowerCase();

        if (!['jpg', 'jpeg', 'png'].includes(fileExtension)) {
            swal("Error", "Image must be in JPG, JPEG or PNG format", "error");
            return false;
        }

        if (fileSize > 2000000) {
            swal("Error", "Image size must be less than 2MB", "error");
            return false;
        }
    }

    // Password validation
    if (newPass.value.length > 0) {
        if (oldPass.value.length === 0) {
            swal("Error", "Please enter your old password", "error");
            return false;
        }

        if (newPass.value.length < 8) {
            swal("Error", "New password must be at least 8 characters long", "error");
            return false;
        }

        if (newPass.value !== cpass.value) {
            swal("Error", "Confirm password does not match new password", "error");
            return false;
        }
    }

    return true;
}
