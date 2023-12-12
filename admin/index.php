<?php include 'header_ad.php' ?>

    <main class="container mt-5 mb-5">
        <div class="row">
            <?php
            require_once "./database/connect.php";

            $conn = connectDB();

            if ($conn) {

                // create a table then iterate-> goo
                $tables = array(
                    'users' => 'Người dùng',
                    'baiviet' => 'Bài viết',
                    'theloai' => 'Thể loại',
                    'tacgia' => 'Tác giả'
                );

                foreach ($tables as $table => $label) {
                    $sql = "SELECT COUNT(*) FROM $table";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $count = $stmt->fetchColumn();

                    echo '
                    <div class="col-sm-3">
                        <div class="card mb-2" style="width: 100%;">
                            <div class="card-body">
                                <h5 class="card-title text-center">
                                    <a href="" class="text-decoration-none">' . $label . '</a>
                                </h5>

                                <h5 class="h1 text-center">
                                    ' . $count . '
                                </h5>
                            </div>
                        </div>
                    </div>
                ';
                }
            } else {
                echo 'Connection failure!';
            }
            ?>

        </div>
    </main>

<?php include 'footer_ad.php' ?>