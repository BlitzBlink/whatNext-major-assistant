<?php
$page = "admin";
include_once("../../templates/header.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: /whatnext/public/index.php");
  exit();
}

require_once("../../src/config/db.php");

$sql = "SELECT major_id, name FROM Major";
$result = $conn->query($sql);

$sample_majors = [];
while ($row = $result->fetch_assoc()) {
  $sample_majors[] = $row;
}

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Filter data based on search
$filtered_majors = $sample_majors;
if (!empty($search)) {
  $filtered_majors = array_filter($sample_majors, function ($major) use ($search) {
    return stripos($major['name'], $search) !== false ||
      stripos((string)$major['major_id'], $search) !== false;
  });
}

// Pagination settings
$items_per_page = 10;
$current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$total_items = count($filtered_majors);
$total_pages = ceil($total_items / $items_per_page);
$offset = ($current_page - 1) * $items_per_page;

$current_items = array_slice($filtered_majors, $offset, $items_per_page);
?>

<main class="admin">
  <h1>Admin Center</h1>
  <section class="majors-panel">
    <div class="container">
      <div>
        <h2>Majors</h2>
        <?php include_once("../../templates/majors_table.php");?>
      </div>
    </div>
  </section>
</main>