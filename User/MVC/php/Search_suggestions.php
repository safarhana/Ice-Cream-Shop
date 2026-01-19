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

        $suggestions = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $suggestions[] = array(
                    'name' => htmlspecialchars($row['name']),
                    'image' => htmlspecialchars($row['image'])
                );
            }
        }
        echo json_encode($suggestions);
    }
}
?>
