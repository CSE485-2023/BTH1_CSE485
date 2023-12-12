<?php include '../header_ad.php'; ?>

    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">
                    <?php echo $_GET['action'] === 'create' ? 'Thêm người dùng' : 'Chỉnh sửa người dùng'; ?>
                </h3>
                <form action="../controllers/UserController.php?action=<?php echo $_GET['action']; ?>" method="post">
                    <?php if (isset($_GET['id']) && isset($user)) {
                        echo '
                 <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatId">Mã người dùng</span>
                    <input type="text" class="form-control" name="txtUserId" readonly value="' . $user["id"] . '">
                </div>
                ';
                    }
                    ?>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblUName">User</span>
                        <input type="text" class="form-control" name="txtUName" value="<?php echo isset($user) ? $user["username"] : ""; ?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblUPass">Password</span>
                        <input type="text" class="form-control" name="txtUPass">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblFullName">Họ tên</span>
                        <input type="text" class="form-control" name="txtFullName" value="<?php echo isset($user) ? $user["full_name"] : ""; ?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblBirth">Ngày sinh</span>
                        <input type="text" class="form-control" name="txtBirth" value="<?php echo isset($user) ? $user["birth"] : ""; ?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblBirth">Số điện thoại</span>
                        <input type="text" class="form-control" name="txtPhone" value="<?php echo isset($user) ? $user["phone"] : ""; ?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblAddress">Địa chỉ</span>
                        <input type="text" class="form-control" name="txtAddress" value="<?php echo isset($user) ? $user["address"] : ""; ?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblEmail">Email</span>
                        <input type="text" class="form-control" name="txtEmail" value="<?php echo isset($user) ? $user["email"] : ""; ?>">
                    </div>

                    <div class="form-group float-end">
                        <input type="submit" value="Lưu" class="btn btn-success">
                        <a href="list_user.php" class="btn btn-warning">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

<?php include '../footer_ad.php'; ?>