<?php

include('library/crud.php');
include('library/functions.php');
$db = new Database();
$db->connect();

if(isset($_POST['categorydata'])){
$id = $_POST['id'];
$sql="select * from  sub_2category where language_id='$id'";
$db->sql($sql);
$res=$db->getResult();
echo"<option>Select sub_2category</option>";
foreach ($res as $category) {
    echo "<option value=".$category['id'].">".$category['sub_2category_name']."</option>";
}
}
if(isset($_POST['category'])){
    $id=$_POST['id'];
    $sql="select * from category where language_id='$id'";
    $db->sql($sql);
    $res=$db->getResult();
    echo "<option>Select Main Category</option>";
    foreach($res as $category){
        echo "<option value=".$category['id'].">".$category['category_name']."</option>";
    }
}
if(isset($_POST['getsubcategory'])){
    $id = $_POST['id'];
    $type=1;

$sql="select * from  subcategory where language_id='$id' and type='$type'";
$db->sql($sql);
$res=$db->getResult();
echo"<option>Select subcategory</option>";
foreach ($res as $category) {
    echo "<option value=".$category['id'].">".$category['subcategory_name']."</option>";
}
}
if(isset($_POST['subcategory_2'])){
    $id=$_POST['id'];
    $type=1;
    $sql="select * from sub_2category where subcategory_id='$id' and type='$type'";
    $db->sql($sql);
    $res=$db->getResult();
    echo"<option>Select subcategory 2</option>";
    foreach ($res as $category) {
        echo "<option value=".$category['id'].">".$category['sub_2category_name']."</option>";
}
}
if(isset($_POST['subcategory_3'])){
    $id=$_POST['id'];
    $type=1;
    $sql="select * from sub_3category where sub_2category_id='$id' and type='$type'";
    $db->sql($sql);
    $res=$db->getResult();
    echo"<option>Select subcategory 3</option>";
    foreach ($res as $category) {
        echo "<option value=".$category['id'].">".$category['sub_3category_name']."</option>";
}
}
if(isset($_POST['getsub_2category']))
{
   $id = $_POST['id'];


$sql="select * from  sub_2category where language_id='$id'";
$db->sql($sql);
$res=$db->getResult();
echo"<option>Select sub_2category</option>";
foreach ($res as $category) {
    echo "<option value=".$category['id'].">".$category['sub_2category_name']."</option>";
}  
}
if(isset($_POST['category_2data'])){
$id = $_POST['id'];


$sql="select * from  sub_3category where language_id='$id'";
$db->sql($sql);
$res=$db->getResult();
echo"<option>Select sub_3category</option>";
foreach ($res as $category) {
    echo "<option value=".$category['id'].">".$category['sub_3category_name']."</option>";
}
}
if(isset($_POST['getalldata'])){
    $sql="select * from sub_2category";
    $db->sql($sql);
    $res=$db->getResult();
    if($res>0){
    foreach($res as $category){
        echo"
        <tr>
        <td>".$category['id']."</td>
        ";
        $language_id=$category['language_id'];
        $sql="select language from languages where id='$language_id'";
        $db->sql($sql);
        $res=$db->getResult();
        foreach($res as $language){
            echo "<td>".$language['language']."</td>";
        }
        $subcategory_id=$category['subcategory_id'];
        $sql="select maincat_id,subcategory_name from subcategory where id='$subcategory_id'";
        $db->sql($sql);
        $res=$db->getResult();
        foreach($res as $subcategory){
            $maincat_id=$subcategory['maincat_id'];
            $sql="select category_name from category where id='$maincat_id'";
            $db->sql($sql);
            $res=$db->getResult();
            foreach($res as $maincat){
                echo "<td>".$maincat['category_name']."</td>";
            }
            echo"<td>".$subcategory['subcategory_name']."</td>";
        }
        echo "<td>".$category['sub_2category_name']."</td>";
        if(!empty($category['image'])){
        $image="images/subcategory_2/".$category['image'];
        echo '<td><img src="'.$image.'" height=30></td>';
    }
    else{
        echo'<td><img src="images/logo-half.png" height=30></td>';
    }
    $status=$category['status'];
    if($status==1){
        echo '<td><label class="label label-success">Active</label></td>';
       }
       else{
        echo '<td><label class="label label-danger">Deactive</label></td>';
       }
      echo "<td>0</td>";
       echo '<td><a href="deletebook.php?deletesub_2cat=1&id='.$category['id'].'&type='.$category['type'].'" class="btn btn-xs btn-danger delete-sub_2category" title="Delete"><i class="fas fa-trash"></i></a></td>';
       echo "</tr>";
    
    
    }
}
else
{
    echo "Record Not Founds.";
}
}

if(isset($_POST['deletealldata'])){
    $sql="delete from sub_2category";
    if($db->sql($sql)){
        echo "Record Not Founds.";
    }
    
}
if(isset($_POST['filterdata'])){
    $language_id=$_POST['id'];
    $category_id=$_POST['category'];
       $sql="select * from sub_2category where language_id='$language_id' AND id='$category_id'";
    $db->sql($sql);
    $res=$db->getResult();
    if($res>0){
    foreach($res as $category){
        echo"
        <tr>
        <td>".$category['id']."</td>
        ";
        $language_id=$category['language_id'];
        $sql="select language from languages where id='$language_id'";
        $db->sql($sql);
        $res=$db->getResult();
        foreach($res as $language){
            echo "<td>".$language['language']."</td>";
        }
        $subcategory_id=$category['subcategory_id'];
        $sql="select maincat_id,subcategory_name from subcategory where id='$subcategory_id'";
        $db->sql($sql);
        $res=$db->getResult();
        foreach($res as $subcategory){
            $maincat_id=$subcategory['maincat_id'];
            $sql="select category_name from category where id='$maincat_id'";
            $db->sql($sql);
            $res=$db->getResult();
            foreach($res as $maincat){
                echo "<td>".$maincat['category_name']."</td>";
            }
            echo"<td>".$subcategory['subcategory_name']."</td>";
        }
        echo "<td>".$category['sub_2category_name']."</td>";
        if(!empty($category['image'])){
        $image="images/subcategory_2/".$category['image'];
        echo '<td><img src="'.$image.'" height=30></td>';
    }
    else{
        echo'<td><img src="images/logo-half.png" height=30></td>';
    }
    $status=$category['status'];
    if($status==1){
        echo '<td><label class="label label-success">Active</label></td>';
       }
       else{
        echo '<td><label class="label label-danger">Deactive</label></td>';
       }
       echo '<td>0</td>';
       echo '<td><a href="deletebook.php?deletesub_2cat=1&id='.$category['id'].'&type='.$category['type'].'" class="btn btn-xs btn-danger delete-sub_2category" title="Delete"><i class="fas fa-trash"></i></a></td>';
        echo "</tr>";
    
    
    }
}
else
{
    echo "Record Not Founds.";
}
}
//subcategory_3
if(isset($_POST['fetchalldata'])){
    $sql="select * from sub_3category";
    $db->sql($sql);
    $res=$db->getResult();
    if($res>0){
        foreach($res as $sub_3category){
            echo "<tr><td>".$sub_3category['id']."</td>";
            $sub_2category_id=$sub_3category['sub_2category_id'];
            $language_id=$sub_3category['language_id'];
            $sql="select * from languages where id='$language_id'";
            $db->sql($sql);
            $res=$db->getResult();
            foreach($res as $language){
                echo "<td>".$language['language']."</td>";
            }
            $sql="select * from sub_2category where id='$sub_2category_id' AND language_id='$language_id'";
            $db->sql($sql);
            $res=$db->getResult();
            foreach($res as $sub_2category){
                $subcategory_id=$sub_2category['subcategory_id'];
                $language_id=$sub_2category['language_id'];
                $sql="select * from subcategory where id='$subcategory_id' AND language_id='$language_id'";
                $db->sql($sql);
                $res=$db->getResult();
                foreach($res as $subcategory){
                    $maincat_id=$subcategory['maincat_id'];
                    $language_id=$subcategory['language_id'];
                    $sql="select * from category where id='$maincat_id'";
                    $db->sql($sql);
                    $res=$db->getResult();
                    foreach($res as $maincat){
                        echo "<td>".$maincat['category_name']."</td>";
                    }
                    echo "<td>".$subcategory['subcategory_name']."</td>";
                }
                echo "<td>".$sub_2category['sub_2category_name']."</td>";
            }
            echo "<td>".$sub_3category['sub_3category_name']."</td>";
             if(!empty($sub_3category['image'])){
        $image="images/subcategory_3/".$sub_3category['image'];
        echo '<td><img src="'.$image.'" height=30></td>';
    }
    else{
        echo'<td><img src="images/logo-half.png" height=30></td>';
    }
    $status=$sub_3category['status'];
    if($status==1){
        echo '<td><label class="label label-success">Active</label></td>';
       }
       else{
        echo '<td><label class="label label-danger">Deactive</label></td>';
       }
       echo '<td>0</td>';
       echo '<td><a href="deletebook.php?deletesub_3cat=1&id='.$sub_3category['id'].'&type='.$sub_3category['type'].'" class="btn btn-xs btn-danger delete-sub_3category" title="Delete"><i class="fas fa-trash"></i></a></td>';


}
        echo"</tr>";
    }
}

if(isset($_POST['deletealldata'])){
    $sql="delete from sub_2category";
    if($db->sql($sql)){
        echo "Record Not Founds.";
    }
    
}
if(isset($_POST['filterfetchdata'])){
    $language_id=$_POST['id'];
    $category_id=$_POST['category'];
       $sql="select * from sub_3category where language_id='$language_id' AND id='$category_id'";
           $db->sql($sql);
    $res=$db->getResult();
    if($res>0){
        foreach($res as $sub_3category){
            echo "<tr><td>".$sub_3category['id']."</td>";
            $sub_2category_id=$sub_3category['sub_2category_id'];
            $language_id=$sub_3category['language_id'];
            $sql="select * from languages where id='$language_id'";
            $db->sql($sql);
            $res=$db->getResult();
            foreach($res as $language){
                echo "<td>".$language['language']."</td>";
            }
            $sql="select * from sub_2category where id='$sub_2category_id' AND language_id='$language_id'";
            $db->sql($sql);
            $res=$db->getResult();
            foreach($res as $sub_2category){
                $subcategory_id=$sub_2category['subcategory_id'];
                $language_id=$sub_2category['language_id'];
                $sql="select * from subcategory where id='$subcategory_id' AND language_id='$language_id'";
                $db->sql($sql);
                $res=$db->getResult();
                foreach($res as $subcategory){
                    $maincat_id=$subcategory['maincat_id'];
                    $language_id=$subcategory['language_id'];
                    $sql="select * from category where id='$maincat_id'";
                    $db->sql($sql);
                    $res=$db->getResult();
                    foreach($res as $maincat){
                        echo "<td>".$maincat['category_name']."</td>";
                    }
                    echo "<td>".$subcategory['subcategory_name']."</td>";
                }
                echo "<td>".$sub_2category['sub_2category_name']."</td>";
            }
            echo "<td>".$sub_3category['sub_3category_name']."</td>";
             if(!empty($sub_3category['image'])){
        $image="images/subcategory_3/".$sub_3category['image'];
        echo '<td><img src="'.$image.'" height=30></td>';
    }
    else{
        echo'<td><img src="images/logo-half.png" height=30></td>';
    }
    $status=$sub_3category['status'];
    if($status==1){
        echo '<td><label class="label label-success">Active</label></td>';
       }
       else{
        echo '<td><label class="label label-danger">Deactive</label></td>';
       }
       echo '<td>0</td>';
        echo '<td><a href="deletebook.php?deletesub_3cat=1&id='.$sub_3category['id'].'&type='.$sub_3category['type'].'" class="btn btn-xs btn-danger delete-sub_3category" title="Delete"><i class="fas fa-trash"></i></a></td>';



}
        echo"</tr>";
    
    
    }
}
else
{
    echo "Record Not Founds.";
}
//get ebook
if(isset($_POST['getebook'])){
    $type=$_POST['type'];
    $sql="select * from ebook where type='$type'";
    $db->sql($sql);
    $res=$db->getResult();
    foreach($res as $ebook){
        echo "<tr>";
        echo "<td>".$ebook['id']."</td>";
        $language_id=$ebook['language_id'];
        $sql="select * from languages where id='$language_id'";
        $db->sql($sql);
        $res=$db->getResult();
        foreach($res as $language){
            echo "<td>".$language['language']."</td>";
        }
        $category_id=$ebook['category_id'];
        $sql="select * from category where id='$category_id'";
        $db->sql($sql);
        $res=$db->getResult();
        foreach($res as $category){
            echo "<td>".$category['category_name']."</td>";
        }
        $subcategory_id=$ebook['subcategory_id'];
        $sql="select * from subcategory where id='$subcategory_id'";
        $db->sql($sql);
        $res = $db->getResult();
        foreach($res as $subcategory){
            echo "<td>".$subcategory['subcategory_name']."</td>";
        }
        $sub_2category_id=$ebook['sub_2category_id'];
        $sql="select * from sub_2category where id='$sub_2category_id'";
        $db->sql($sql);
        $res=$db->getResult();
        foreach($res as $sub_2category){
            echo "<td>".$sub_2category['sub_2category_name']."</td>";
        }
        $sub_3category_id=$ebook['sub_3category_id'];
        $sql="select * from sub_3category where id='$sub_3category_id'";
        $db->sql($sql);
        $res=$db->getResult();
        foreach($res as $sub_3category){
            echo "<td>".$sub_3category['sub_3category_name']."</td>";
        }
        echo '<td><a href="displaypdf.php?id='.$ebook['id'].'" target="_blank"><button class="btn btn-success">Display Pdf</button></a><a href="deletebook.php?deletebook=1&id='.$ebook['id'].'" class="btn btn-xs btn-danger delete-category" title="Delete"><i class="fas fa-trash"></i></a></td>';
        //echo '<td><a href="deletebook.php?id='.$ebook['id'].'" class="btn btn-xs btn-danger delete-category" title="Delete"><button><i class="fas fa-trash"></button></i></a></td>';

        echo "</tr>";
    }
}
if(isset($_POST['filterebook'])){
    $id=$_POST['id'];
    $category_id=$_POST['category_id'];
    $subcategory_id=$_POST['subcategory_id'];
    $sql="select * from ebook where language_id='$id' AND category_id='$category_id' AND subcategory_id='$subcategory_id'";
    $db->sql($sql);
    $res=$db->getResult();
    foreach($res as $ebook){
        echo "<tr>";
        echo "<td>".$ebook['id']."</td>";
        $language_id=$ebook['language_id'];
        $sql="select * from languages where id='$language_id'";
        $db->sql($sql);
        $res=$db->getResult();
        foreach($res as $language){
            echo "<td>".$language['language']."</td>";
        }
        $category_id=$ebook['category_id'];
        $sql="select * from category where id='$category_id'";
        $db->sql($sql);
        $res=$db->getResult();
        foreach($res as $category){
            echo "<td>".$category['category_name']."</td>";
        }
        $subcategory_id=$ebook['subcategory_id'];
        $sql="select * from subcategory where id='$subcategory_id'";
        $db->sql($sql);
        $res = $db->getResult();
        foreach($res as $subcategory){
            echo "<td>".$subcategory['subcategory_name']."</td>";
        }
        $sub_2category_id=$ebook['sub_2category_id'];
        $sql="select * from sub_2category where id='$sub_2category_id'";
        $db->sql($sql);
        $res=$db->getResult();
        foreach($res as $sub_2category){
            echo "<td>".$sub_2category['sub_2category_name']."</td>";
        }
        $sub_3category_id=$ebook['sub_3category_id'];
        $sql="select * from sub_3category where id='$sub_3category_id'";
        $db->sql($sql);
        $res=$db->getResult();
        foreach($res as $sub_3category){
            echo "<td>".$sub_3category['sub_3category_name']."</td>";
        }
        echo '<td><a href="displaypdf.php?id='.$ebook['id'].'" target="_blank"><button class="btn btn-success">Display Pdf</button></a><a href="deletebook.php?deletebook=1&id='.$ebook['id'].'" class="btn btn-xs btn-danger delete-category" id="delete_ebook" title="Delete"><i class="fas fa-trash"></i></a></td>';
        //echo '<td><a href="deletebook.php?id='.$ebook['id'].'" class="btn btn-xs btn-danger delete-category" title="Delete"><button><i class="fas fa-trash"></button></i></a></td>';
        echo "</tr>";
    }

}
if(isset($_POST['addnews'])){
  $sql="select * from dailynews";
  $db->sql($sql);
  $res=$db->getResult();
  foreach($res as $news){
      echo "<tr>";
      echo "<td>".$news['id']."</td>";
      echo "<td>".$news['title']."</td>";
      echo "<td>".$news['description']."</td>";
      echo '<td><a href="deletebook.php?deletenews=1&id='.$news['id'].'" class="btn btn-xs btn-danger delete-category" id="delete_ebook" title="Delete"><i class="fas fa-trash"></i></a></td>';
      echo "</tr>";
  }
}
//fetch all data of current affair
if(isset($_POST['fetchcurrentaffair'])){
  $sql="select * from currentaffair";
  $db->sql($sql);
  $res=$db->getResult();
  foreach($res as $news){
      echo "<tr>";
      echo "<td>".$news['id']."</td>";
      echo "<td>".$news['title']."</td>";
      echo "<td>".$news['description']."</td>";
      echo '<td><a href="deletebook.php?deletecurrentaffair=1&id='.$news['id'].'" class="btn btn-xs btn-danger delete-category" id="delete_ebook" title="Delete Current Affair"><i class="fas fa-trash"></i></a></td>';
      echo "</tr>";
  }
}
//get question answer sub category
if(isset($_POST['lzsubcategory'])){
    $type=$_POST['type'];
    $sql="select * from subcategory where type='$type'";
    $db->sql($sql);
    $res=$db->getResult();
    $count=count($res);
    if($count>0){
    foreach($res as $subcategory){
        echo "<tr>";
        echo '<td>'.$subcategory['id'].'</td>';
        $category_id=$subcategory['maincat_id'];
        $language_id=$subcategory['language_id'];
        $sql="select language from languages where id='$language_id'";
        $db->sql($sql);
        $res=$db->getResult();
        foreach($res as $language){
        echo '<td>'.$language['language'].'</td>';
        }
        $sql="select category_name from category where id='$category_id'";
        $db->sql($sql);
        $res=$db->getResult();
        foreach($res as $category){
        echo '<td>'.$category['category_name'].'</td>';
        }
        echo '<td>'.$subcategory['subcategory_name'].'</td>';
       $image="images/lzsubcategory/".$subcategory['image'];
       echo '<td><img src="'.$image.'" height=30></td>';
       $status=$subcategory['status'];
        if($status==1){
        echo '<td><label class="label label-success">Active</label></td>';
       }
       else{
        echo '<td><label class="label label-danger">Deactive</label></td>';
       }
       echo '<td>0</td>';
       echo '<td><a href="deletebook.php?delete_subcategory=1&id='.$subcategory['id'].'&type='.$subcategory['type'].'" class="btn btn-xs btn-danger delete-category" id="delete_subcategory" title="Delete"><i class="fas fa-trash"></i></a></td>';
        echo "</tr>";
    }
}else{
    echo "Record Not Found.";
}

}
//filter question answer subcategory
if(isset($_POST['filterlzsubcategory']))
{
    $type=2;
    $l_id=$_POST['id'];
    $c_id=$_POST['category'];
    $sql="select * from subcategory where type='$type' and maincat_id='$c_id'and language_id='$l_id'";
    $db->sql($sql);
    $res=$db->getResult();
    $count=count($res);
    if($count>0){
    foreach($res as $subcategory){
        echo "<tr>";
        echo '<td>'.$subcategory['id'].'</td>';
        echo "</tr>";
    }
    }
    else
    {
        echo "Record Not Found.";
    }
    
}
if(isset($_POST['getlzsubcategory'])){
    $id = $_POST['id'];
    $type=$_POST['type'];

$sql="select * from  subcategory where language_id='$id' and type='$type'";
$db->sql($sql);
$res=$db->getResult();
echo"<option>Select subcategory</option>";
foreach ($res as $category) {
    echo "<option value=".$category['id'].">".$category['subcategory_name']."</option>";
}
}
//get getlzsub_2category
if(isset($_POST['glzsub_2category'])){
    $id = $_POST['id'];
    $type=$_POST['type'];

$sql="select * from  sub_2category where language_id='$id' and type='$type'";
$db->sql($sql);
$res=$db->getResult();
echo"<option>Select sub_2category</option>";
foreach ($res as $category) {
    echo "<option value=".$category['id'].">".$category['sub_2category_name']."</option>";
}
}
if(isset($_POST['categorydata'])){
$id = $_POST['id'];
$type=$_POST['type'];
$sql="select * from  subcategory_2 where language_id='$id' and type='$type'";
$db->sql($sql);
$res=$db->getResult();
echo"<option>Select sub_2category</option>";
foreach ($res as $category) {
    echo "<option value=".$category['id'].">".$category['sub_2category_name']."</option>";
}
}
//get all data of subcategory 2 from question and answer

//get category of Ebook
if(isset($_POST['getebookcategory'])){
    $type=$_POST['type'];
    $sql="select * from category where type='$type'";
    $db->sql($sql);
    $res = $db->getResult();
    foreach($res as $category){
        $language_id=$category['language_id'];
        echo "<tr>";
        echo "<td>".$category['id']."</td>";
        $sql="select * from languages where id='$language_id'";
        $db->sql($sql);
        $res = $db->getResult();
        foreach($res as $language){
            echo "<td>".$language['language']."</td>";
        }
        echo "<td>".$category['category_name']."</td>";
        $image="images/lzcategory/".$category['image'];
        echo '<td><img src="'.$image.'" height=30></td>';
        $status=$category['status'];
        if($status==1){
              echo '<td><label class="label label-success">Active</label></td>';
           }
          else{
                  echo '<td><label class="label label-danger">Deactive</label></td>';
               }
          echo '<td>0</td>';
          echo '<td><a href="deletebook.php?delete_ebook_category=1&id='.$category['id'].'&type='.$category['type'].'" class="btn btn-xs btn-danger delete-category" id="delete_sub_3category" title="Delete"><i class="fas fa-trash"></i></a></td>';

        echo "</tr>";
    }
    
}
//get sub 2 category of Ebook 
if(isset($_POST['getlzsub_2_category'])){
    $type=$_POST['type'];
    $sql="select * from sub_2category where type='$type'";
    $db->sql($sql);
    $res=$db->getResult();
    $count=count($res);
    if($count>0){
       foreach($res as $sub2category){
           echo "<tr>";
           echo "<td>".$sub2category['id']."</td>";
           $language_id=$sub2category['language_id'];
           $subcategory_id=$sub2category['subcategory_id'];
           $sql="select language from languages where id='$language_id'";
           $db->sql($sql);
           $res=$db->getResult();
           foreach($res as $language){
               echo "<td>".$language['language']."</td>";
           }
           $sql="select * from subcategory where id='$subcategory_id'";
           $db->sql($sql);
           $res=$db->getResult();
           foreach($res as $subcategory){
               $maincat_id=$subcategory['maincat_id'];
               $sql="select * from category where id='$maincat_id'";
               $db->sql($sql);
               $res=$db->getResult();
               foreach($res as $category){
                   echo "<td>".$category['category_name']."</td>";
               }
               echo "<td>".$subcategory['subcategory_name']."</td>";
           }
           echo "<td>".$sub2category['sub_2category_name']."</td>";
           $image="images/lzsub_2category/".$sub2category['image'];
           echo '<td><img src="'.$image.'" height=30></td>';
           $status=$sub2category['status'];
           if($status==1){
              echo '<td><label class="label label-success">Active</label></td>';
           }
          else{
                  echo '<td><label class="label label-danger">Deactive</label></td>';
               }
          echo '<td>0</td>';
          echo '<td><a href="deletebook.php?delete_ebook_sub_2category=1&id='.$sub2category['id'].'&type='.$sub2category['type'].'" class="btn btn-xs btn-danger delete-category" id="delete_sub_3category" title="Delete"><i class="fas fa-trash"></i></a></td>';
        
           echo "</tr>";
       } 
    }
    else{
        echo "Record Not Found.";
    }
}
//get sub 3 category of Ebook
if(isset($_POST['getlzsub_3category'])){
    $type=$_POST['type'];
    $sql="select * from sub_3category where type='$type'";
    $db->sql($sql);
    $res=$db->getResult();
    $count=count($res);
    if($count>0){
       foreach($res as $sub3category){
           echo "<tr>";
           echo "<td>".$sub3category['id']."</td>";
           $language_id=$sub3category['language_id'];
           $sql = "select * from languages where id='$language_id'";
           $db->sql($sql);
           $res = $db->getResult();
           foreach($res as $language){
               echo "<td>".$language['language']."</td>";
           }
           $sub2category_id=$sub3category['sub_2category_id'];
           $sql="select * from sub_2category where id='$sub2category_id'";
           $db->sql($sql);
           $res=$db->getResult();
           foreach($res as $sub2category){
               $subcategory_id=$sub2category['subcategory_id'];
               $sql="select * from subcategory where id='$subcategory_id'";
               $db->sql($sql);
               $res = $db->getResult();
               foreach($res as $subcategory){
                   $maincat_id=$subcategory['maincat_id'];
                   $sql= "select * from category where id='$maincat_id'";
                   $db->sql($sql);
                   $res= $db->getResult();
                   foreach($res as $category){
                       echo "<td>".$category['category_name']."</td>";
                   }
                   echo "<td>".$subcategory['subcategory_name']."</td>";
               }
               echo "<td>".$sub2category['sub_2category_name']."</td>";
           }
           echo "<td>".$sub3category['sub_3category_name']."</td>";
           $image="images/lzsub_3category/".$sub3category['image'];
           echo '<td><img src="'.$image.'" height=30></td>';
           $status=$sub3category['status'];
           if($status==1){
              echo '<td><label class="label label-success">Active</label></td>';
           }
          else{
                  echo '<td><label class="label label-danger">Deactive</label></td>';
               }
          echo '<td>0</td>';
          echo '<td><a href="deletebook.php?delete_ebook_sub_3category=1&id='.$sub3category['id'].'&type='.$sub3category['type'].'" class="btn btn-xs btn-danger delete-category" id="delete_sub_3category" title="Delete"><i class="fas fa-trash"></i></a></td>';
           echo "</tr>";
       } 
    }else{
        echo "Record Not Found";
    }
}
//get Q/A category
if(isset($_POST['lzcategory'])){
   $type=$_POST['type'];
   $language_id=$_POST['id'];
   $sql="select * from category where language_id='$language_id' and type='$type'";
   $db->sql($sql);
   $res=$db->getResult();
   echo "<option>Select Main Category</option>";
   foreach($res as $category){
       echo "<option value=".$category['id'].">".$category['category_name']."</option>";
   }
}
//get Q/A subcategory
if(isset($_POST['lzsub'])){
   $type=$_POST['type'];
   $category_id=$_POST['id'];
   $sql="select * from subcategory where maincat_id='$category_id' and type='$type'";
   $db->sql($sql);
   $res=$db->getResult();
   echo "<option>Select Sub Category</option>";
   foreach($res as $category){
       echo "<option value=".$category['id'].">".$category['subcategory_name']."</option>";
   }
}
//get Q/A subcategory_2
if(isset($_POST['lzsub_2category'])){
   $type=$_POST['type'];
   $category_id=$_POST['id'];
   $sql="select * from sub_2category where subcategory_id='$category_id' and type='$type'";
   $db->sql($sql);
   $res=$db->getResult();
   echo "<option>Select Sub 2 Category</option>";
   foreach($res as $category){
       echo "<option value=".$category['id'].">".$category['sub_2category_name']."</option>";
   }
}
//get Q/A subcategory_3
if(isset($_POST['lzsub_3category'])){
   $type=$_POST['type'];
   $category_id=$_POST['id'];
   $sql="select * from sub_3category where sub_2category_id='$category_id' and type='$type'";
   $db->sql($sql);
   $res=$db->getResult();
   echo "<option>Select Sub 3 Category</option>";
   foreach($res as $category){
       echo "<option value=".$category['id'].">".$category['sub_3category_name']."</option>";
   }
}
//getlzebook
if(isset($_POST['getlzebook'])){
    $type=$_POST['type'];
    $sql="select * from ebook where type='$type'";
    $db->sql($sql);
    $res=$db->getResult();
    foreach($res as $ebook){
        echo "<tr>";
        echo "<td>".$ebook['id']."</td>";
        $language_id=$ebook['language_id'];
        $sql="select * from languages where id='$language_id'";
        $db->sql($sql);
        $res=$db->getResult();
        foreach($res as $language){
            echo "<td>".$language['language']."</td>";
        }
        $category_id=$ebook['category_id'];
        $sql="select * from category where id='$category_id'";
        $db->sql($sql);
        $res=$db->getResult();
        foreach($res as $category){
            echo "<td>".$category['category_name']."</td>";
        }
        $subcategory_id=$ebook['subcategory_id'];
        $sql="select * from subcategory where id='$subcategory_id'";
        $db->sql($sql);
        $res = $db->getResult();
        foreach($res as $subcategory){
            echo "<td>".$subcategory['subcategory_name']."</td>";
        }
        $sub_2category_id=$ebook['sub_2category_id'];
        $sql="select * from sub_2category where id='$sub_2category_id'";
        $db->sql($sql);
        $res=$db->getResult();
        foreach($res as $sub_2category){
            echo "<td>".$sub_2category['sub_2category_name']."</td>";
        }
        $sub_3category_id=$ebook['sub_3category_id'];
        $sql="select * from sub_3category where id='$sub_3category_id'";
        $db->sql($sql);
        $res=$db->getResult();
        foreach($res as $sub_3category){
            echo "<td>".$sub_3category['sub_3category_name']."</td>";
        }
        echo '<td><a href="displaypdf.php?id='.$ebook['id'].'" target="_blank"><button class="btn btn-success">Display Pdf</button></a><a href="deletebook.php?deletebook=1&id='.$ebook['id'].'" class="btn btn-xs btn-danger delete-category" title="Delete"><i class="fas fa-trash"></i></a></td>';
        //echo '<td><a href="deletebook.php?id='.$ebook['id'].'" class="btn btn-xs btn-danger delete-category" title="Delete"><button><i class="fas fa-trash"></button></i></a></td>';

        echo "</tr>";
    }
}
//fetch ebook all category 
if(isset($_POST['ebookcategory'])){
    $id=$_POST['id'];
    $type=$_POST['type'];
    $sql="select * from category where language_id='$id' and type='$type'";
    $db->sql($sql);
    $res = $db->getResult();
    echo "<option>Select Main Category</option>";
    foreach($res as $category){
        echo "<option value=".$category['id'].">".$category['category_name']."</option>";
    }
}
if(isset($_POST['ebooksubcategory'])){
    $id=$_POST['id'];
    $type=$_POST['type'];
    $sql="select * from subcategory where maincat_id='$id' and type='$type'";
    $db->sql($sql);
    $res = $db->getResult();
    echo "<option>Select Sub Category</option>";
    foreach($res as $category){
        echo "<option value=".$category['id'].">".$category['subcategory_name']."</option>";
    }
}
if(isset($_POST['ebooksubcategory_2'])){
    $id=$_POST['id'];
    $type=$_POST['type'];
    $sql="select * from sub_2category where subcategory_id='$id' and type='$type'";
    $db->sql($sql);
    $res = $db->getResult();
    echo "<option>Select Sub 2 Category</option>";
    foreach($res as $category){
        echo "<option value=".$category['id'].">".$category['sub_2category_name']."</option>";
    }
}
if(isset($_POST['ebooksubcategory_3'])){
    $id=$_POST['id'];
    $type=$_POST['type'];
    $sql="select * from sub_3category where sub_2category_id='$id' and type='$type'";
    $db->sql($sql);
    $res = $db->getResult();
    echo "<option>Select Sub 3 Category</option>";
    foreach($res as $category){
        echo "<option value=".$category['id'].">".$category['sub_3category_name']."</option>";
    }
}
//end
//get categories of Question and Answer 
if(isset($_POST['getqasubcategory'])){
    $id=$_POST['id'];
    $type=$_POST['type'];
    $sql="select * from subcategory where maincat_id='$id' and type='$type'";
    $db->sql($sql);
    $res = $db->getResult();
    echo "<option>Select Sub  Category</option>";
    foreach($res as $subcategory){
        echo "<option value=".$subcategory['id'].">".$subcategory['subcategory_name']."</option>";
    }
}
if(isset($_POST['getqasub2category'])){
    $id=$_POST['id'];
    $type=$_POST['type'];
    $sql="select * from sub_2category where subcategory_id='$id' and type='$type'";
    $db->sql($sql);
    $res = $db->getResult();
    echo "<option>Select Sub 2 Category</option>";
    foreach($res as $subcategory){
        echo "<option value=".$subcategory['id'].">".$subcategory['sub_2category_name']."</option>";
    }
}
if(isset($_POST['getqasub3category'])){
    $id=$_POST['id'];
    $type=$_POST['type'];
    $sql="select * from sub_3category where sub_2category_id='$id' and type='$type'";
    $db->sql($sql);
    $res = $db->getResult();
    echo "<option>Select Sub 3 Category</option>";
    foreach($res as $subcategory){
        echo "<option value=".$subcategory['id'].">".$subcategory['sub_3category_name']."</option>";
    }
}

//delete all sub_3category
if(isset($_POST['deletefetchdata'])){
    $type=$_POST['type'];
    $sql="delete from sub_3category where type='$type'";
    if($db->sql($sql)){
        echo "Record Not Founds.";
    }
}

?>

