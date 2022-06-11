<!-- TAB BRANCH OFFICE -->
<?php
if($tab=='branch')
{
    if($tab!="branch")
    {
        $action_branch="";
    }
    else
    {
        $action_branch=$action;
    }
    if($action_branch=="")
    {  
?>    
        <!-- Start Tables -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Branch Office</strong></h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="background: rgba(41, 41, 43, 1);padding-top: 20px;border-radius: 20px;">
                                <div class="box-part text-center">
                                    <div class="title p-t-15">
                                        <h3>Indonesia Branch</h3>
                                    </div>
                                    <a href="?p=contact_mng&t=branch&a=1&id=2&sa=2">
                                        <button id="addRow" class="btn btn-info">
                                            Add Branch
                                        </button>
                                    </a>
                                    &nbsp&nbsp
                                    <br><br><br><br>
                                    <div class="table-responsive">
                                        <table class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Branch</th>
                                                    <th>Address</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="font-size: x-small;">
                                                <?php
                                                $i=1;
                                                $query_subbranch  = mysqli_query($con,"SELECT * from contact_mng WHERE visible!='D' AND parentid='2'");
                                                while($data_subbranch=mysqli_fetch_array($query_subbranch))
                                                {
                                                    $id_subbranch       = $data_subbranch['id'];
                                                    $location_subbranch = $data_subbranch['location'];
                                                    $address_subbranch  = $data_subbranch['address'];
                                                    $phone_subbranch    = $data_subbranch['phone'];
                                                    $email_subbranch    = $data_subbranch['email'];
                                                    $visible_subbranch  = $data_subbranch['visible'];
                                                ?>
                                                <tr>
                                                    <td style="text-align: center;"><?php echo $i ?></td>
                                                    <td><?php echo $location_subbranch ?></td>
                                                    <td><?php echo $address_subbranch ?></td>
                                                    <td><?php echo $phone_subbranch ?></td>
                                                    <td><?php echo $email_subbranch ?></td>
                                                    <td>
                                                        <?php
                                                        if (in_array("3", $access_admin))
                                                        {
                                                        ?>    
                                                            <a href="?p=contact_mng&t=branch&a=1&id=2&sa=3&sid=<?php echo $id_subbranch ?>">
                                                                <button id="addRow" class="btn btn-warning btn-sm">
                                                                    <i class='fas fa-pen' style="font-size: xx-small;"></i>
                                                                </button>
                                                            </a>
                                                        <?php
                                                        }
                                                        if (in_array("4", $access_admin))
                                                        {
                                                        ?>  
                                                            <a href="?p=contact_mng&t=branch&a=1&id=2&sa=4&sid=<?php echo $id_subbranch ?>" onclick="return confirm('Are you sure want to cancel ?')>
                                                                <button id="addRow" class="btn btn-danger btn-sm">
                                                                    <i class='fas fa-trash' style="font-size: xx-small;"></i>
                                                                </button>
                                                            </a>    
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                    $i++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>           
                                    </div> 
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="background: rgba(41, 41, 43, 1);padding-top: 20px;border-radius: 20px;">
                                <div class="box-part text-center">
                                    <div class="title p-t-15">
                                        <h3>International Branch</h3>
                                    </div>
                                    <a href="?p=contact_mng&t=branch&a=1&id=3&sa=2">
                                        <button id="addRow" class="btn btn-info">
                                            Add Branch
                                        </button>
                                    </a>
                                    &nbsp&nbsp
                                    <br><br><br><br>
                                    <div class="table-responsive">
                                        <table class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Branch</th>
                                                    <th>Address</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="font-size: x-small;">
                                                <?php
                                                $i=1;
                                                $query_subbranch  = mysqli_query($con,"SELECT * from contact_mng WHERE visible!='D' AND parentid='3'");
                                                while($data_subbranch=mysqli_fetch_array($query_subbranch))
                                                {
                                                    $id_subbranch       = $data_subbranch['id'];
                                                    $location_subbranch = $data_subbranch['location'];
                                                    $address_subbranch  = $data_subbranch['address'];
                                                    $phone_subbranch    = $data_subbranch['phone'];
                                                    $email_subbranch    = $data_subbranch['email'];
                                                    $visible_subbranch  = $data_subbranch['visible'];
                                                ?>
                                                <tr>
                                                    <td style="text-align: center;"><?php echo $i ?></td>
                                                    <td><?php echo $location_subbranch ?></td>
                                                    <td><?php echo $address_subbranch ?></td>
                                                    <td><?php echo $phone_subbranch ?></td>
                                                    <td><?php echo $email_subbranch ?></td>
                                                    <td>
                                                        <?php
                                                        if (in_array("3", $access_admin))
                                                        {
                                                        ?>    
                                                            <a href="?p=contact_mng&t=branch&a=1&id=3&sa=3&sid=<?php echo $id_subbranch ?>">
                                                                <button id="addRow" class="btn btn-warning btn-sm">
                                                                    <i class='fas fa-pen' style="font-size: xx-small;"></i>
                                                                </button>
                                                            </a>
                                                        <?php
                                                        }
                                                        if (in_array("4", $access_admin))
                                                        {
                                                        ?>  
                                                            <a href="?p=contact_mng&t=branch&a=1&id=3&sa=4&sid=<?php echo $id_subbranch ?>" onclick="return confirm('Are you sure want to cancel ?')>
                                                                <button id="addRow" class="btn btn-danger btn-sm">
                                                                    <i class='fas fa-trash' style="font-size: xx-small;"></i>
                                                                </button>
                                                            </a>    
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                    $i++;
                                                }
                                                ?>
                                            </tbody>
                                        </table> 
                                    </div>
                                </div>
                            </div>     
                        </div>     
                    </div>
                </div>
            </div>
        </div>    
        <!-- End Tables -->
    <?php
    }
    elseif(isset($action_branch) && isset($subact))
    {
        if(isset($_POST['submit_subbranch']))
        {
            $location_subbranch     = $_POST['location'];
            $address_subbranch      = $_POST['address'];
            $phone_subbranch        = $_POST['phone'];
            $email_subbranch        = $_POST['email'];
            $visible_subbranch      = $_POST['visible'];
            if(empty($error))
            {
                if($subact=='2')
                {    
                    $input          = mysqli_query($con,"INSERT into contact_mng (parentid,code,location,address,phone,email,visible,create_by,create_date,update_by,update_date) VALUES ('$id','1','$location_subbranch','$address_subbranch','$phone_subbranch','$email_subbranch','Y','$username','$now','$username','$now')");
                }
                elseif($subact=='3') 
                {
                    $update         = mysqli_query($con,"UPDATE contact_mng SET location='$location_subbranch',address='$address_subbranch',phone='$phone_subbranch',email='$email_subbranch',update_by='$username',update_date='$now' WHERE id='$sid' AND parentid='$id'");
                }    
                if($input==1 || $update==1)
                {
                    echo "<script type='text/javascript'> alert('submitted successfully!');</script>";
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=contact_mng&t=branch">';
                }
                else
                {
                    echo "<script type='text/javascript'> alert('submitted failed!');</script>";
                    echo("Error description: " . $con -> error);
                }    
            }
        }
        elseif($subact=='3')
        {
            $txt_subform        = "EDIT";
            $query_select       = mysqli_query($con,"SELECT * from contact_mng WHERE id='$sid' AND parentid='$id' AND visible!='D'");
            $data_select        = mysqli_fetch_array($query_select);
            $id_subbranch       = $data_select['id'];
            $location_subbranch = $data_select['location'];
            $address_subbranch  = $data_select['address'];
            $phone_subbranch    = $data_select['phone'];
            $email_subbranch    = $data_select['email'];
        } 
        elseif ($subact=='4') 
        {
            $delete         = mysqli_query($con,"UPDATE contact_mng SET visible='D',update_by='$username',update_date='$now' WHERE id='$sid' AND parentid='$id'");
            if($delete==1)
            {
                echo "<script type='text/javascript'> alert('deleted successfully!');</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=contact_mng&t=branch">';
            }
            else
            {
                echo "<script type='text/javascript'> alert('deleted failed!');</script>";
                echo("Error description: " . $con -> error);
            }
        }
        else
        {
            $txt_subform            = "NEW"; 
            $query_branch_detail    = mysqli_query($con,"SELECT * from contact_mng WHERE id='$id' AND visible!='D'");
            $data_branch_detail     = mysqli_fetch_array($query_branch_detail);
            $location_branch        = $data_branch_detail['location'];
            $location_subbranch     = "";
            $address_subbranch      = "";
            $phone_subbranch        = "";
            $email_subbranch        = "";
        }    
    ?>       
        <!-- Start Form -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2><strong><?php echo $txt_subform." ".$location_branch ?></strong></h2>
                    </div>
                    <div class="body">
                        <form id="form_validation" method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group form-float">
                                <label class="form-label"><b>Location</b></label>
                                <input type="text" class="form-control" name="location" value="<?php echo $location_subbranch ?>" required>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label"><b>Address</b></label>
                                <textarea name="address" style="margin-top: 0px; margin-bottom: 0px; height: 70px;"><?php echo $address_subbranch ?></textarea>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label"><b>Phone</b></label>
                                <input type="text" class="form-control" name="phone" value="<?php echo $phone_subbranch ?>">
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label"><b>Email</b></label>
                                <input type="text" class="form-control" name="email" value="<?php echo $email_subbranch ?>">
                            </div>
                            <button class="btn btn-primary waves-effect" type="submit" name="submit_subbranch" value="submit">SUBMIT</button>
                            <a href="?p=contact_mng&t=branch" onclick="return confirm('Are you sure want to cancel ?')" style="background: #ff0000;color: white;border: white 3px solid;border-radius: 5px;padding: 8px 8px;margin-top: 10px;font-color:#fff">
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