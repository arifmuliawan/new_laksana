<!-- TAB INDIVIDUAL SERIES -->
<?php
if($tab=='individual')
{
    if($tab!="individual")
    {
        $action_individual="";
    }
    else
    {
        $action_individual=$action;
    }   
    if(empty($action_individual))
    {
        $status_form = "disabled";
    }
    else
    {
        $status_form = "";
        if($action_individual=='4')
        {
            $update     = mysqli_query($con,"UPDATE home_mng set title='',description='',url=''update_by='$username',update_date='$now' WHERE code='4'");
            if($update==1)
            {
                echo "<script type='text/javascript'> alert('deleted successfully!');</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=home_mng&t=individual">';
            }
        }
    }
    if(isset($_POST['submit']))
    {
        $title_individual    = $_POST['title'];
        $desc_individual     = $_POST['desc'];
        $link_individual     = $_POST['link'];
        if($link=="")
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
            $url_individual = $name_banner;
        } 
        else
        {
            $url_individual = $link_individual;
        }   
        if($action_individual=='3')
        {
            if($url_individual!="")
            {
                $update     = mysqli_query($con,"UPDATE home_mng set title='$title_individual',description='$desc_individual',url='$url_individual',update_by='$username',update_date='$now' WHERE code='4'");
                if($update==1)
                {
                    echo "<script type='text/javascript'> alert('submitted successfully!');</script>";
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=home_mng&t=individual">';
                }
            }
            else
            {
                $update     = mysqli_query($con,"UPDATE home_mng set title='$title_individual',description='$desc_individual',update_by='$username',update_date='$now' WHERE code='4'");
                if($update==1)
                {
                    echo "<script type='text/javascript'> alert('submitted successfully!');</script>";
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=home_mng&t=individual">';
                }
            }    
        }
    }
    else
    {
        $query_individual   = mysqli_query($con,"SELECT * from home_mng WHERE code='4' LIMIT 1");
        $data_individual    = mysqli_fetch_array($query_individual);
        $title_individual   = $data_individual['title'];
        $desc_individual    = $data_individual['description'];
        $url_individual     = $data_individual['url'];
                        
    }
    ?>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="body">
                <form id="form_validation" method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group form-float">
                        <label class="form-label"><b>Title</b></label>
                        <input name="title" type="text" value="<?php echo $title_individual ?>" <?php echo $status_form ?>/>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label"><b>Description</b></label>
                        <textarea <?php if($status_form==""){ echo 'class="ckeditor" id="ckedtor"'; } ?> name="desc" style="margin-top: 0px; margin-bottom: 0px; height: 200px;" <?php echo $status_form ?>><?php echo $desc_individual ?></textarea>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label"><b>Banner</b></label><br>
                        <?php
                        if($url_individual!="")
                        {
                            if(strpos($url_individual, "youtube") !== false)
                            {
                                echo "1";
                                                    ?>        
                                <iframe width="500" height="300" src="<?php echo $url_individual ?>"></iframe>
                                                    <?php
                            }
                            else
                            {
                                $y_individual               = explode('.', $url_individual);
                                $cariekstensi_individual    = strtolower(end($y_individual));
                                if($url_individual!="" && ($cariekstensi_individual=="mp4" || $cariekstensi_individual=="mov"))
                                {
                                                    ?>    
                                    <video width="500" height="300" controls>
                                        <source src="<?php echo $base_url.''.$url_individual ?>" type="video/mp4">
                                    </video> 
                                                    <?php
                                }
                                if($url_individual!="" && ($cariekstensi_individual=="jpeg" || $cariekstensi_individual=="jpg" || $cariekstensi_individual=="png"))
                                {
                                                    ?>    
                                    <img src="<?php echo $base_url.''.$url_individual ?>" width="25%"> 
                                                    <?php
                                }
                            } 
                        }   
                        ?>
                        <!--<p style="font-size: 10px;font-style: italic;"> Image logo size: 110x110px </p>-->
                        <?php
                        if($tab=='individual' &&  $action!="")
                        {
                        ?>
                            <br>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation">
                                    <a href="#upload" data-toggle="tab" class="active show">Upload Image / Video</a>
                                </li>
                                <li role="presentation">
                                    <a href="#link" data-toggle="tab">Link Youtube</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active show" id="upload">
                                    <label class="form-label"><b>Banner / Video</b></label><br>
                                    <input name="banner" type="file" multiple <?php echo $status_form ?>>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="link">
                                    <label class="form-label"><b>URL Youtube</b></label><br>
                                    <input name="link" type="text" value="<?php echo $link_individual ?>" <?php echo $status_form ?>/>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                    if($tab=='individual' &&  $action!="")
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
                            <a href="?p=home_mng&t=individual&a=3&id=1">
                                <button type="button" class="btn btn-warning">
                                    <i class='fas fa-pen'></i>
                                </button>
                            </a>
                    <?php
                        }
                        if (in_array("4", $access_admin))
                        {
                    ?>        
                            <a href="?p=home_mng&t=individual&a=4&id=1" onclick="return confirm('Are you sure want to delete ?')">  
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