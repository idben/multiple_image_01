<?php
  include 'PDO_connect.php';

  // 每頁顯示的記錄數
  $limit = 10;

  // 當前頁碼
  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $start = ($page - 1) * $limit;

  // 設定排序字段和順序
  $valid_columns = ['id', 'start_date', 'end_date'];
  $sort_column = isset($_GET['sort_by']) && in_array($_GET['sort_by'], $valid_columns) ? $_GET['sort_by'] : 'id';
  $sort_order = isset($_GET['sort_order']) && $_GET['sort_order'] === 'desc' ? 'desc' : 'asc';
  $next_sort_order = $sort_order === 'asc' ? 'desc' : 'asc';

  // 設定篩選條件
  $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

  // 根據篩選條件獲取總記錄數
  $filter_query = "";
  if ($filter === 'active') {
    $filter_query = "WHERE end_date IS NULL OR end_date > NOW()";
  } elseif ($filter === 'expired') {
    $filter_query = "WHERE end_date IS NOT NULL AND end_date <= NOW()";
  } elseif ($filter === 'permanent') {
    $filter_query = "WHERE end_date IS NULL";
  }

  $sql = "SELECT COUNT(*) FROM cosmetic $filter_query";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $total_results = $stmt->fetchColumn();
  $total_pages = ceil($total_results / $limit);

  // 根據篩選條件獲取資料
  $sql = "SELECT * FROM cosmetic $filter_query ORDER BY $sort_column $sort_order LIMIT :start, :limit";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':start', $start, PDO::PARAM_INT);
  $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
  $stmt->execute();
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="zh-TW">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>產品列表</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
  <style>
    .column-seq {
      width: 80px;
    }

    .column-id {
      width: 100px;
    }

    .column-name {
      flex: 1;
    }

    .column-start {
      width: 200px;
    }

    .column-end {
      width: 200px;
    }

    .column-action {
      width: 80px;
    }

    .sortable {
      display: flex;
      align-items: center;
      cursor: pointer;
      color: #2c78db;
    }

    .sortable .bi {
      margin-left: 5px;
    }

    .w120px{
      width: 120px;
      padding-top: 0;
      padding-bottom: 0;
      line-height: 1;
      font-size: 16px;
      height: 40px;
    }

    .hover:hover{
      background-color: #e3efff;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1 class="my-4">產品列表</h1>
    <div class="d-flex justify-content-end">
      <!-- 分頁 -->
      <nav class="me-2">
        <ul class="pagination justify-content-center">
          <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
              <a class="page-link" href="index.php?page=<?= $i; ?>&sort_by=<?= $sort_column; ?>&sort_order=<?= $sort_order; ?>&filter=<?= $filter; ?>"><?= $i; ?></a>
            </li>
          <?php endfor; ?>
        </ul>
      </nav>
      <select id="filter" class="form-select w120px" onchange="location = this.value;">
        <option value="?filter=all&sort_by=<?= "{$sort_column}" ?>&sort_order=<?= "{$sort_order}" ?>" <?= $filter === 'all' ? 'selected' : '' ?>>所有產品</option>
        <option value="?filter=active&sort_by=<?= "{$sort_column}" ?>&sort_order=<?= "{$sort_order}" ?>" <?= $filter === 'active' ? 'selected' : '' ?>>上架中</option>
        <option value="?filter=expired&sort_by=<?= "{$sort_column}" ?>&sort_order=<?= "{$sort_order}" ?>" <?= $filter === 'expired' ? 'selected' : '' ?>>已下架</option>
        <option value="?filter=permanent&sort_by=<?= "{$sort_column}" ?>&sort_order=<?= "{$sort_order}" ?>" <?= $filter === 'permanent' ? 'selected' : '' ?>>永久上架</option>
      </select>

    </div>

    <div class="d-flex flex-column">
      <div class="d-flex bg-light p-2 mb-2">
        <div class="p-2 column-seq sortable" onclick="window.location.href='?filter=<?= $filter; ?>&sort_by=id&sort_order=<?= $next_sort_order; ?>'">
          序號
          <?php if ($sort_column === 'id') : ?>
            <i class="bi bi-caret-<?= $sort_order === 'asc' ? 'up' : 'down'; ?>-fill"></i>
          <?php endif; ?>
        </div>
        <div class="p-2 column-id">產品 ID</div>
        <div class="p-2 column-name">產品名稱</div>
        <div class="p-2 column-start sortable" onclick="window.location.href='?filter=<?= $filter; ?>&sort_by=start_date&sort_order=<?= $next_sort_order; ?>'">
          上架時間
          <?php if ($sort_column === 'start_date') : ?>
            <i class="bi bi-caret-<?= $sort_order === 'asc' ? 'up' : 'down'; ?>-fill"></i>
          <?php endif; ?>
        </div>
        <div class="p-2 column-end sortable" onclick="window.location.href='?filter=<?= $filter; ?>&sort_by=end_date&sort_order=<?= $next_sort_order; ?>'">
          下架時間
          <?php if ($sort_column === 'end_date') : ?>
            <i class="bi bi-caret-<?= $sort_order === 'asc' ? 'up' : 'down'; ?>-fill"></i>
          <?php endif; ?>
        </div>
        <div class="p-2 column-action">操作</div>
      </div>
      <?php foreach ($products as $index => $product) : ?>
        <div class="d-flex p-0 px-2 mb-1 border hover">
          <div class="p-2 column-seq"><?= $index + 1 + ($page - 1) * $limit; ?></div>
          <div class="p-2 column-id"><?= $product['product_code']; ?></div>
          <div class="p-2 column-name"><?= $product['product_name']; ?></div>
          <div class="p-2 column-start"><?= $product['start_date']; ?></div>
          <div class="p-2 column-end"><?= $product['end_date']; ?></div>
          <div class="p-2 column-action">
            <a href="edit.php?id=<?= $product['id']; ?>&page=<?= $page; ?>&filter=<?= $filter; ?>" class="btn btn-primary btn-sm">編輯</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>