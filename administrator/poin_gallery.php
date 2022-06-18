<h5> Image Gallery </h5>
<div class="list-unstyled row clearfix" style="margin-left: 0px;">
<!-- TAB GALLERY IMAGE-->
<?php
$action_gallery         = $subact;
if($action_gallery==3)
{
    $status_gallery     = "";
}
if($action_gallery==4)
{    
    $delete             = mysqli_query($con,"UPDATE about_assets SET visible='D',update_by='$username',update_date='$now' WHERE id='$sid' AND aboutid='$id'");
    if($delete==1)
    {
        echo "<script type='text/javascript'> alert('deleted successfully!');</script>";
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=about_mng&t=point&a=1&id='.$id.'">';
    }    
}  
if(isset($_POST['submit_gallery']))
{
    $title_gallery              = $_POST['title'];
    $desc_gallery               = $_POST['desc'];    
    $ekstensi_diperbolehkan     = array('png','jpg');
    $nama_gallery               = $_FILES['gallery']['name'];
    $x_gallery                  = explode('.', $nama_gallery);
    $ekstensi_gallery           = strtolower(end($x_gallery));
    $ukuran_gallery             = $_FILES['gallery']['size'];
    $file_tmp_gallery           = $_FILES['gallery']['tmp_name'];
    $file_directory_gallery     = "../assets/about us/".$nama_gallery;
    $file_db_gallery            = "assets/about us/".$nama_gallery;
    if($_FILES['gallery']['name']!='')
    {    
        if(in_array($ekstensi_gallery, $ekstensi_diperbolehkan) === true)
        {
            if($ukuran < 1044070)
            {          
                move_uploaded_file($file_tmp_gallery, $file_directory_gallery);
                $name_file_gallery  = $file_db_gallery;
            }
            else
            {
                $error              = 1;
                $msg_gallery        = "UKURAN FILE TERLALU BESAR";
            }
        }    
        else
        {
            $error                  = 1;
            $msg_gallery            = "EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN";
        }
        if($error!=1)
        {
            if($subact=='' || $subact=='2')
            {
                $input              = mysqli_query($con,"INSERT into about_assets(aboutid,title,description,url,visible,create_by,create_date,update_by,update_date) VALUES ('$id','$title_gallery','$desc_gallery','$name_file_gallery','Y','$username','$now','$username','$now')");
            }
            elseif($subact=='3')
            {
                $update             = mysqli_query($con,"UPDATE about_assets SET title='$title_gallery',description='$desc_gallery',url='$name_file_gallery',update_by='$username',update_date='$now' WHERE id='$sid' AND aboutid='$id'");
            }
            if($input==1 || $update==1)
            {
                echo "<script type='text/javascript'> alert('submitted successfully!');</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=about_mng&t=point&a=1&id='.$id.'">';
            } 
        }
    }
    else
    {
        if($subact=='' || $subact=='2')
        {
            echo "<script type='text/javascript'> alert('Sorry No Image!');</script>";
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=about_mng&t=point&a=1&id='.$id.'">';
        }
        elseif($subact=='3')
        {
            $update             = mysqli_query($con,"UPDATE about_assets SET title='$title_gallery',description='$desc_gallery',update_by='$username',update_date='$now' WHERE id='$sid' AND aboutid='$id'");
        } 
        if($input==1 || $update==1)
        {
            echo "<script type='text/javascript'> alert('submitted successfully!');</script>";
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=about_mng&t=point&a=1&id='.$id.'">';
        }   
    }       
}
$query_gallery              = mysqli_query($con,"SELECT * from about_assets WHERE aboutid='$id' AND visible='Y'");
while($data_gallery         = mysqli_fetch_array($query_gallery))
{
    $id_gallery_data        = $data_gallery['id'];
    $title_gallery_data     = $data_gallery['title'];
    $desc_gallery_data      = $data_gallery['description'];
    $url_gallery_data       = $data_gallery['url'];
    if($sid==$id_gallery_data)
    {
        $status_gallery     = "";
    }
    elseif($sid!=$id_gallery_data)
    {
        $status_gallery     = "disabled";
    }
    else
    {
        $status_gallery     = $status_gallery;
    }
?>    
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <form enctype="multipart/form-data" id="form_validation" method="POST">
            <div class="card">
                <div class="body">
                    <div class="form-group form-float">
                        <label class="form-label"><b>Title</b></label>
                        <input name="title" type="text" value="<?php echo $title_gallery_data ?>" <?php echo $status_gallery ?>/>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label"><b>Description</b></label>
                        <textarea name="desc" style="margin-top: 0px; margin-bottom: 0px; height: 100px;" <?php echo $status_gallery ?>><?php echo $desc_gallery_data ?></textarea>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label"><b>Image</b></label><br>
                        <?php
                        if($url_gallery_data!="")
                        {
                        ?>    
                            <img src="<?php echo $base_url.''.$url_gallery_data ?>">
                        <?php
                        }
                        if($sid==$id_gallery_data)
                        {
                        ?>
                            <input name="gallery" type="file" multiple <?php echo $status_gallery ?>/><br>
                            <?php if(isset($msg_gallery)){ ?><font color="red"><?php echo $msg_gallery ?></font><?php } ?>
                        <?php    
                        }    
                        ?>
                    </div>
                    <?php
                    if($sid==$id_gallery_data)
                    {
                        if($action_gallery==3)
                        {
                    ?>
                            <button class="btn btn-primary waves-effect" type="submit" name="submit_gallery" value="submit">SUBMIT</button>
                            <a href="index.php?p=about_mng&t=apoint&a=1&id=<?php echo $id ?>" class="btn btn-danger waves-effect" type="submit">CANCEL</a>
                    <?php
                        }
                    }
                    else
                    {    
                        if (in_array("3", $access_admin))
                        {
                    ?>    
                            <a href="?p=about_mng&t=point&a=1&id=<?php echo $id ?>&sa=3&sid=<?php echo $id_gallery_data ?>">
                                <button type="button" class="btn btn-warning">
                                    <i class='fas fa-pen'></i>
                                </button>
                            </a>
                    <?php
                        }
                        if (in_array("4", $access_admin))
                        {
                    ?>  
                            <a href="?p=about_mng&t=point&a=1&id=<?php echo $id ?>&sa=4&sid=<?php echo $id_gallery_data ?>" onclick="return confirm('Are you sure want to delete ?')">  
                                <button type="button" class="btn btn-danger">
                                    <i class='fas fa-trash'></i>
                                </button>
                            </a>    
                    <?php
                        }
                    }    
                    ?>
                </div>
            </div>
        </form>
    </div>
<?php
}
if(in_array("2", $access_admin))
{ 
?>    
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <form enctype="multipart/form-data" id="form_validation" method="POST">
            <div class="card">
                <div class="body">
                    <div class="form-group form-float">
                        <label class="form-label"><b>Title</b></label>
                        <input name="title" type="text" value="<?php echo $title_gallery ?>"/>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label"><b>Description</b></label>
                        <textarea name="desc" style="margin-top: 0px; margin-bottom: 0px; height: 100px;"><?php echo $desc_gallery ?></textarea>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label"><b>Image</b></label><br>
                        <input name="gallery" type="file" required="required" multiple/>
                        <?php if(isset($msg_gallery)){ ?><font color="red"><?php echo $msg_gallery ?></font><?php } ?>
                    </div>
                    <button class="btn btn-primary waves-effect" type="submit" name="submit_gallery" value="submit">SUBMIT</button>
                    <a href="index.php?p=about_mng&t=about_point&a=1&id=<?php echo $id ?>" class="btn btn-danger waves-effect" type="submit">CANCEL</a>
                </div>
            </div>
        </form>
    </div>
<?php
}    
?> 
</div>   