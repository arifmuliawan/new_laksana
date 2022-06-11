<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title"><font color="rgb(41, 41, 43)">Admin Management</font></h4>
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
                                <h2><strong>Admin Table</strong></h2>
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
                                                    <a href="?p=admin&a=2">
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
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Access</th>
                                                <th>Activate</th>
                                                <th>Last Login</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (in_array("1", $access_admin))
                                            {
                                            $query_data = mysqli_query($con,"SELECT * from admin WHERE visible!='D'");
                                            while($data=mysqli_fetch_array($query_data))
                                            {
                                                $id_data        = $data['id'];
                                                $username_data  = $data['username'];
                                                $password_data  = $data['password'];
                                                $access_data    = explode("/",$data['access']);
                                                $llogin_data    = $data['last_login'];
                                                $visible_data   = $data['visible'];    
                                            ?>    
                                                <tr>
                                                    <td><?php echo $username_data ?></td>
                                                    <td><?php echo $password_data ?></td>
                                                    <td>
                                                        <?php
                                                        if (in_array("1", $access_data)){ echo "<i class='fas fa-search'></i> ";}
                                                        if (in_array("2", $access_data)){ echo "<i class='fas fa-plus-square'></i> ";}
                                                        if (in_array("3", $access_data)){ echo "<i class='fas fa-pen-square'></i> ";}
                                                        if (in_array("4", $access_data)){ echo "<i class='fas fa-trash'></i> ";}
                                                        ?>
                                                    </td>
                                                    <td><?php echo $visible_data ?></td>
                                                    <td><?php echo $llogin_data ?></td>
                                                    <td>
                                                        <?php
                                                        if (in_array("3", $access_admin))
                                                        {
                                                        ?>    
                                                            <a href="?p=admin&a=3&id=<?php echo $id_data ?>">
                                                                <button type="button" class="btn btn-warning">
                                                                    <i class='fas fa-pen'></i>
                                                                </button>
                                                            </a>
                                                        <?php
                                                        }
                                                        ?>    
                                                        <?php
                                                        if (in_array("4", $access_admin))
                                                        {
                                                        ?>  
                                                            <a href="?p=admin&a=4&id=<?php echo $id_data ?>" onclick="return confirm('Are you sure want to delete ?')">  
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
                    $username_data      = $_POST['username'];
                    if($action=='2')
                    {    
                        $password_data  = $_POST['password'];
                    }    
                    $visible_data       = $_POST['visible'];
                    if(empty($visible_data))
                    {
                        $error          = 1;
                        $msg_visible    = "This field is required.";
                    }
                    if(empty($_POST['access']))
                    {
                        $access_array   = array();
                        $access_data    = "";
                    }
                    else
                    {
                        $access_array   = $_POST['access'];
                        $access_data    = implode("/",$access_array);
                    } 
                    if(empty($error))
                    {
                        if($action=='2')
                        {    
                            $pass           = md5($password_data);
                            $input          = mysqli_query($con,"INSERT into admin (username,password,access,visible,create_by,create_date,update_by,update_date) VALUES ('$username_data','$pass','$access_data','$visible_data','$username','$now','$username','$now')");
                        }
                        elseif($action=='3') 
                        {
                            $update         = mysqli_query($con,"UPDATE admin SET username='$username_data',access='$access_data',visible='$visible_data',update_by='$username',update_date='$now' WHERE id='$id'");
                        }    
                        if($input==1 || $update==1)
                        {
                            echo "<script type='text/javascript'> alert('submitted successfully!');</script>";
                            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=admin">';
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
                    $query_select   = mysqli_query($con,"SELECT * from admin WHERE id='$id' AND visible!='D'");
                    $data_select    = mysqli_fetch_array($query_select);
                    $id_data        = $data_select['id'];
                    $username_data  = $data_select['username'];
                    $password_data  = "";
                    $visible_data   = $data_select['visible'];
                    $access_data    = $data_select['access'];
                    $access_array   = explode("/", $access_data);
                } 
                elseif ($action=='4') 
                {
                    $delete         = mysqli_query($con,"UPDATE admin SET visible='D',update_by='$username',update_date='$now' WHERE id='$id'");
                    if($delete==1)
                    {
                        echo "<script type='text/javascript'> alert('deleted successfully!');</script>";
                        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=admin">';
                    }
                    else
                    {
                        echo "<script type='text/javascript'> alert('deleted failed!');</script>";
                        echo("Error description: " . $con -> error);
                    }
                }   
                else
                {
                    $id_data        = "";
                    $username_data  = "";
                    $password_data  = "";
                    $visible_data   = "";
                    $access_array   = array();
                }    
            ?>       
                <!-- Start Form -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Admin Form</strong></h2>
                            </div>
                            <div class="body">
                                <form id="form_validation" method="POST" action="">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="username" value="<?php echo $username_data ?>" required>
                                            <label class="form-label">Username</label>
                                        </div>
                                    </div>
                                    <?php
                                    if($action=='2')
                                    {
                                    ?>    
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="password" class="form-control" name="password" value="<?php echo $password_data ?>" required>
                                                <label class="form-label">Password</label>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    elseif($action=='3')
                                    {
                                    ?>
                                    <div class="form-group">
                                        <label class="form-label">Password</label><br>
                                        <label>
                                           <a href="?p=admin&a=5&id=<?php echo $id_data ?>"><button class="btn btn-primary" name="reset">RESET</button></a>
                                        </label>
                                    </div>
                                    <?php
                                    }
                                    ?>
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
                                    <div class="form-group">
                                        <label class="form-label">Access Admin</label><br>
                                        <div class="form-check m-l-10">
                                            <label>
                                                <input id="indeterminate-checkbox" type="checkbox" name="access[]" value="1" <?php if (in_array("1", $access_array)){ echo "checked";} ?> />
                                                <span><i class="fas fa-search"></i> View</span>
                                            </label><br>
                                            <label>
                                                <input id="indeterminate-checkbox" type="checkbox" name="access[]" value="2" <?php if (in_array("2", $access_array)){ echo "checked";} ?> />
                                                <span><i class="fas fa-plus-square"></i> Add</span>
                                            </label><br>
                                            <label>
                                                <input id="indeterminate-checkbox" type="checkbox" name="access[]" value="3" <?php if (in_array("3", $access_array)){ echo "checked";} ?> />
                                                <span><i class="fas fa-pen-square"></i> Edit</span>
                                            </label><br>
                                            <label>
                                                <input id="indeterminate-checkbox" type="checkbox" name="access[]" value="4" <?php if (in_array("4", $access_array)){ echo "checked";} ?> />
                                                <span><i class="fas fa-trash"></i> Delete</span>
                                            </label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary waves-effect" type="submit" name="submit" value="submit">SUBMIT</button>
                                    <a href="index.php?p=admin" class="btn btn-danger waves-effect" type="submit">CANCEL</a>
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