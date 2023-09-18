<?php
session_start();
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
    header("location:index.php");
    return false;
    exit();
}
$type = '4';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Create and Manage Daily News | <?= ucwords($_SESSION['company_name']) ?> - Admin Panel </title>
        <?php include 'include-css.php'; ?>
    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <?php include 'sidebar.php'; ?>
                <!-- page content -->
                <div class="right_col" role="main">
                    <!-- top tiles -->
                    <br />
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Create Daily News</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class='row'>
                                        <div class='col-md-12 col-sm-12'>
                                                                                  <form id="category_form" method="POST" action="db_operations.php" data-parsley-validate="" class="form-horizontal form-label-left" enctype="multipart/form-data" novalidate="novalidate">
                                            <input type="hidden" name="adddailynews" value="1">
                                            <input type="hidden" name="type" value="4">
                                            <?php
                                            $db->sql("SET NAMES 'utf8'");
                                        $sql = "SELECT * FROM category WHERE type=" . $type . " ORDER BY id DESC";
                                        $db->sql($sql);
                                        $categories = $db->getResult();
                                             if ($fn->is_language_mode_enabled()) { ?>
                                                    <div class="form-group">
                                                        
                                                            <?php
                                                            $db->sql("SET NAMES 'utf8'");
                                                            $sql = "SELECT * FROM `languages` ORDER BY id DESC";
                                                            $db->sql($sql);
                                                            $languages = $db->getResult();
                                                            ?>
                                                            <label for="language_id" class="control-label col-md-1 col-sm-3 col-xs-12">Language</label>
                                                            <div class="col-md-10 col-sm-6 col-xs-12">
                                                            <select id="language_id" name="language_id" required class="form-control">
                                                                <option value="">Select language</option>
                                                                <?php foreach ($languages as $language) { ?>
                                                                    <option value='<?= $language['id'] ?>'><?= $language['language'] ?></option>
                                                                <?php } ?>
                                                            </select> 
                                                    </div>
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group">
                                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" for="maincat_id">Category</label>
                                                    <div class="col-md-10 col-sm-6 col-xs-12">
                                                        <select id="maincat_id" name="maincat_id" required class="form-control">
                                                            <option value="">Select Category</option>
                                                        </select>
                                                    </div>
                                                </div>
                                        <div class="form-group">
                                                <label class="control-label col-md-1 col-sm-3 col-xs-12" for="title">Title</label>
                                                <div class="col-md-10 col-sm-6 col-xs-12">
                                                    <input type="text" id="title" name="title" class="form-control" aria-required="true" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-1 col-sm-3 col-xs-12" for="title">Banner Image</label>
                                                <div class="col-md-10 col-sm-6 col-xs-12">
                                                    <input type="file" id="banner_image" name="image" class="form-control" aria-required="true" required accept="image/png, image/gif, image/jpeg">
                                                </div>
                                            </div>
                                        <div class="form-group">
                                                <label class="control-label col-md-1 col-sm-3 col-xs-12" for="detail">Description</label>
                                                <div class="col-md-10 col-sm-6 col-xs-12">
                                                    <textarea id="detail" name="detail" class="form-control" required></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
                                                    <button type="submit" id="submit_btn" class="btn btn-success">Create News</button>
                                                </div>
                                            </div>
                                            </form>
                                            <div class="col-md-12"><hr></div>
                                        </div>                                       
                                    </div>
                                    <div class="row">
                                        <div class='col-sm-12'>
                                            <h2>Categories <small>View / Update / Delete</small></h2>
                                            <?php if ($fn->is_language_mode_enabled()) { ?>
                                                <div class='col-md-4'>
                                                    <select id='filter_language' class='form-control' required>
                                                        <option value="">Select language</option>
                                                        <?php foreach ($languages as $language) { ?>
                                                            <option value='<?= $language['id'] ?>'><?= $language['language'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class='col-md-4'>
                                                    <button class='btn btn-primary btn-block' id='filter_btn'>Filter Category</button>
                                                </div>
                                            <?php } ?>
                                            <div class='col-md-12'><hr></div>
                                        </div>
                                        <div class='col-md-12 col-sm-12'>
                                            <?php
                                            $sql = "SELECT * FROM `languages` ORDER BY id DESC";
                                            $db->sql($sql);
                                            $languages = $db->getResult();
                                            ?>

                                            <div class='row'>
                                                <div id="toolbar">
                                                    <button class="btn btn-danger btn-sm" id="delete_multiple_categories" title="Delete Selected Categories"><em class='fa fa-trash'></em></button>
                                                </div> 

                                                <table aria-describedby="mydesc" class='table-striped' id='category_list'
                                                       data-toggle="table" data-url="get-list.php?table=dailynews"
                                                       data-click-to-select="true" data-side-pagination="server"
                                                       data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                                                       data-search="true" data-show-columns="true"
                                                       data-show-refresh="true" data-trim-on-search="false"
                                                       data-sort-name="row_order" data-sort-order="asc"
                                                       data-toolbar="#toolbar" data-mobile-responsive="true" data-maintain-selected="true"    
                                                       data-show-export="false" data-export-types='["txt","excel"]'
                                                       data-export-options='{
                                                            "fileName": "category-list-<?= date('d-m-y') ?>",
                                                            "ignoreColumn": ["state"]	
                                                       }'
                                                       data-query-params="queryParams">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" data-field="state" data-checkbox="true"></th>
                                                            <th scope="col" data-field="id" data-sortable="true" data-visible="false">ID</th>
                                                            <th scope="col" data-field="srno" data-sortable="true">ID</th>
                                                            <?php if ($fn->is_language_mode_enabled()) { ?>
                                                                <th scope="col" data-field="language_id" data-sortable="true" data-visible="false">Language ID</th>
                                                                <th scope="col" data-field="language" data-sortable="true">Language</th>
                                                            <?php } ?>
                                                            <th scope="col" data-field="row_order" data-visible='false' data-sortable="true">Order</th>
                                                            <th scope="col" data-field="category_name" data-sortable="true">Category Name</th>
                                                            <th scope="col" data-field="title" data-sortable="true">Title</th>
                                                        <th scope="col" data-field="detail" data-sortable="false" data-visible="false">Description</th>
                                                        <th scope="col" data-field="operate" data-events="actionEvents">Operate</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->
            <div class="modal fade" id='editCategoryModal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Daily News</h4>
                        </div>
                        <div class="modal-body">
                            <form id="update_form"  method="POST" action ="db_operations.php" data-parsley-validate class="form-horizontal form-label-left">
                                <input type='hidden' name="update_dailynews" id="update_dailynews" value='4'/>
                                <input type='hidden' name="subcategory_id" id="subcategory_id" value=''/>
                                <!--<input type='hidden' name="image_url" id="image_url" value=''/>-->
                                <?php if ($fn->is_language_mode_enabled()) { ?>
                                    <div class="form-group">
                                        <label class="" for="update_language_id">Language</label>
                                        <select id="update_language_id" name="language_id" required class="form-control">
                                            <option value="">Select language</option>
                                            <?php foreach ($languages as $language) { ?>
                                                <option value='<?= $language['id'] ?>'><?= $language['language'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label class="" for="update_maincat_id">Main Category</label>
                                <select id="update_maincat_id" name="maincat_id" required class="form-control">
                                    <option value=''>Select Main Category</option>
                                    <?php foreach ($categories as $row) { ?>
                                            <option value='<?= $row['id'] ?>'><?= $row['category_name'] ?></option>
                                        <?php } ?>
                                </select>
                                </div>
                               
                                <div class="form-group">
                                    <label class="" for="update_title">Title</label>
                                    <input type="text" name="update_title" id="update_title" class="form-control">
                                </div>
                                <div class="form-group">
                                                <label for="update_detail">Description</label>
                                                <div class="col-md-12 col-sm-12">
                                                    <textarea id="update_detail" name="detail" class="form-control" required></textarea>
                                                </div>
                                            </div>
                                <div class="form-group"
                                <input type="hidden" id="id" name="id">
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" id="update_btn" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </form>
                            <div class="row"><div  class="col-md-offset-3 col-md-8" style ="display:none;" id="update_result"></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- footer content -->
            <?php include 'footer.php'; ?>
            <!-- /footer content -->
        </div>

        <!-- jQuery -->

        <script>
            $('#filter_btn').on('click', function (e) {
                $('#category_list').bootstrapTable('refresh');
            });
            $('#delete_multiple_categories').on('click', function (e) {
                sec = 'dailynews';
                is_image = 1;
                table = $('#category_list');
                delete_button = $('#delete_multiple_categories');
                selected = table.bootstrapTable('getAllSelections');

                ids = "";
                $.each(selected, function (i, e) {
                    ids += e.id + ",";
                });
                ids = ids.slice(0, -1); // removes last comma character

                if (ids == "") {
                    alert("Please select some categories to delete!");
                } else {
                        $.ajax({
                            type: 'GET',
                            url: "db_operations.php",
                            data: 'delete_multiple=1&ids=' + ids + '&sec=' + sec + '&is_image=' + is_image+'&type='+<?=$type?>,
                            beforeSend: function () {
                                delete_button.html('<i class="fa fa-spinner fa-pulse"></i>');
                            },
                            success: function (result) {
                                if (result == 1) {
                                    table.bootstrapTable('refresh');
                                } else {

                                    alert("Could not delete Categories. Try again!");
                                }
                                console.log(result);
                                delete_button.html('<i class="fa fa-trash"></i>');
                                table.bootstrapTable('refresh');
                            }
                        });
                    
                }
            });
        </script>
        <script>
            var $table = $('#category_list');
            $('#toolbar').find('select').change(function () {
                $table.bootstrapTable('refreshOptions', {
                    exportDataType: $(this).val()
                });
            });
        </script>

        <script>
            window.actionEvents = {
                'click .edit-category': function (e, value, row, index) {
                    // alert('You click remove icon, row: ' + JSON.stringify(row));
                    // var regex = /<img.*?src="(.*?)"/;
                    // var src = regex.exec(row.image)[1];
<?php if ($fn->is_language_mode_enabled()) { ?>
                        $('#update_language_id').val(row.language_id);
<?php } ?>
                    
                    $('#update_maincat_id').html(category_options);
                    $('#update_maincat_id').val(row.category_name);
                    $('#update_title').val(row.title);
                    // $('#image_url').val(src);
                    id = $(this).data("id");
                    $('#subcategory_id').val(id);
                    var detail = tinyMCE.get('update_detail').setContent(row.detail);
                $('#edit_detail').val(detail);
                    console.log(row.id);
                    console.log(row);
                }
            };
        </script>
        <script>
            $('#update_form').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                if ($("#update_form").validate().form()) {
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: formData,
                        beforeSend: function () {
                            $('#update_btn').html('Please wait..');
                        },
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (result) {
                            $('#update_result').html(result);
                            $('#update_result').show().delay(3000).fadeOut();
                            $('#update_btn').html('Update');
                            $('#update_image').val('');
                            // $('#update_form')[0].reset();
                            $('#category_list').bootstrapTable('refresh');
                            setTimeout(function () {
                                $('#editCategoryModal').modal('hide');
                            }, 4000);
                        }
                    });
                }
            });
        </script>
        <script>
            function queryParams(p) {
                return {
                    "language": $('#filter_language').val(),
                    type:<?= $type ?>,
                    limit: p.limit,
                    sort: p.sort,
                    order: p.order,
                    offset: p.offset,
                    search: p.search
                };
            }
        </script>
        <script>
            $('#category_form').validate({
                rules: {
                    name: "required"
                }
            });
        </script>
        <script>
            $('#category_form').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                if ($("#category_form").validate().form()) {
                        $.ajax({
                            type: 'POST',
                            url: $(this).attr('action'),
                            data: formData,
                            beforeSend: function () {
                                $('#submit_btn').html('Please wait..');
                            },
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (result) {
                                $('#result').html(result);
                                $('#result').show().delay(4000).fadeOut();
                                $('#submit_btn').html('Submit');
                                $('#category_form')[0].reset();
                                $('#category_list').bootstrapTable('refresh');
                            }
                        });
                    
                }
            });
        </script>
        <!--<script>-->
        <!--    $(document).on('click', '.delete-category', function () {-->
        <!--        if (confirm('Are you sure? Want to delete category? All related questions and sub categories will also be deleted')) {-->
        <!--            id = $(this).data("id");-->
        <!--            image = $(this).data("image");-->
        <!--            $.ajax({-->
        <!--                url: 'db_operations.php',-->
        <!--                type: "get",-->
        <!--                data: 'id=' + id + '&image=' + image + '&delete_category=1',-->
        <!--                success: function (result) {-->
        <!--                    if (result == 1) {-->
        <!--                        $('#category_list').bootstrapTable('refresh');-->
        <!--                    } else-->
        <!--                        alert('Error! Category could not be deleted');-->
        <!--                }-->
        <!--            });-->
        <!--        }-->
        <!--    });-->
        <!--</script>-->
        <script>
            var $table = $('#category_list');
            $('#toolbar').find('select').change(function () {
                $table.bootstrapTable('refreshOptions', {
                    exportDataType: $(this).val()
                });
            });
        </script>
              
       
        <!-- <script>-->
        <!--    $('#category_form').on('submit', function (e) {-->
        <!--        e.preventDefault();-->
        <!--        var formData = new FormData(this);-->
        <!--        if ($("#category_form").validate().form()) {-->
                    
        <!--                $.ajax({-->
        <!--                    type: 'POST',-->
        <!--                    url: $(this).attr('action'),-->
        <!--                    data: formData,-->
        <!--                    beforeSend: function () {-->
        <!--                        $('#submit_btn').html('Please wait..');-->
        <!--                    },-->
        <!--                    cache: false,-->
        <!--                    contentType: false,-->
        <!--                    processData: false,-->
        <!--                    success: function (result) {-->
        <!--                        $('#result').html(result);-->
        <!--                        $('#result').show().delay(4000).fadeOut();-->
        <!--                        $('#submit_btn').html('Submit');-->
        <!--                        $('#category_form')[0].reset();-->
        <!--                        $('#category_list').bootstrapTable('refresh');-->
        <!--                    }-->
        <!--                });-->
                    
        <!--        }-->
        <!--    });-->
        <!--</script>-->
         <script>
var type=<?= $type ?>;
<?php if ($fn->is_language_mode_enabled()) { ?>
                $('#language_id').on('change', function (e) {
                    var language_id = $('#language_id').val();
                    $.ajax({
                        type: 'POST',
                        url: "db_operations.php",
                        data: 'get_categories_of_language=1&language_id=' + language_id + '&type=' + type,
                        beforeSend: function () {
                            $('#maincat_id').html('Please wait..');
                        },
                        success: function (result) {
                            // alert(result);
                            $('#maincat_id').html(result);
                        }
                    });
                });
                $('#update_language_id').on('change', function (e) {
                    var language_id = $('#update_language_id').val();
                    $.ajax({
                        type: 'POST',
                        url: "db_operations.php",
                        data: 'get_categories_of_language=1&language_id=' + language_id + '&type=' + type,
                        beforeSend: function () {
                            $('#update_maincat_id').html('Please wait..');
                        },
                        success: function (result) {
                            // alert(result);
                            $('#update_maincat_id').html(result);
                        }
                    });
                });
                           category_options = '';
    <?php
    $category_options = "<option value=''>Select Options</option>";
    foreach ($categories as $category) {
        $category_options .= "<option value='" . $category['id'] . "'>" . $category['category_name'] . "</option>";
    }
    ?>
                category_options = "<?= $category_options; ?>";

<?php } ?>
        </script>
            <script type="text/javascript">
        $(document).ready(function () {
            tinymce.init({
                selector: '#detail',
                height: 150,
                menubar: true,
                plugins: [
                    'advlist autolink lists charmap print preview anchor textcolor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime table contextmenu paste code help wordcount'
                ],
                toolbar: 'insert | undo redo |  formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
                setup: function (editor) {
                    editor.on("change keyup", function (e) {
                        editor.save();
                        $(editor.getElement()).trigger('change');
                    });
                }
            });
        });
    </script>
                <script type="text/javascript">
        $(document).on('focusin', function (e) {
            if ($(event.target).closest(".mce-window").length) {
                e.stopImmediatePropagation();
            }
        });
        tinymce.init({
            selector: '#update_detail',
            height: 150,
            menubar: true,
            plugins: [
                'advlist autolink lists charmap print preview anchor textcolor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime table contextmenu paste code help wordcount'
            ],
            toolbar: 'insert | undo redo |  formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            setup: function (editor) {
                editor.on("change keyup", function (e) {
                    editor.save();
                    $(editor.getElement()).trigger('change');
                });
            }
        });
    </script>
    <script>
            $(document).on('click', '.delete-subcategory', function () {
                    id = $(this).data("id");
                    image = $(this).data("image");
                    $.ajax({
                        url: 'db_operations.php',
                        type: "get",
                        data: 'id=' + id + '&image=' + image + '&delete_dailynews=1&type='+<?=$type?>,
                        success: function (result) {
                            if (result == 1) {
                                $('#category_list').bootstrapTable('refresh');
                            } else
                                alert('Error! Category could not be deleted');
                        }
                    });
                
            });
        </script>
        <script>
            function queryParams(p) {
                return {
                    "language": $('#filter_language').val(),
                    type:<?= $type ?>,
                    limit: p.limit,
                    sort: p.sort,
                    order: p.order,
                    offset: p.offset,
                    search: p.search
                };
            }
        </script>
        <script>
            $('#delete_multiple_subcategories').on('click', function (e) {
                sec = 'dailynews';
                is_image = 1;
                table = $('#category_list');
                delete_button = $('#delete_multiple_subcategories');
                selected = table.bootstrapTable('getAllSelections');
                // alert(selected[0].id);
                ids = "";
                $.each(selected, function (i, e) {
                    ids += e.id + ",";
                });
                ids = ids.slice(0, -1); // removes last comma character
                if (ids == "") {
                    alert("Please select some subcategories to delete!");
                } else {
                        $.ajax({
                            type: 'GET',
                            url: "db_operations.php",
                            data: 'delete_multiple=1&ids=' + ids + '&sec=' + sec + '&is_image=' + is_image +'&type='+<?=$type?>,
                            beforeSend: function () {
                                delete_button.html('<i class="fa fa-spinner fa-pulse"></i>');
                            },
                            success: function (result) {

                                if (result == 1) {
                                    table.bootstrapTable('refresh');
                                } else {

                                    alert("Could not delete subcategories. Try again!");
                                    
                                }
                                delete_button.html('<i class="fa fa-trash"></i>');
                                table.bootstrapTable('refresh');
                            }
                        });
                    
                }
            });
        </script>
       
     <script>
            $('#update_form').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                if ($("#update_form").validate().form()) {
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: formData,
                        beforeSend: function () {
                            $('#update_btn').html('Please wait..');
                        },
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (result) {
                            $('#update_result').html(result);
                            $('#update_result').show().delay(3000).fadeOut();
                            $('#update_btn').html('Update');
                            $('#update_image').val('');
                            // $('#update_form')[0].reset();
                            $('#category_list').bootstrapTable('refresh');
                            setTimeout(function () {
                                $('#editCategoryModal').modal('hide');
                            }, 4000);
                        }
                    });
                }
            });
        </script>
          <script>
        $(document).ready(function(){
            
        
            $('#update_btn').on('click',function(){
              $tr = $(this).closest('tr');
              var data = $tr.children("th").map(function(){
                  return $(this).text();
              }).get();
              console.log(data);
            });
        });
        </script>
    </body>
</html>