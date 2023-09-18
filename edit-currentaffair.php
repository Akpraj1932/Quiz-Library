<?php


$type='5';
session_start();
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
    header("location:index.php");
    return false;
    exit();
}
include('library/crud.php');
include('library/functions.php');

$db = new Database();
$db->connect();

$fn = new Functions();
$config = $fn->get_configurations();

if (isset($config['system_timezone']) && !empty($config['system_timezone'])) {
    date_default_timezone_set($config['system_timezone']);
} else {
    date_default_timezone_set('Asia/Kolkata');
}
if (isset($config['system_timezone_gmt']) && !empty($config['system_timezone_gmt'])) {
    $db->sql("SET `time_zone` = '" . $config['system_timezone_gmt'] . "'");
} else {
    $db->sql("SET `time_zone` = '+05:30'");
}

$db->sql("SET NAMES 'utf8'");
$auth_username = $db->escapeString($_SESSION["username"]);

$toDate = date('Y-m-d');
$toDateTime = date('Y-m-d H:i:s');
$allowedExts = array("gif", "jpeg", "jpg", "png", "JPEG", "JPG", "PNG");

define('ALLOW_MODIFICATION', 1);
$id = $_GET['id'];
$where = 'WHERE s.id='.$id;  
    $left_join = " LEFT JOIN languages l on l.id = s.language_id ";
    $left_join .= " LEFT JOIN category c ON c.id = s.maincat_id ";
    $left_join .= " LEFT JOIN subcategory sub ON sub.id = s.subcategory_id ";

    $sql = "SELECT COUNT(s.id) as total FROM `currentaffair` s " . $left_join . " " . $where;
    $db->sql($sql);
    $res = $db->getResult();
    foreach ($res as $row) {
        $total = $row['total'];
    }

    $sql = "SELECT s.*, l.language, c.`category_name`,sub.`subcategory_name`,sub.`id` as subcategory_id " . $total_question . " FROM `currentaffair` s " . $left_join . " " . $where ;

    $db->sql($sql);
    $res = $db->getResult();

    $bulkData = array();
    $bulkData['total'] = $total;
    $rows = array();
    $tempRow = array();
    $i=1;
    foreach ($res as $row) {
        
        $id = $row['id'];
    
        $language_id = $row['language_id'];
        $language = $row['language'];
        $maincat_id = $row['maincat_id'];
        $category_name = $row['category_name'];
        $title = $row['title'];
        $detail = $row['description'];
        $subcategory_name = $row['subcategory_name'];
        $subcat_id = $row['subcategory_id'];
        
        $i=$i+1;
    }


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
              
                <!-- page content -->
                <div class="right_col" role="main">
                    <!-- top tiles -->
                    <br />
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Update Daily News</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    
                                    
                                    <div class='row'>
                                        <div class='col-md-12 col-sm-12'>
                                    <form id="category_form" method="POST" action="db_operations.php" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="novalidate">
                                            <input type="hidden" name="update_currentaffair" value="1">
                                            <input type="hidden" name="type" value="5">
                                            <input type="hidden" name="dailynews_id" value="<?=$_GET['id']?>">
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
                                                            <select id="language_id" name="language" required class="form-control">
                                                                <option value="<?=$language_id?>"><?=$language?></option>
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
                                                            <option value="<?=$maincat_id?>"><?=$category_name?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" for="maincat_id">Sub Category</label>
                                                    <div class="col-md-10 col-sm-6 col-xs-12">
                                                        <select id="subcat_id" name="subcat_id" required class="form-control">
                                                            <option value="<?=$subcat_id?>"><?=$subcategory_name?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                        <div class="form-group">
                                                <label class="control-label col-md-1 col-sm-3 col-xs-12" for="title">Title</label>
                                                <div class="col-md-10 col-sm-6 col-xs-12">
                                                    <input type="text" id="title" name="title" value='<?=$title?>' class="form-control" aria-required="true" required>
                                                </div>
                                            </div>
                                        <div class="form-group">
                                                <label class="control-label col-md-1 col-sm-3 col-xs-12" for="detail">Description</label>
                                                <div class="col-md-10 col-sm-6 col-xs-12">
                                                    <textarea id="detail" name="detail" class="form-control" required><?=$detail?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
                                                    <button type="submit" id="submit_btn" class="btn btn-success">Update Current Affair</button>
                                                </div>
                                            </div>
                                            </form>
                                            <div class="col-md-12"><hr></div>
                                        </div>                                       
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->
         
            <!-- footer content -->
            <?php include 'footer.php'; ?>
            <!-- /footer content -->
        </div>

        <!-- jQuery -->

        <script>
            var $table = $('#category_list');
            $('#toolbar').find('select').change(function () {
                $table.bootstrapTable('refreshOptions', {
                    exportDataType: $(this).val()
                });
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
                    console.log(language_id);
                    $.ajax({
                        type: 'POST',
                        url: "db_operations.php",
                        data: 'get_categories_of_language=1&language_id=' + language_id + '&type=' + type,
                        beforeSend: function () {
                            $('#maincat_id').html('Please wait..');
                        },
                        success: function (result) {
                            // alert(result);
                            console.log(result);
                            $('#maincat_id').html(result);
                        }
                    });
                });
                $('#maincat_id').on('change', function (e) {
                    var language_id = $('#maincat_id').val();
                    // console.log(language_id);
                    // console.log(type);
                    $.ajax({
                        type: 'POST',
                        url: "db_operations.php",
                        data: 'get_subcategories_of_categories=1&maincat_id=' + language_id + '&type=' + type,
                        beforeSend: function () {
                            $('#subcat_id').html('Please wait..');
                        },
                        success: function (result) {
                            // alert(result);
                            $('#subcat_id').html(result);
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
