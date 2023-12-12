<?php include 'header_ad.php' ?>
    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Thêm người dùng</h3>
                <form action="handle_add_user.php" method="post">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblUName">User</span>
                        <input type="text" class="form-control" name="txtUName" >
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblUPass">Password</span>
                        <input type="text" class="form-control" name="txtUPass" >
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblFullName">Họ tên</span>
                        <input type="text" class="form-control" name="txtFullName" >
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblBirth">Ngày sinh</span>
                        <input type="text" class="form-control" name="txtBirth" >
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblBirth">Số điện thoại</span>
                        <input type="text" class="form-control" name="txtPhone" >
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblAddress">Địa chỉ</span>
                        <input type="text" class="form-control" name="txtAddress" >
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblEmail">Email</span>
                        <input type="text" class="form-control" name="txtEmail" >
                    </div>
                    
                    <div class="form-group  float-end ">
                        <input type="submit" value="Thêm" class="btn btn-success">
                        <a href="user.php" class="btn btn-warning ">Quay lại</a>
                    </div>


                </form>
            </div>
        </div>
    </main>
<?php include 'footer_ad.php' ?>