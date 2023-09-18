<?php
session_start();
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
    header("location:index.php");
    return false;
    exit();
}
$type = 3;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Questions for Quiz | <?= ucwords($_SESSION['company_name']) ?> - Admin Panel </title>
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
                                    <h2>Questions for Quiz <small>Create New Question</small></h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="row">
                                        <form id="register_form" method="POST" action="addebook.php" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="novalidate" enctype="multipart/form-data">
                                            <h4 class="col-md-offset-1"><strong>Create a Question</strong></h4>
                                            <input type="hidden" id="add_question" name="add_question" required="" value="3" aria-required="true">
                                            <?php
                                            $db->sql("SET NAMES 'utf8'");
                                            if ($fn->is_language_mode_enabled()) {
                                                ?>
                                                <div class="form-group">
                                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" for="category">Language</label>
                                                    <div class="col-md-10 col-sm-6 col-xs-12">
                                                        <?php
                                                        $sql = "SELECT * FROM `languages` ORDER BY id DESC";
                                                        $db->sql($sql);
                                                        $languages = $db->getResult();
                                                        ?>
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
                                                <label class="control-label col-md-1 col-sm-3 col-xs-12" for="category">Category</label>
                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                    <select name='category' id='cat' class='form-control' required>
                                                        <option value=''>Select Main Category</option>
                                            
                                                    </select>
                                                </div>
                                                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="subcategory">Sub Category</label>
                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                    <select name='subcategory' id='subcategory' class='form-control' >
                                                        <option value=''>Select Sub Category</option>
                                                    </select>
                                                </div>

                                            </div>
                                             <div class="form-group">
                                                <label class="control-label col-md-1 col-sm-3 col-xs-12" for="sub_2category">Sub Category 2</label>
                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                    <select name='sub_2category' id='sub_2category' class='form-control' required>
                                                        <option value=''>Select Sub Category 2</option>
                                                    </select>
                                                </div>
                                                
                                                
                                                
                                                <!--<label class="control-label col-md-2 col-sm-3 col-xs-12" for="sub_3category">Sub Category 3</label>-->
                                                <!--<div class="col-md-4 col-sm-6 col-xs-12">-->
                                                <!--    <select name='sub_3category' id='sub_3category' class='form-control' >-->
                                                <!--        <option value=''>Select Sub Category 3</option>-->
                                                <!--    </select>-->
                                                <!--</div>-->
                                                
                                            </div>
                                            
                                             <div class="form-group">
                                                <label class="control-label col-md-1 col-sm-3 col-xs-12" for="title">Title</label>
                                                <div class="col-md-10 col-sm-6 col-xs-12">
                                                    <input type="text" id="title" name="title" class="form-control" aria-required="true" required>
                                                </div>
                                            </div>
                                            
                                        <div class="form-group">
                                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" for="updf">Upload Ebook PDF</label>
                                                    <div class="col-md-10 col-sm-6 col-xs-12">
                                                    <input type="file" id="upload_file" name="uploadfile" class="form-control" aria-required="true" required><span id="span"></span>
                                                </div>
                                                </div>
                                        
                                                
                                            </div>
                                          
                                            

                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
                                                    <button type="submit" id="submit_b" class="btn btn-success">Create EBook</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div  class="col-md-offset-3 col-md-4" style ="display:none;" id="result">
                                                </div>
                                            </div>
                                        </form>
                                        <div class="col-md-12"><hr></div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <h2>Questions of Quiz <small>View / Update / Delete</small></h2>
                                        </div>
                                        <div class='col-md-12'>
                                            <?php if ($fn->is_language_mode_enabled()) { ?>
                                                <div class='col-md-2'>
                                                    <select id='filter_language' class='form-control' required>
                                                        <option value="">Select language</option>
                                                        <?php foreach ($languages as $language) { ?>
                                                            <option value='<?= $language['id'] ?>'><?= $language['language'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class='col-md-2'>
                                                    <select id='filter_category' class='form-control' required>
                                                        <option value=''>Select Main Category</option>
                                                    </select>
                                                </div>
                                            <?php } else { ?>
                                                <div class='col-md-2'>
                                                    <select id='filter_category' class='form-control' required>
                                                        <option value=''>Select Main Category</option>
                                                        <?php foreach ($categories as $row) { ?>
                                                            <option value='<?= $row['id'] ?>'><?= $row['category_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            <?php } ?>
                                            <div class='col-md-2'>
                                                <select id='filter_subcategory' class='form-control' required>
                                                    <option value=''>Select Sub Category</option>
                                                </select>
                                            </div>
                                            <div class='col-md-2'>
                                                <select id='filter_sub_2category' class='form-control' required>
                                                    <option value=''>Select Sub 2 Category</option>
                                                </select>
                                            </div>

                                            <div class='col-md-4'>
                                                <button class='btn btn-primary btn-block' id='filter_btn'>Filter Questions</button>
                                            </div>
                                        </div>
                                        <div class='col-md-12'><hr></div>
                                    </div>
                                   <div class='col-md-12'>
                                            <div class='row'>
                                                <div id="toolbar">
                                                    <button class="btn btn-danger btn-sm" id="delete_multiple_categories" title="Delete Selected Categories"><em class='fa fa-trash'></em></button>
                                                </div> 

                                                <table aria-describedby="mydesc" class='table-striped' id='category_list'
                                                       data-toggle="table" data-url="get-list.php?table=ebook"
                                                       data-click-to-select="true" data-side-pagination="server"
                                                       data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                                                       data-search="true" data-show-columns="true"
                                                       data-show-refresh="true" data-trim-on-search="false"
                                                       data-sort-name="id" data-sort-order="asc"
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
                                                            <th scope="col" data-field="srno">ID</th>
                                                            <?php if ($fn->is_language_mode_enabled()) { ?>
                                                                <th scope="col" data-field="language_id" data-sortable="true" data-visible="false">Language ID</th>
                                                                <th scope="col" data-field="language" data-sortable="true">Language</th>
                                                            <?php } ?>
                                                            <th scope="col" data-field="row_order" data-visible='false' data-sortable="true">Order</th>
                                                            <th scope="col" data-field="category_name" data-sortable="true">Main Category </th>
                                                            <th scope="col" data-field="subcategory_name" data-sortable="true">Subcategory</th>
                                                            <th scope="col" data-field="sub_2cat_name" data-sortable="true">Sub2Category</th>
                                                            <th scope="col" data-field="title" data-sortable="true">Title</th>
                                                            <!--<th scope="col" data-field="pdf" data-sortable="false">PDF File</th>-->
                                                            <!--<th scope="col" data-field="no_of_que" data-sortable="false">Total Question</th>-->
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
            <!-- /page content -->
            <div class="modal fade" id='editCategoryModal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Question Details</h4>
                        </div>
                        <div class="modal-body">
                            <form id="update_form"  method="POST" action ="db_operations.php" data-parsley-validate class="form-horizontal form-label-left">
                                <input type='hidden' name="ebook_id" id="ebook_id" value=''/>
                                <input type='hidden' name="update_ebook" id="update_ebook" value='1'/>
                                <input type='hidden' name="image_url" id="image_url" value=''/>
                                <?php
                                $db->sql("SET NAMES 'utf8'");
                                if ($fn->is_language_mode_enabled()) {
                                    ?>
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-3 col-xs-12" for="category">Language</label>
                                        <div class="col-md-10 col-sm-6 col-xs-12">
                                            <?php
                                            $sql = "SELECT * FROM `languages` ORDER BY id DESC";
                                            $db->sql($sql);
                                            $languages = $db->getResult();
                                            ?>
                                            <select id="update_language_id" name="language_id" required class="form-control col-md-7 col-xs-12">
                                                <option value="">Select language</option>
                                                <?php foreach ($languages as $language) { ?>
                                                    <option value='<?= $language['id'] ?>'><?= $language['language'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" for="category">Category</label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <select name='category' id='edit_category' class='form-control' required>
                                            <option value=''>Select Main Category</option>
                                            <?php foreach ($categories as $row) { ?>
                                                <option value='<?= $row['id'] ?>'><?= $row['category_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="subcategory">Sub Category</label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <select name="subcategory" id="edit_subcategory" class="form-control" >
                                            <option value="">Select Sub Category</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" for="category">Sub 2 Category</label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <select name='sub_2category' id='edit_sub_2category' class='form-control' required>
                                            <option value=''>Select Sub 2 Category</option>
                                            
                                        </select>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-3 col-xs-12" for="title">Title</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" name="title" id="edit_title" class="form-control" required>
                                        </div>
                                    </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" id="update_btn" class="btn btn-success">Update Ebook</button>
                                    </div>
                                </div>
                            </form>
                            <div class="row"><div  class="col-md-offset-3 col-md-8" style ="display:none;" id="update_result"></div></div>
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
            window.actionEvents = {
                'click .edit-subcategory': function (e, value, row, index) {
                    // alert('You click remove icon, row: ' + JSON.stringify(row));
                    var regex = /<img.*?src="(.*?)"/;
                    var src = regex.exec(row.image)[1];
                    $("input[name=status][value=1]").prop('checked', true);
                    if ($(row.status).text() == 'Deactive')
                        $("input[name=status][value=0]").prop('checked', true);
       
                    $('#ebook_id').val(row.id);
                    // $('#edit_sub_2category').val(row.sub_2cat_name);
                    $('#edit_title').val(row.title);
                    $('#update_maincat_id').val(row.category_name);
                    $('#update_subcategory_id').val(row.subcategory_name);
<?php if ($fn->is_language_mode_enabled()) { ?>
                        if (row.language_id == 0) {
                            $('#update_language_id').val(row.language_id);
                            $('#edit_category').html(category_options);
                            $('#edit_category').val(row.category_name);
                        } else {
                            $('#update_language_id').val(row.language_id).trigger("change", [row.language_id, row.maincat_id]);
                        }
<?php } else { ?>
                        $('#update_maincat_id').val(row.maincat_id);
<?php } ?>
                    // $('#update_sub_2cat').val(row.sub_2category_name);
                    // $('#image_url').val(src);
                }
            };
        </script>


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
                $('#maincat_id').on('change',function(e){
                  var maincat_id = $('#maincat_id').val();
                  $.ajax({
                     type:'POST',
                     url:"db_operations.php",
                     data: 'get_subcategories_of_categories=1&maincat_id='+maincat_id+'&type='+type,
                     beforeSend:function(){
                         $('#subcat_id').html('Please Wait..');
                     },
                     success:function(result){
                         $('#subcat_id').html(result);
                     }
                  });
                });
                 $('#edit_category').on('change',function(e){
                  var maincat_id = $('#edit_category').val();
                  $.ajax({
                     type:'POST',
                     url:"db_operations.php",
                     data: 'get_subcategories_of_categories=1&maincat_id='+maincat_id+'&type='+type,
                     beforeSend:function(){
                         $('#edit_subcategory').html('Please Wait..');
                     },
                     success:function(result){
                         $('#edit_subcategory').html(result);
                        //  console.log(result);
                     }
                  });
                });
                $('#update_language_id').on('change', function (e, row_language_id, row_category) {
                    var language_id = $('#update_language_id').val();
                    $.ajax({
                        type: 'POST',
                        url: "db_operations.php",
                        data: 'get_categories_of_language=1&language_id=' + language_id + '&type=' + type,
                        beforeSend: function () {
                            $('#edit_category').html('Please wait..');
                        },
                        success: function (result) {
                            $('#edit_category').html(result).trigger("change");
                            //alert(row_language_id);
                            if (language_id == row_language_id && row_category != 0)
                                $('#edit_category').val(row_category).trigger("change", [row_category]);
                        }
                    });
                });
                $('#filter_language').on('change', function (e) {
                    var language_id = $('#filter_language').val();
                    $.ajax({
                        type: 'POST',
                        url: "db_operations.php",
                        data: 'get_categories_of_language=1&language_id=' + language_id + '&type=' + type,
                        beforeSend: function () {
                            $('#filter_category').html('<option>Please wait..</option>');
                        },
                        success: function (result) {
                            $('#filter_category').html(result);
                        }
                    });
                });
                $('#language_id').on('change', function (e) {
                    var language_id = $('#language_id').val();
                    $.ajax({
                        type: 'POST',
                        url: "db_operations.php",
                        data: 'get_categories_of_language=1&language_id=' + language_id + '&type=' + type,
                        beforeSend: function () {
                            $('#cat').html('<option>Please wait..</option>');
                        },
                        success: function (result) {
                            $('#cat').html(result);
                        }
                    });
                });
                $('#filter_category').on('change', function (e) {
                    var language_id = $('#filter_language').val();
                    var cat_id = $('#filter_category').val();
                    // console.log(cat_id);
                    $.ajax({
                        type: 'POST',
                        url: "db_operations.php",
                        data: 'get_subcategories_of_language=1&language_id=' + language_id + '&type=' + type +'&category='+cat_id,
                        beforeSend: function () {
                            $('#filter_subcategory').html('<option>Please wait..</option>');
                        },
                        success: function (result) {
                            $('#filter_subcategory').html(result);
                        }
                    });
                });
                $('#filter_subcategory').on('change', function (e) {
                    var language_id = $('#filter_language').val();
                    var cat_id = $('#filter_subcategory').val();
                    // console.log(cat_id);
                    $.ajax({
                        type: 'POST',
                        url: "db_operations.php",
                        data: 'get_sub_2categories_of_subcategory=1&language_id=' + language_id + '&type=' + type +'&subcategory_id='+cat_id,
                        beforeSend: function () {
                            $('#filter_sub_2category').html('<option>Please wait..</option>');
                        },
                        success: function (result) {
                            $('#filter_sub_2category').html(result);
                        }
                    });
                });
                $('#cat').on('change', function (e) {
                    var language_id = $('#language_id').val();
                    var cat_id = $('#cat').val();
                    // console.log(cat_id);
                    $.ajax({
                        type: 'POST',
                        url: "db_operations.php",
                        data: 'get_subcategories_of_language=1&language_id=' + language_id + '&type=' + type +'&category='+cat_id,
                        beforeSend: function () {
                            $('#subcategory').html('<option>Please wait..</option>');
                        },
                        success: function (result) {
                            $('#subcategory').html(result);
                        }
                    });
                });
                $('#subcategory').on('change', function (e) {
                    var language_id = $('#language_id').val();
                    var cat_id = $('#subcategory').val();
                    // console.log(cat_id);
                    $.ajax({
                        type: 'POST',
                        url: "db_operations.php",
                        data: 'get_sub_2categories_of_language=1&language_id=' + language_id + '&type=' + type +'&category='+cat_id,
                        beforeSend: function () {
                            $('#sub_2category').html('<option>Please wait..</option>');
                        },
                        success: function (result) {
                            $('#sub_2category').html(result);
                        }
                    });
                });
                $('#edit_subcategory').on('change', function (e) {
                    var language_id = $('#update_language_id').val();
                    var cat_id = $('#edit_subcategory').val();
                    // console.log(cat_id);
                    $.ajax({
                        type: 'POST',
                        url: "db_operations.php",
                        data: 'get_sub_2categories_of_language=1&language_id=' + language_id + '&type=' + type +'&category='+cat_id,
                        beforeSend: function () {
                            $('#edit_sub_2category').html('<option>Please wait..</option>');
                        },
                        success: function (result) {
                            $('#edit_sub_2category').html(result);
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
        <script>
            $(document).on('click', '.delete-subcategory', function () {
                    id = $(this).data("id");
                    image = $(this).data("image");
                    $.ajax({
                        url: 'db_operations.php',
                        type: "get",
                        data: 'id=' + id + '&image=' + image + '&delete_ebook=1&type='+<?=$type?>,
                        success: function (result) {
                            if (result == 1) {
                                $('#category_list').bootstrapTable('refresh');
                            } else
                                alert('Error! Category could not be deleted');
                                // console.log(result);
                        }
                    });
                
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
            function queryParams(p) {
                return {
                    "language": $('#filter_language').val(),
                    "category": $('#filter_category').val(),
                    "subcategory" : $('#filter_subcategory').val(),
                    "sub_2category" : $('#filter_sub_2category').val(),
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
            $('#filter_btn').on('click', function (e) {
                $('#category_list').bootstrapTable('refresh');
            });
        </script>
        <script>
            $('#category_form').validate({
                rules: {
                    name: "required",
                    maincat_id: "required"
                }
            });
        </script>
       <!-- <script>
            $('#category_form').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                if ($("#category_form").validate().form()) {
                    if (confirm('Are you sure? Want to create Sub-Category 2')) {
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
                }
            });
        </script>-->

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
            $('#delete_multiple_categories').on('click', function (e) {
                sec = 'ebook';
                is_image = 1;
                table = $('#category_list');
                delete_button = $('#delete_multiple_categories');
                selected = table.bootstrapTable('getAllSelections');
                // alert(selected[0].id);
                ids = "";
                $.each(selected, function (i, e) {
                    ids += e.id + ",";
                });
                ids = ids.slice(0, -1); // removes last comma character
                        $.ajax({
                            type: 'GET',
                            url: "db_operations.php",
                            data: 'delete_multiple=1&ids=' + ids + '&sec=' + sec + '&is_image=' + is_image + '&type='+<?=$type?>,
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
                    
                // }
            });
        </script>
        // <script>
        //      $(document).ready(function(){
        //       $("#filter_language").on('change',function(){
        //         var filter_language=$(this).val();

        //         $.ajax({
        //           method:"POST",
        //           url:"getsubcategory.php",
        //           data:"lzcategory=1&id="+filter_language,
        //           dataType:"html",
        //           success:function(data){
        //               $("#filter_category").html(data);
        //           }
        //         });
        //       });  
        //     });
        // </script>
        // <script>
        //      $(document).ready(function(){
        //       $("#language_id").on('change',function(){
        //         var filter_language=$(this).val();
        //         var type=<?=$type?>;
        //         $.ajax({
        //           method:"POST",
        //           url:"getsubcategory.php",
        //           data:"getlzsubcategory=1&id="+filter_language+"&type="+type,
        //           dataType:"html",
        //           success:function(data){
        //               $("#subcategory_id").html(data);
        //           }
        //         });
        //       });  
        //     });
        // </script>
        //           <script>
        //      $(document).ready(function(){
        //          var type=<?= $type?>;
        //         $.ajax({
        //           method:"POST",
        //           url:"getsubcategory.php",
        //           data:"getlzsub_2_category=1&type="+type,
        //           dataType:"html",
        //           success:function(data){
        //               $("#getlzsub_2category").html(data);
        //           }
        //         });
        //     });
        // </script>
   <!--<script>-->
   <!--         $(document).ready(function(){-->
   <!--             var type=<?=$type?>;-->
   <!--           $("#delete_multiple_sub_2cat").on('click',function(){-->
   <!--             if (confirm("Are you sure you want to delete all  subcategory 2 ?")){-->
   <!--             $.ajax({-->
   <!--                method:"POST",-->
   <!--                url:"deletebook.php",-->
   <!--                data:"delete_ebook_sub_2cat=1&type="+type,-->
   <!--                datatype:"html",-->
   <!--                success:function(data){-->
   <!--                 $("#getlzsub_2category").html(data);-->
   <!--                }-->
   <!--             });-->
   <!--         }-->
   <!--           });  -->
   <!--         });-->
   <!--     </script>-->

    </body>
</html>