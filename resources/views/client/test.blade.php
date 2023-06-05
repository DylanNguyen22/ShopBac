<!-- load file layout vao day -->
<?php
$this->fileLayout = 'Views/Backend/Layout1.php';
?>
<input type="text" id="searchInput">
<div class="col-md-12">
    <div style="margin-bottom:5px;">
        <a href="index.php?area=backend&controller=Product&action=add" class="btn btn-primary">Thêm Sản Phẩm</a>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">Danh sách sản phẩm</div>
        <div class="panel-body">
            <table id="productTable" class="table table-bordered table-hover">
                <tr>
                    <th>STT</th>
                    <th style="width:100px;">Ảnh</th>
                    <th>Tiêu đề</th>
                    <th style="width: 150px;">Danh mục</th>
                    <th style="width: 100px;">Giá</th>
                    <th style="width: 100px;">Sản phẩm nổi bật</th>
                    <th style="width:100px;"></th>
                </tr>
                <?php $cnt = 1;
                foreach ($data as $key => $rows) : ?>
                <tr>
                    <td><?php echo $cnt;
                    $cnt++; ?></td>
                    <td>
                        <?php if ($rows->img != "" && file_exists("Assets/upload/product/" . $rows->img)) : ?>
                        <img src="Assets/upload/product/<?php echo $rows->img; ?>" style="width: 100px;">
                        <?php endif; ?>
                    </td>
                    <td><?php echo $rows->name; ?></td>
                    <td>
                        <?php
                        //tu day co the goi thang ham trong model, ham getCategory nam trong model
                        $category = $this->getCategory($rows->cate_id);
                        echo isset($category->cate_name) ? $category->cate_name : '';
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        echo number_format($rows->price);
                        $conn = Connection::getInstance();
                        
                        $query2 = $conn->query("select * from tbl_discount where discount_id = $rows->discount_id");
                        $result = $query2->fetchAll();
                        if ($result != null) {
                            echo '<br>';
                            echo number_format(($rows->price / 100) * (100 - $result[0]->reduced_price));
                        }
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php if ($rows->hotproduct == 1) : ?>
                        <i class="gg-check"></i>
                        <?php endif; ?>
                    </td>
                    <td style="text-align:center;">
                        <a
                            href="index.php?area=backend&controller=Product&action=edit&id=<?php echo $rows->id; ?>">Edit</a>&nbsp;
                        <a href="index.php?area=backend&controller=Product&action=delete&id=<?php echo $rows->id; ?>"
                            onclick="return window.confirm('Bạn chắc chắn muốn xóa sản phẩm này?');">Delete</a>&nbsp;
                        <a
                            href="index.php?area=backend&controller=Product&action=detail&id=<?php echo $rows->id; ?>">Detail</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <style type="text/css">
                .pagination {
                    padding: 0px;
                    margin: 0px;
                }
            </style>
            <ul class="pagination">
                <li class="page-item disabled">
                    <a href="#" class="page-link">Trang</a>
                </li>
                <?php for ($i = 1; $i <= $numPage; $i++) : ?>
                <li class="page-item">
                    <a href="index.php?area=backend&controller=Product&p=<?php echo $i; ?>"
                        class="page-link"><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
</div>
<link href='https://css.gg/check.css' rel='stylesheet'>
<script>
    const searchInput = document.getElementById("searchInput");
    const rows = document.querySelectorAll("#productTable tbody tr");
    searchInput.addEventListener("keyup", function(event) {
        const searchValue = event.target.value.toLowerCase().trim();
        rows.forEach(function(row) {
            const cells = row.querySelectorAll("td");
            if (searchValue === "") {
                row.style.display = "";
                return;
            }
            let matchFound = false;
            cells.forEach(function(cell) {
                if (cell.textContent.toLowerCase().trim().indexOf(searchValue) !== -1) {
                    matchFound = true;
                }
            });
            if (matchFound) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
</script>
