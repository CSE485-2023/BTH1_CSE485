
<?php  include '../header_ad.php';  ?>
<main class="container mt-5 mb-5">
    <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
    <div class="row">
         <?php
    if (isset($_SESSION['notify_story_successfully'])) {
        echo '
    <div class="alert alert-success text-center" role="alert">
        ' . $_SESSION['notify_story_successfully'] . '
    </div>';
        unset($_SESSION['notify_story_successfully']);
    }
    ?>
        <?php
        if (isset($_SESSION['notify_story_deleted'])) {
            echo '
    <div class="alert alert-success text-center" role="alert">
        ' . $_SESSION['notify_story_deleted'] . '
    </div>';
            unset($_SESSION['notify_story_deleted']);
        }
        ?>
        <div class="col-sm">
            <a href="../views/story_form.php?action=create" class="btn btn-success">Thêm mới</a>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Tên bài hát</th>
                    <th scope="col">Thể loại </th>
                    <th scope="col">Tác giả</th>
                    <th scope="col">Tóm tắt</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($stories as $index =>$story) {
                    echo '
                        <tr>
                            <th scope="row">'.($index +1).'</th>
                            <td >'.$story["tieude"].'</td>
                            <td>'.$story["ten_bhat"].'</td>
                            <td>'.$story["ma_tloai"].'</td>
                            <td>'.$story["ma_tgia"].'</td>
                            <td>'.$story["tomtat"].'</td>
                            <td>
                                <a href="?action=pre_update&id='.$story['ma_bviet'].'"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                <a class="btn-delete" href="?action=delete&id='.$story["ma_tloai"].'" fullname = "'.$story["ten_bhat"].'"><i class="fa-solid fa-trash"></i></a>
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
            var modalContent = "Bạn có muốn xóa bài viết có tên: " + name + " không?";

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
