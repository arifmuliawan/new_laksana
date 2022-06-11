<!-- TAB SOCIAL MEDIA -->
<?php
if($tab=='socmed')
{
    if($tab!="socmed")
    {
        $action_socmed="";
    }
    else
    {
        $action_socmed=$action;
    }
    if($action_socmed=="")
    {  
?>    
        <!-- Start Tables -->
        <div class="row" id="socmed">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Social Media Table</strong></h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <?php
                            if (in_array("2", $access_admin))
                            {
                            ?>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="btn-group m-l-15">
                                            <a href="?p=contact_mng&t=socmed&a=2">
                                            <button id="addRow" class="btn btn-info">
                                                Add New
                                                <i class="fa fa-plus"></i>
                                            </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>    
                            <table class="table table-bordered table-striped table-hover save-stage dataTable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Social Media</th>
                                        <th>Logo</th>
                                        <th>Link</th>
                                        <th>Activate</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (in_array("1", $access_admin))
                                    {
                                        $no_socmed      = 1;
                                        $query_socmed   = mysqli_query($con,"SELECT * from social_media WHERE visible!='D' order by id ASC");
                                        while($data_socmed=mysqli_fetch_array($query_socmed))
                                        {
                                            $id_data        = $data_socmed['id'];
                                            $title_data     = $data_socmed['title'];
                                            $img_data       = $data_socmed['img'];
                                            $link_data      = $data_socmed['link'];
                                            $visible_data   = $data_socmed['visible'];    
                                        ?>    
                                            <tr>
                                                <td style="text-align: center;"><?php echo $no_socmed ?></td>
                                                <td><?php echo $title_data ?></td>
                                                <td style="text-align: center;">
                                                    <?php
                                                    if($img_data!="")
                                                    {
                                                    ?>
                                                        <img src="<?php echo $base_url.''.$img_data ?>" width="23px" height="23px" style="background-color: #1C4CA0;">
                                                    <?php
                                                    }
                                                    ?>    
                                                </td>
                                                <td><?php echo $link_data ?></td>
                                                <td style="text-align: center;"><?php echo $visible_data ?></td>
                                                <td>
                                                    <?php
                                                    if (in_array("3", $access_admin))
                                                    {
                                                    ?>    
                                                        <a href="?p=contact_mng&t=socmed&a=3&id=<?php echo $id_data ?>">
                                                            <button type="button" class="btn btn-warning">
                                                                <i class='fas fa-pen'></i>
                                                            </button>
                                                        </a>
                                                    <?php
                                                    }
                                                    if (in_array("4", $access_admin))
                                                    {
                                                    ?>  
                                                        <a href="?p=contact_mng&t=socmed&a=4&id=<?php echo $id_data ?>" onclick="return confirm('Are you sure want to delete ?')">  
                                                            <button type="button" class="btn btn-danger">
                                                                <i class='fas fa-trash'></i>
                                                            </button>
                                                        </a>    
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                            $no_socmed++;
                                        }
                                    }
                                    ?>    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        <!-- End Tables -->
    <?php
    }
    else
    {
        if(isset($_POST['submit_socmed']))
        {
            $title_data             = $_POST['title_sm'];
            $logo_data              = $_POST['logo_sm'];
            $link_data              = $_POST['link_sm'];
            $visible_data           = $_POST['visible_sm']; 
            if(empty($visible_data))
            {
                $error          = 1;
                $msg_visible    = "This field is required.";
            }
            if($_FILES['file']['name']!="")
            {    
                $nama                   = $_FILES['file']['name'];
                $x                      = explode('.', $nama);
                $ekstensi               = strtolower(end($x));
                $ekstensi_diperbolehkan = array('png','jpg','svg');
                $ukuran                 = $_FILES['file']['size'];
                $file_tmp               = $_FILES['file']['tmp_name'];
                $file_directory         = "../assets/img/ico/".$nama;
                $file_db                = "assets/img/ico/".$nama;
                if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
                {
                    if($ukuran < 1044070)
                    {          
                        $upload         = 1;  
                        move_uploaded_file($file_tmp, $file_directory);       
                    }
                    else
                    {
                        $error          = 1;
                        $upload         = 0;
                        $msg_upload     = "Error description: UKURAN FILE TERLALU BESAR";
                    }
                }
                else
                {
                    $error              = 1;
                    $upload             = 0;
                    $msg_upload         = "Error description: EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN";
                }    
            }  
            if(empty($error))
            {
                if($action=='2')
                {    
                    if($_FILES['file']['name']!="")
                    {
                        $img_logo       = $file_db;
                    }
                    else 
                    {
                        $img_logo       = "";
                    }   
                    $input              = mysqli_query($con,"INSERT into social_media (title,img,link,visible,create_by,create_date,update_by,update_date) VALUES ('$title_data','$img_logo','$link_data','$visible_data','$username','$now','$username','$now')");
                }
                elseif($action=='3') 
                {
                    if($_FILES['file']['name']!="")
                    {
                        $img_logo       = $file_db;
                    }
                    else 
                    {
                        $img_logo       = $logo_data;
                    }
                    $update         = mysqli_query($con,"UPDATE social_media SET title='$title_data',img='$img_logo',link='$link_data',visible='$visible_data',update_by='$username',update_date='$now' WHERE id='$id'");
                }    
                if($input==1 || $update==1)
                {
                    echo "<script type='text/javascript'> alert('submitted successfully!');</script>";
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=contact_mng&t=socmed">';
                }
                else
                {
                    echo "<script type='text/javascript'> alert('submitted failed!');</script>";
                    echo("Error description: " . $con -> error);
                }    
            }
        }
        elseif($action=='3')
        {
            $query_select   = mysqli_query($con,"SELECT * from social_media WHERE id='$id' AND visible!='D'");
            $data_select    = mysqli_fetch_array($query_select);
            $title_socmed   = $data_select['title'];
            $logo_socmed    = $data_select['img'];
            $link_socmed    = $data_select['link'];
            $visible_socmed = $data_select['visible'];
        } 
        elseif ($action=='4') 
        {
            $delete         = mysqli_query($con,"UPDATE social_media SET visible='D',update_by='$username',update_date='$now' WHERE id='$id'");
            if($delete==1)
            {
                echo "<script type='text/javascript'> alert('deleted successfully!');</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=contact_mng&t=socmed">';
            }
            else
            {
                echo "<script type='text/javascript'> alert('deleted failed!');</script>";
                echo("Error description: " . $con -> error);
            }
        }
        else
        {
            $title_socmed   = "";
            $logo_socmed    = "";
            $link_socmed    = "";
            $visible_socmed = "";
        }    
        ?>       
        <!-- Start Form -->
        <div class="row clearfix" id="socmed">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <form id="form_validation" method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="title_sm" value="<?php echo $title_socmed ?>" required>
                                    <label class="form-label">Title</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label>Logo</label><br>
                                    <input type="hidden" name="logo_sm" value="<?php echo $logo_socmed ?>">
                                    <?php
                                    if($action==3)
                                    {
                                        if($logo_socmed!="")
                                        {
                                    ?>    
                                        <img src="<?php echo $logo_socmed ?>" width="50" height="50" style="background-color: #1C4CA0;"><br><br>
                                    <?php
                                        }
                                    }
                                    ?>    
                                    <input name="file" type="file"/>    
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="link_sm" value="<?php echo $link_socmed ?>">
                                    <label class="form-label">Link</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Activate</label><br>
                                <label>
                                    <input class="with-gap" type="radio" name="visible_sm" value="Y" <?php if($visible_socmed=='Y'){ echo "checked";} ?> />
                                    <span>Yes</span>
                                    </label>
                                <label>
                                    <input class="with-gap" type="radio" name="visible_sm" value="N" <?php if($visible_socmed=='N'){ echo "checked";} ?>/>
                                    <span>No</span>
                                </label><br>
                                <?php if(isset($msg_visible_sm)){ ?><font color="red"><?php echo $msg_visible_sm ?></font><?php } ?>
                            </div>
                            <button class="btn btn-primary waves-effect" type="submit" name="submit_socmed" value="submit_socmed">SUBMIT</button>
                            <a href="?p=contact_mng&t=socmed" onclick="return confirm('Are you sure want to cancel ?')" style="background: #ff0000;color: white;border: white 3px solid;border-radius: 5px;padding: 8px 8px;margin-top: 10px;font-color:#fff">
                                Cancel
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Form -->
<?php
    }
}
?>