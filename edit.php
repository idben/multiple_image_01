<?php
include 'PDO_connect.php';

if (isset($_POST['submit'])) {
  $id = $_POST['id'];
  $product_name = $_POST['product_name'];
  $start_date = $_POST['start_date'];
  $end_date = !empty($_POST['end_date']) ? $_POST['end_date'] : null;
  $page = $_POST['page'];

  $sql = "UPDATE cosmetic SET product_name = :product_name, start_date = :start_date, end_date = :end_date WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':product_name', $product_name);
  $stmt->bindParam(':start_date', $start_date);
  $stmt->bindParam(':end_date', $end_date);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  header("Location: index.php?page=$page");
  exit;
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $page = isset($_GET['page']) ? $_GET['page'] : 1;

  $sql = "SELECT c.*, ci.img_url
            FROM cosmetic c
            LEFT JOIN cosmetic_img ci ON c.id = ci.cosmetic_id
            WHERE c.id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if ($result) {
    $product = array(
      'id' => $result[0]['id'],
      'product_name' => $result[0]['product_name'],
      'start_date' => $result[0]['start_date'],
      'end_date' => $result[0]['end_date']
    );
    $images = array();
    foreach ($result as $row) {
      if ($row['img_url']) {
        $images[] = $row['img_url'];
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="zh-TW">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>編輯產品</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h1 class="my-4">編輯產品</h1>
    <?php if (isset($product)) : ?>
      <form method="post" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <input type="hidden" name="page" value="<?php echo $page; ?>">
        <div class="mb-3">
          <label for="product_name" class="form-label">產品名稱</label>
          <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $product['product_name']; ?>" required>
        </div>
        <div class="mb-3">
          <label for="start_date" class="form-label">上架時間</label>
          <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="<?php echo date('Y-m-d\TH:i', strtotime($product['start_date'])); ?>" required>
        </div>
        <div class="mb-3">
          <label for="end_date" class="form-label">下架時間</label>
          <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="<?php echo $product['end_date'] ? date('Y-m-d\TH:i', strtotime($product['end_date'])) : ''; ?>">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">保存</button>
        <a href="index.php?page=<?php echo $page; ?>" class="btn btn-secondary">返回</a>
      </form>

      <h2 class="my-4">產品圖片</h2>
      <div class="row">
        <?php foreach ($images as $index => $image) : ?>
          <div class="col-md-3 mb-3 <?=($index === count($images) - 1)?'d-flex':''?>">
            <img src="<?php echo $image; ?>" class="img-fluid" alt="產品圖片">
            <?php if ($index === count($images) - 1) : ?>
              <div>
                <div class="btn btn-primary rounded rounded-0 rounded-end">加圖</div>
              </div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>

      </div>
    <?php else : ?>
      <p>產品未找到。</p>
      <a href="index.php?page=<?php echo $page; ?>" class="btn btn-secondary">返回</a>
    <?php endif; ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.min.js"></script>
</body>

</html>