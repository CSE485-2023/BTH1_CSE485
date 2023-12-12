<?php include '../header_ad.php'; ?>

    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">
                    <?php echo $_GET['action'] === 'create' ? 'Thêm thể loại' : 'Chỉnh sửa thể loại'; ?>
                </h3>
                <form action="../controllers/CategoryController.php?action=<?php echo $_GET['action']; ?>" method="post">
                    <?php if (isset($_GET['id']) && isset($category)) {
                        echo '
                 <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatId">Mã thể loại</span> 
                    <input type="text" class="form-control" name="txtCategoryId" readonly value="' . $category["ma_tloai"] . '">
                </div>
                ';
                    }
                    ?>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblUName">Tên thể loại</span>
                        <input type="text" class="form-control" name="txtCategoryName" value="<?php echo isset($category) ? $category["ten_tloai"] : ""; ?>">
                    </div>


                    <div class="form-group float-end">
                        <input type="submit" value="Lưu" class="btn btn-success">
                        <a href="../controllers/CategoryController.php?action=list_category" class="btn btn-warning">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

<?php include '../footer_ad.php'; ?>