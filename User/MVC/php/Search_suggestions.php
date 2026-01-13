<?php
include '../db/Connect.php';

if (isset($_POST['query'])) {
    $search_query = filter_var($_POST['query'], FILTER_SANITIZE_STRING);
    $search_term = "%" . $search_query . "%";
    $status = 'active';

    if (!empty($search_query)) {
        $select_products = $conn->prepare("SELECT name, image FROM `products` WHERE name LIKE ? AND status = ? LIMIT 5");
        $select_products->bind_param("ss", $search_term, $status);
        $select_products->execute();
        $result = $select_products->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<a href="#" class="suggestion-item" data-name="' . htmlspecialchars($row['name']) . '">
                        <img src="../../../Admin/MVC/uploaded_files/' . htmlspecialchars($row['image']) . '" alt="" style="width: 30px; height: 30px; object-fit: cover; margin-right: 10px;">
                        <span>' . htmlspecialchars($row['name']) . '</span>
                      </a>';
            }
        } else {
            echo '<p class="no-results">No products found</p>';
        }
    }
}
?>
