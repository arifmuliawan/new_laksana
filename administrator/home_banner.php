<!-- TAB BANNER -->
<?php
if($tab=='banner')
{
    if($tab!="banner")
    {
        $action_banner="";
    }
    else
    {
        $action_banner=$action;
    }
    if(empty($action_banner))
    {
        $status_form = "disabled";
    }
    else
    {
        $status_form = "";
        if($action_banner=='4')
        {
            $update     = mysqli_query($con,"UPDATE home_mng set url='',update_by='$username',update_date='$now' WHERE id='2' AND code='2'");
            if($update==1)
            {
                echo "<script type='text/javascript'> alert('deleted successfully!');</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=home_mng&t=banner">';
            }
        }
    }
    if(isset($_POST['submit']))
    {
        if($_FILES['banner']['name']!='')
        {
            $ekstensi_diperbolehkan = array('mp4','mov','png','jpg','jpeg');
            $nama_banner            = $_FILES['banner']['name'];
            $x_banner               = explode('.', $nama_banner);
            $ekstensi_banner        = strtolower(end($x_banner));
            $ukuran_banner          = $_FILES['banner']['size'];
            $file_tmp_banner        = $_FILES['banner']['tmp_name'];
            $file_directory_banner  = "../assets/homepage/".$nama_banner;
            $file_db_banner         = "assets/homepage/".$nama_banner;
            if(in_array($ekstensi_banner, $ekstensi_diperbolehkan) === true)
            {
                if($ukuran_banner < 104857600)
                {          
                    move_uploaded_file($file_tmp_banner, $file_directory_banner);
                    $name_banner    = $file_db_banner;
                }
                else
                {
                    $error          = 1;
                    $msg_banner     = "UKURAN FILE TERLALU BESAR";
                }
            }    
            else
            {
                $error              = 1;
                $msg_banner         = "EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN";
            }    
        }
        else
        {
            $name_banner            = "";
        }
        if($action_banner=='3')
        {
            $update     = mysqli_query($con,"UPDATE home_mng set url='$name_banner',update_by='$username',update_date='$now' WHERE id='2' AND code='2'");
            if($update==1)
            {
                echo "<script type='text/javascript'> alert('submitted successfully!');</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=home_mng&t=banner">';
            }
        }
    }
    else
    {
        $query_banner       = mysqli_query($con,"SELECT * from home_mng WHERE id='2' AND code='2'");
        $data_banner        = mysqli_fetch_array($query_banner);
        $url_banner         = $data_banner['url'];
    }
?>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="body">
                <form id="form_validation" method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group form-float">
                        <?php
                        $y_banner               = explode('.', $url_banner);
                        $cariekstensi_banner    = strtolower(end($y_banner));
                        if($url_banner!="" && ($cariekstensi_banner=="mp4" || $cariekstensi_banner=="mov"))
                        {
                        ?>    
                            <video width="500" height="300" controls>
                                <source src="<?php echo $base_url.''.$url_banner ?>" type="video/mp4">
                            </video> 
                        <?php
                        }
                        if($url_banner!="" && ($cariekstensi_banner=="jpeg" || $cariekstensi_banner=="jpg" || $cariekstensi_banner=="png"))
                        {
                        ?>    
                            <img src="<?php echo $base_url.''.$url_banner ?>" width="50%"> 
                        <?php
                        }
                        ?>
                        <br><br>
                        <input name="banner" type="file" multiple <?php echo $status_form ?>>
                        <!--<p style="font-size: 10px;font-style: italic;"> Image logo size: 110x110px </p>-->
                        <br>
                    </div>
                    <?php if(isset($msg_banner)){ ?><font color="red"><?php echo $msg_banner ?></font><?php } ?>
                    <?php
                    if($tab=='banner' &&  $action!="")
                    {
                    ?>    
                        <button class="btn btn-primary waves-effect" type="submit" name="submit" value="submit">SUBMIT</button>
                    <?php
                    }
                    else
                    {    
                        if (in_array("3", $access_admin))
                        {
                    ?>    
                            <a href="?p=home_mng&t=banner&a=3&id=2">
                                <button type="button" class="btn btn-warning">
                                    <i class='fas fa-pen'></i>
                                </button>
                            </a>
                    <?php
                        }
                        if (in_array("4", $access_admin))
                        {
                    ?>        
                            <a href="?p=home_mng&t=banner&a=4&id=2" onclick="return confirm('Are you sure want to delete ?')">  
                                <button type="button" class="btn btn-danger">
                                    <i class='fas fa-trash'></i>
                                </button>
                            </a>
                    <?php
                        }
                    }
                    ?>    
                </form>
            </div>
        </div>
    </div>
<?php
}
?>