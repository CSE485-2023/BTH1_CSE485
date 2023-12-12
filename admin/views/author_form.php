<?php include '../header_ad.php'; ?>

    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">
                    <?php echo $_GET['action'] === 'create' ? 'Thêm tác giả' : 'Chỉnh sửa tác giả'; ?>
                </h3>
                <form action="../controllers/AuthorController.php?action=<?php echo $_GET['action']; ?>" method="post">
                    <?php if (isset($_GET['id']) && isset($author)) {
                        echo '
                 <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatId">Mã tác giả </span>
                    <input type="text" class="form-control" name="txtAuthorId" readonly value="' . $author["ma_tgia"] . '">
                </div>
                ';
                    }
                    ?>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblUName">Tên tác giả</span>
                        <input type="text" class="form-control" name="txtTenTacgia" value="<?php echo isset($author) ? $author["ten_tgia"] : ""; ?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblUPass">Ảnh</span>
                        <input type="text" class="form-control" name="txtHinhTacgia">
                    </div>


                    <div class="form-group float-end">
                        <input type="submit" value="Lưu" class="btn btn-success">
                        <a href="../controllers/AuthorController.php?action=list_author" class="btn btn-warning">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

<?php include '../footer_ad.php'; ?>