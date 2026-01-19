function handleEditProduct() {
    const price = document.getElementsByName("price")[0];
    const stock = document.getElementsByName("stock")[0];
    const image = document.getElementsByName("image")[0];

    // Price validation
    if (price.value <= 0) {
        swal("Error", "Price must be greater than 0", "error");
        return false;
    }

    // Stock validation
    if (stock.value < 0) {
        swal("Error", "Stock cannot be negative", "error");
        return false;
    }

    // Image validation (if updated)
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

    return true;
}
