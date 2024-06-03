<?php
include 'PDO_connect.php';

// 每頁顯示的記錄數
$limit = 10;

// 當前頁碼
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// 獲取總記錄數
$sql = "SELECT COUNT(*) FROM cosmetic";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$total_results = $stmt->fetchColumn();
$total_pages = ceil($total_results / $limit);

// 獲取當前頁面的數據
$sql = "SELECT * FROM cosmetic LIMIT :start, :limit";
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
    <style>
        .column-seq { width: 80px; }
        .column-id { width: 100px; }
        .column-name { flex: 1; }
        .column-start { width: 200px; }
        .column-end { width: 200px; }
        .column-action { width: 80px; }
    </style>
</head>
<body>
<div class="container">
    <h1 class="my-4">產品列表</h1>
    <div class="d-flex flex-column">
        <div class="d-flex bg-light p-2 mb-2">
            <div class="p-2 column-seq">序號</div>
            <div class="p-2 column-id">產品 ID</div>
            <div class="p-2 column-name">產品名稱</div>
            <div class="p-2 column-start">上架時間</div>
            <div class="p-2 column-end">下架時間</div>
            <div class="p-2 column-action">操作</div>
        </div>
        <?php foreach ($products as $index => $product): ?>
        <div class="d-flex p-2 mb-2 border">
            <div class="p-2 column-seq"><?= $index + 1 + ($page - 1) * $limit; ?></div>
            <div class="p-2 column-id"><?= $product['product_code']; ?></div>
            <div class="p-2 column-name"><?= $product['product_name']; ?></div>
            <div class="p-2 column-start"><?= $product['start_date']; ?></div>
            <div class="p-2 column-end"><?= $product['end_date']; ?></div>
            <div class="p-2 column-action">
                <a href="edit.php?id=<?=$product['id']; ?>&page=<?=$page?>" class="btn btn-primary btn-sm">編輯</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- 分頁 -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                <a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

</body>
</html>
