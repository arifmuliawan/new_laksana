<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title"><font color="rgb(41, 41, 43)">Menu Management</font></h4>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
            <?php
            if(empty($action))
            {
            ?>    
                <!-- Start Tables -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Menu Table</strong></h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <?php
                                    if (in_array("2", $access_admin))
                                    {
                                    ?>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <div class="btn-group m-l-15">
                                                    <a href="?p=menu&a=2">
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
                                    <table class="table table-bordered table-striped table-hover save-stage dataTable" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Menu</th>
                                                <th>link</th>
                                                <th>Activate</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (in_array("1", $access_admin))
                                            {
                                            $query_data = mysqli_query($con,"SELECT * from menu WHERE visible!='D' ORDER BY sortid");
                                            while($data=mysqli_fetch_array($query_data))
                                            {
                                                $id_data        = $data['id'];
                                                $sortid_data    = $data['sortid'];
                                                $menu_data      = $data['menu'];
                                                $link_data      = $data['link'];
                                                $visible_data   = $data['visible'];    
                                            ?>    
                                                <tr>
                                                    <td style="text-align: center;" ><?php echo $sortid_data ?></td>
                                                    <td><?php echo $menu_data ?></td>
                                                    <td><?php echo $link_data ?></td>
                                                    <td style="text-align: center;" ><?php echo $visible_data ?></td>
                                                    <td>
                                                        <?php
                                                        if (in_array("3", $access_admin))
                                                        {
                                                        ?>    
                                                            <a href="?p=menu&a=3&id=<?php echo $id_data ?>">
                                                                <button type="button" class="btn btn-warning">
                                                                    <i class='fas fa-pen'></i>
                                                                </button>
                                                            </a>
                                                        <?php
                                                        }
                                                        if (in_array("4", $access_admin))
                                                        {
                                                        ?>  
                                                            <a href="?p=menu&a=4&id=<?php echo $id_data ?>" onclick="return confirm('Are you sure want to delete ?')">  
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
                if(isset($_POST['submit']))
                {
                    //print_r($_POST);
                    //exit(); 
                    $menu_data          = $_POST['menu'];
                    $link_data          = $_POST['link'];
                    $visible_data       = $_POST['visible']; 
                    if(empty($visible_data))
                    {
                        $error          = 1;
                        $msg_visible    = "This field is required.";
                    }
                    if(empty($error))
                    {
                        if($action=='2')
                        {    
                            $query_last         = mysqli_query($con,"SELECT * from menu WHERE visible!='D' order by sortid DESC LIMIT 1");
                            $data_last          = mysqli_fetch_array($query_last);
                            $sort_last          = $data_last['sortid'];
                            $new_sort           = $sort_last+1;
                            $input              = mysqli_query($con,"INSERT into menu (sortid,menu,link,visible,create_by,create_date,update_by,update_date) VALUES ('$new_sort','$menu_data','$link_data','$visible_data','$username','$now','$username','$now')");
                        }
                        elseif($action=='3') 
                        {
                            $update             = mysqli_query($con,"UPDATE menu SET menu='$menu_data',link='$link_data',visible='$visible_data',update_by='$username',update_date='$now' WHERE id='$id'");
                        }    
                        if($input==1 || $update==1)
                        {
                            echo "<script type='text/javascript'> alert('submitted successfully!');</script>";
                            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=menu_mng">';
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
                    $query_select   = mysqli_query($con,"SELECT * from menu WHERE id='$id' AND visible!='D'");
                    $data_select    = mysqli_fetch_array($query_select);
                    $menu_data      = $data_select['menu'];
                    $link_data      = $data_select['link'];
                    $visible_data   = $data_select['visible'];
                } 
                elseif ($action=='4') 
                {
                    $delete         = mysqli_query($con,"UPDATE menu SET visible='D',update_by='$username',update_date='$now' WHERE id='$id'");
                    if($delete==1)
                    {
                        echo "<script type='text/javascript'> alert('deleted successfully!');</script>";
                        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=menu_mng">';
                    }
                    else
                    {
                        echo "<script type='text/javascript'> alert('deleted failed!');</script>";
                        echo("Error description: " . $con -> error);
                    }
                }
                else
                {
                    $menu_data      = "";
                    $link_data      = "";
                    $visible_data   = "";
                }    
            ?>       
                <!-- Start Form -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Menu Form</strong></h2>
                            </div>
                            <div class="body">
                                <form id="form_validation" method="POST" action="">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="menu" value="<?php echo $menu_data ?>" required>
                                            <label class="form-label">Menu</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="link" value="<?php echo $link_data ?>">
                                            <label class="form-label">Link</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Activate</label><br>
                                        <label>
                                            <input class="with-gap" type="radio" name="visible" value="Y" <?php if($visible_data=='Y'){ echo "checked";} ?> />
                                            <span>Yes</span>
                                        </label>
                                        <label>
                                            <input class="with-gap" type="radio" name="visible" value="N" <?php if($visible_data=='N'){ echo "checked";} ?>/>
                                            <span>No</span>
                                        </label><br>
                                        <?php if(isset($msg_visible)){ ?><font color="red"><?php echo $msg_visible ?></font><?php } ?>
                                    </div>
                                    <button class="btn btn-primary waves-effect" type="submit" name="submit" value="submit">SUBMIT</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Form -->
            <?php
            }    
            ?>
    </div>
</section>