<?php
include('library/crud.php');
include('library/functions.php');
$db = new Database();
$db->connect();
if(isset($_GET['deletebook'])){
$id=$_GET['id'];
$sql="delete from `ebook` where id='$id'";
if($db->sql($sql)){
    echo "<script>alert('Ebook deleted successfully.');location.href='ebook.php';</script>";
}
else{
    echo "<script>alert('Ebook not deleted successfully.');location.href='ebook.php';</script>";
}
}
if(isset($_GET['deletesub_3cat'])){
    $type=$_GET['type'];
    $id=$_GET['id'];
    $sql="delete from sub_3category where id='$id' and type='$type'";
    if($db->sql($sql)){
        echo "<script>alert('Sub 3 Category Deleted Successfully.');location.href='sub-3category.php';</script>";
    }
    else{
        echo "<script>alert('Sub 3 Category not Deleted Successfully.');location.href='sub-3category.php';</script>";
    }
}
//Delete Daily News 
if(isset($_GET['deletenews'])){
    $id=$_GET['id'];
    $sql="delete from dailynews where id='$id'";
    if($db->sql($sql)){
        echo "<script>alert('Daily News Deleted Successfully.');location.href='daily-news.php';</script>";
    }
    else{
        echo "<script>alert('Daily News Not Deleted.');location.href='daily-news.php';</script>";
    }
}
//delete current affair 
if(isset($_GET['deletecurrentaffair'])){
    $id=$_GET['id'];
    $sql="delete from currentaffair where id='$id'";
    if($db->sql($sql)){
        echo "<script>alert('Current Affair Deleted Successfully.');location.href='currentaffair.php';</script>";
    }
    else{
        echo "<script>alert('Current Affair Not Deleted.');location.href='currentaffair.php';</script>";
    }
}
if(isset($_GET['deletesub_2cat'])){
    $id=$_GET['id'];
    $type=$_GET['type'];
    $sql="delete from sub_2category where id='$id' and type='$type'";
    if($db->sql($sql)){
        $sql="delete from sub_3category where sub_2category_id='$id' and type='$type'";
        if($db->sql($sql)){
            echo "<script>alert('Sub 2 Category Deleted Successfully.');location.href='sub-2category.php';</script>";
        }
        else{
            echo "<script>alert('Sub 2 Category Deleted Successfully.');location.href='sub-2category.php';</script>";
        }
    }
    else{
        echo "<script>alert('Sub 2 Category Deleted Successfully.');location.href='sub-2category.php';</script>";
    }
}
if(isset($_GET['delete_ebook_sub_3category'])){
    $id=$_GET['id'];
    $type=$_GET['type'];
    $sql="delete from sub_3category where id='$id' and type='$type'";
    if($db->sql($sql)){
        if($type==3){
            echo "<script>alert('Sub 3 Category Of Ebook Deleted Successfully.');location.href='ebooksub_3cat.php';</script> ";
        }
        else{
            echo "<script>alert('Sub 3 Category Of Ebook Deleted Successfully.');location.href='lzsub_3category.php';</script> ";
        }
    }
    else{
        echo "<script>alert('Sub 3 Category Of Ebook Not Deleted.');location.href='ebooksub_3cat.php';</script> ";
    }
}
if(isset($_GET['delete_ebook_sub_2category'])){
    $id=$_GET['id'];
    $type=$_GET['type'];
    $sql="delete from sub_2category where id='$id' and type='$type'";
    if($db->sql($sql)){
        $sql1="delete from sub_3category where sub_2category_id='$id' and type='$type'";
        if($db->sql($sql1)){
            if($type==3){
                echo "<script>alert('Sub 2 Category of Ebook Deleted Successfully.');location.href='ebooksub_2cat.php';</script>";
            }
            else{
                echo "<script>alert('Sub 2 Category of Ebook Deleted Successfully.');location.href='lzsub_2category.php';</script>";
            }
        }
    }
    else{
       echo "<script>alert('Sub 2 Category of Ebook Not Deleted.');location.href='ebooksub_2cat.php';</script>"; 
    }
}
if(isset($_GET['delete_subcategory'])){
    $id=$_GET['id'];
    $type=$_GET['type'];
    $sql="delete from subcategory where id='$id' and type='$type'";
    if($db->sql($sql)){
        $sql="select * from sub_2category where subcategory_id='$id' and type='$type'";
        $db->sql($sql);
        $res=$db->getResult();
        foreach($res as $sub2id){
            $sub_2_id=$sub2id['id'];
            $sql="delete from sub_2category where subcategory_id='$id' and type='$type'";
            if($db->sql($sql)){
                  $sql="delete from sub_3category where sub_2category_id='$sub_2_id' and type='$type'";
                  if($db->sql($sql)){
                      if($type==3){
                          echo "<script>alert('SubCategory of Ebook Deleted Successfully.');location.href='ebooksubcat.php';</script>";
                      }
                      else{
                          echo "<script>alert('SubCategory of Ebook Deleted Successfully.');location.href='lzsubcategory.php';</script>";
                      }
                   }
                  else{
                        if($type==3){
                          echo "<script>alert('SubCategory of Ebook Deleted Successfully.');location.href='ebooksubcat.php';</script>";
                      }
                      else{
                          echo "<script>alert('SubCategory of Ebook Deleted Successfully.');location.href='lzsubcategory.php';</script>";
                      }
                    }
            }
            else{
                    if($type==3){
                          echo "<script>alert('SubCategory of Ebook Deleted Successfully.');location.href='ebooksubcat.php';</script>";
                      }
                      else{
                          echo "<script>alert('SubCategory of Ebook Deleted Successfully.');location.href='lzsubcategory.php';</script>";
                      }
                }
        }
    }
    else{
                 if($type==3){
                          echo "<script>alert('SubCategory of Ebook Deleted Successfully.');location.href='ebooksubcat.php';</script>";
                      }
                      else{
                          echo "<script>alert('SubCategory of Ebook Deleted Successfully.');location.href='lzsubcategory.php';</script>";
                      }
    }
}
//delete category of Ebook
if(isset($_GET['delete_ebook_category'])){
    $id=$_GET['id'];
    $type=$_GET['type'];
    $sql="delete from category where id='$id' and type='$type'";
    if($db->sql($sql)){
        $sql="select * from subcategory where maincat_id='$id' and type='$type'";
        $db->sql($sql);
        $res = $db->getResult();
        foreach($res as $subcategory){
            $subcategory_id=$subcategory['id'];
            $sql="delete from subcategory where id='$subcategory_id' and type='$type'";
            if($db->sql($sql)){
                $sql="select * from sub_2category where subcategory_id='$subcategory_id' and type='$type'";
                $db->sql($sql);
                $res = $db->getResult();
                foreach($res as $subcategory_2){
                    $sub_2category_id=$subcategory_2['id'];
                    $sql="delete from sub_2category where id='$sub_2category_id' and type='$type'";
                    if($db->sql($sql)){
                       $sql="select * from sub_3category where sub_2category_id='$sub_2category_id' and type='$type'";
                       $db->sql($sql);
                       $res = $db->getResult();
                       foreach($res as $sub_3){
                           $sub_3category_id=$sub_3['id'];
                           $sql="delete from sub_3category where id='$sub_3category_id' and type='$type'";
                           if($db->sql($sql)){
                               echo "<script>alert('Category Of Ebook Deleted Successfully.');location.href='ebookcat.php';</script>";
                           }
                           else{
                               echo "<script>alert('Category Of Ebook Not Deleted.');location.href='ebookcat.php';</script>";
                           }
                       }
                    }
                    else{
                        echo "<script>alert('Category Of Ebook Not Deleted.');location.href='ebookcat.php';</script>";
                    }
                }
            }
            else{
                echo "<script>alert('Category Of Ebook Not Deleted.');location.href='ebookcat.php';</script>";
            }
        }
    }
    else{
        echo "<script>alert('Category Of Ebook Not Deleted.');location.href='ebookcat.php';</script>";
    }
}
//delete all category of Ebook
if(isset($_POST['delete_ebook_cat'])){
    $type=$_POST['type'];
    $sql="delete from category where type='$type'";
    if($db->sql($sql)){
        $sql="delete from subcategory where type='$type'";
        if($db->sql($sql)){
            $sql="delete from sub_2category where type='$type'";
            if($db->sql($sql)){
                $sql="delete from sub_3category where type='$type'";
                if($db->sql($sql)){
                    echo "Record Not Founded.";
                }
            }
        }
    }
}
//delete all subcategory 3 of ebook
if(isset($_POST['delete_ebook_sub_3cat'])){
    $type=$_POST['type'];
    $sql="delete from sub_3category where type='$type'";
    if($db->sql($sql)){
        echo "Record Not Founded.";
    }
}
//delete all subcategory 2 of ebook
if(isset($_POST['delete_ebook_sub_2cat'])){
    $type=$_POST['type'];
    $sql="delete from sub_2category where type='$type'";
    if($db->sql($sql)){
        $sql="delete from sub_3category where type='$type'";
        if($db->sql($sql)){
            echo "Record Not Founded.";
        }
    }
}
//delete all subcategory of ebook
if(isset($_POST['delete_ebook_subcat'])){
    $type=$_POST['type'];
    $sql="delete from subcategory where type='$type'";
    if($db->sql($sql)){
            $sql="delete from sub_2category where type='$type'";
            if($db->sql($sql)){
                $sql="delete from sub_3category where type='$type'";
                if($db->sql($sql)){
                    echo "Record Not Founded.";
                    
                }
                
            }
        
    }
}
//delete all subcategory 3 of Question And Answer
if(isset($_POST['delete_question/answer_sub_3category'])){
    $type=$_POST['type'];
    $sql="delete from sub_3category where type='$type'";
    if($db->sql($sql)){
        echo "Record Not Founded.";
    }
}
//delete all subcategory 2 of ebook
if(isset($_POST['delete_question/answer_sub_2category'])){
    $type=$_POST['type'];
    $sql="delete from sub_2category where type='$type'";
    if($db->sql($sql)){
        $sql="delete from sub_3category where type='$type'";
        if($db->sql($sql)){
            echo "Record Not Founded.";
        }
    }
}
//delete all subcategory of Question And Answer
if(isset($_POST['delete_question/answer_subcategory'])){
    $type=$_POST['type'];
    $sql="delete from subcategory where type='$type'";
    if($db->sql($sql)){
            $sql="delete from sub_2category where type='$type'";
            if($db->sql($sql)){
                $sql="delete from sub_3category where type='$type'";
                if($db->sql($sql)){
                    echo "Record Not Founded.";
                    
                }
                
            }
        
    }
}
?>