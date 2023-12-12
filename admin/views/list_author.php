
<?php  include '../header_ad.php';  ?>
<main class="container mt-5 mb-5">
    <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
    <div class="row">
         <?php
    if (isset($_SESSION['notify_author_successfully'])) {
        echo '
    <div class="alert alert-success text-center" role="alert">
        ' . $_SESSION['notify_author_successfully'] . '
    </div>';
        unset($_SESSION['notify_author_successfully']);
    }
    ?>
        <?php
        if (isset($_SESSION['notify_author_deleted'])) {
            echo '
    <div class="alert alert-success text-center" role="alert">
        ' . $_SESSION['notify_author_deleted'] . '
    </div>';
            unset($_SESSION['notify_author_deleted']);
        }
        ?>
        <div class="col-sm">
            <a href="../views/author_form.php?action=create" class="btn btn-success">Thêm mới</a>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên tác giả</th>
                    <th scope="col">Hình ảnh</th>

                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($authors as $index =>$author) {
                    echo '
                        <tr>
                            <th scope="row">'.($index +1).'</th>
                            <td>'.$author["ten_tgia"].'</td>
                            <td>'.$author["hinh_tgia"].'</td>
                            <td>
                                <a href="?action=pre_update&id='.$author['ma_tgia'].'"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                <a class="btn-delete" href="?action=delete&id='.$author["ma_tgia"].'" fullname = "'.$author["ten_tgia"].'"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                     ';
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
</main>
<?php include '../footer_ad.php'; include '../../common/common_file.php'; ?>

<script>
    $(document).ready(function () {
        $('.btn-delete').on('click', function (e) {
            e.preventDefault();

            var link = $(this).attr("href");
            var name = $(this).attr("fullname");
            var modalTitle = "Xác nhận";
            var modalContent = "Bạn có muốn xóa tác giả có tên: " + name + " không?";

            // Update modal content
            $('#modal_yes_no .modal-title').text(modalTitle);
            $('#modal_yes_no .modal-body').text(modalContent);

            // Show the modal
            $('#modal_yes_no').modal('show');

            $('#btn-confirm').on('click', function () {
                $(this).attr("href",link);
            });
        });
    });
</script>
