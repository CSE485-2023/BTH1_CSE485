<?php include '../header_ad.php'; ?>

    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">
                    <?php echo $_GET['action'] === 'create' ? 'Thêm bài viết' : 'Chỉnh sửa bài viết'; ?>
                </h3>
                <form action="../controllers/StoryController.php?action=<?php echo $_GET['action']; ?>" method="post">
                    <?php if (isset($_GET['id']) && isset($story)) {
                        echo '
                 <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatId">Mã bài viết</span>
                    <input type="text" class="form-control" name="txtStoryId" readonly value="' . $story["ma_bviet"] . '">
                </div>
                ';
                    }
                    ?>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblUName">Tiêu đề</span>
                        <input type="text" class="form-control" name="txtTitle" value="<?php echo isset($story) ? $story["tieude"] : ""; ?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblUPass">Tên bài hát</span>
                        <input type="text" class="form-control" name="txtSongName" value="<?php echo isset($story) ? $story["ten_bhat"] : ""; ?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblFullName">Thể loại</span>
                            <select name="category">
                                <?php foreach ($categories as $category) {
                                    $isSelected = $category['ma_tloai'] === $story['ma_tloai'];

                                    echo '<option value="'.$category['ma_tloai'].'" ' . ($isSelected ? 'selected' : '') . '>'.$category['ten_tloai'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblBirth">Tóm tắt</span>
                        <input type="text" class="form-control" name="txtRecap" value="<?php echo isset($story) ? $story["tomtat"] : ""; ?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblBirth">Nội dung</span>
                        <input type="text" class="form-control" name="txtContent" value="<?php echo isset($story) ? $story["noidung"] : ""; ?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblAddress">Tác giả</span>
                        <select name="author">
                            <?php foreach ($authors as $author) {
                                $isSelected = $author['ma_tgia'] === $story['ma_tgia'];
                                echo '<option value="'.$author['ma_tgia'].'" ' . ($isSelected ? 'selected' : '') . '>'.$author['ten_tgia'].'</option>';
                                }
                            ?>
                        </select>                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblEmail">Hình ảnh</span>
                        <input type="text" class="form-control" name="txtImage" value="<?php echo isset($story) ? $story["hinhanh"] : ""; ?>">
                    </div>

                    <div class="form-group float-end">
                        <input type="submit" value="Lưu" class="btn btn-success">
                        <a href="../controllers/StoryController.php?action=list_story" class="btn btn-warning">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

<?php include '../footer_ad.php'; ?>