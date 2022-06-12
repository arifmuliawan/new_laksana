<!-- TAB banner SERIES -->
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
            $update     = mysqli_query($con,"UPDATE about_mng set description='',url=''update_by='$username',update_date='$now' WHERE code='2'");
            if($update==1)
            {
                echo "<script type='text/javascript'> alert('deleted successfully!');</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=about_mng&t=banner">';
            }
        }
    }
    if(isset($_POST['submit']))
    {
        $link_banner     = $_POST['link'];
        if($_FILES['banner']['name']!='')
        {
            $ekstensi_diperbolehkan = array('mp4','mov','png','jpg','jpeg');
            $nama_banner            = $_FILES['banner']['name'];
            $x_banner               = explode('.', $nama_banner);
            $ekstensi_banner        = strtolower(end($x_banner));
            $ukuran_banner          = $_FILES['banner']['size'];
            $file_tmp_banner        = $_FILES['banner']['tmp_name'];
            $file_directory_banner  = "../assets/about us/".$nama_banner;
            $file_db_banner         = "assets/about us/".$nama_banner;
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
            if($name_banner!="")
            {
                $update     = mysqli_query($con,"UPDATE about_mng set description='$name_banner',url='$link_banner',update_by='$username',update_date='$now' WHERE code='2'");
                if($update==1)
                {
                    echo "<script type='text/javascript'> alert('submitted successfully!');</script>";
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=about_mng&t=banner">';
                }
            }
            else
            {
                $update     = mysqli_query($con,"UPDATE about_mng set url='$link_banner',update_by='$username',update_date='$now' WHERE code='2'");
                if($update==1)
                {
                    echo "<script type='text/javascript'> alert('submitted successfully!');</script>";
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=about_mng&t=banner">';
                }
            }    
        }
    }
    else
    {
        $query_banner   = mysqli_query($con,"SELECT * from about_mng WHERE code='2' LIMIT 1");
        $data_banner    = mysqli_fetch_array($query_banner);
        $url_banner     = $data_banner['description'];
        $link_banner    = $data_banner['url'];
                        
    }
    ?>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="body">
                <form id="form_validation" method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group form-float">
                        <label class="form-label"><b>Banner</b></label><br>
                        <?php
                        if($url_banner!="")
                        {
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
                        }   
                        ?>
                        <br>
                        <!--<p style="font-size: 10px;font-style: italic;"> Image logo size: 110x110px </p>-->
                        <?php
                        if($tab=='banner' &&  $action!="")
                        {
                        ?>
                            <div class="form-group form-float">
                                    <label class="form-label"><b>Banner / Video</b></label><br>
                                    <input name="banner" type="file" multiple <?php echo $status_form ?>>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label"><b>Link Youtube</b></label>
                        <input name="link" type="text" value="<?php echo $link_banner ?>" <?php echo $status_form ?>/>
                    </div>
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
                            <a href="?p=about_mng&t=banner&a=3&id=1">
                                <button type="button" class="btn btn-warning">
                                    <i class='fas fa-pen'></i>
                                </button>
                            </a>
                    <?php
                        }
                        if (in_array("4", $access_admin))
                        {
                    ?>        
                            <a href="?p=about_mng&t=banner&a=4&id=1" onclick="return confirm('Are you sure want to delete ?')">  
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