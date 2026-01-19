function handleSubmit() {
    const name = document.getElementsByName("name")[0];
    const email = document.getElementsByName("email")[0];
    const pass = document.getElementsByName("pass")[0];
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

    // Email validation
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email.value)) {
        swal("Error", "Please enter a valid email address", "error");
        return false;
    }

    // Password length validation
    if (pass.value.length < 8) {
        swal("Error", "Password must be at least 8 characters long", "error");
        return false;
    }

    // Password match validation
    if (pass.value !== cpass.value) {
        swal("Error", "Passwords do not match", "error");
        return false;
    }

    return true;
}
