<!-- TAB TAGGING -->
<?php
if($tab=='tagging')
{
    if($tab!="tagging")
    {
        $action_tagging="";
    }
    else
    {
        $action_tagging=$action;
    }
    if($action_tagging=="")
    {  
?>    
        <!-- Start Tables 
        <div class="row" id="socmed">-->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Tagging Table</strong></h2>
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
                                            <a href="?p=home_mng&t=tagging&a=2">
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
                                        <th>Tagging</th>
                                        <th>Numbers</th>
                                        <th>Activate</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (in_array("1", $access_admin))
                                    {
                                        $no_tagging   = 1;
                                        $query_tagging= mysqli_query($con,"SELECT * from home_mng WHERE visible!='D' AND code='3' order by id ASC");
                                        while($data_tagging=mysqli_fetch_array($query_tagging))
                                        {
                                            $id_data        = $data_tagging['id'];
                                            $tagging_data   = $data_tagging['title'];
                                            $numbers_data   = $data_tagging['description'];
                                            $visible_data   = $data_tagging['visible'];    
                                        ?>    
                                            <tr>
                                                <td style="text-align: center;"><?php echo $no_tagging ?></td>
                                                <td><?php echo $tagging_data ?></td>
                                                <td><?php echo $numbers_data ?></td>
                                                <td style="text-align: center;"><?php echo $visible_data ?></td>
                                                <td>
                                                    <?php
                                                    if (in_array("3", $access_admin))
                                                    {
                                                    ?>    
                            <a href="?p=home_mng&t=tagging&a=3&id=<?php echo $id_data ?>">
                                <button type="button" class="btn btn-warning">
                                    <i class='fas fa-pen'></i>
                                </button>
                            </a>
                                                    <?php
                                                    }
                                                    if (in_array("4", $access_admin))
                                                    {
                                                    ?>  
                            <a href="?p=home_mng&t=tagging&a=4&id=<?php echo $id_data ?>" onclick="return confirm('Are you sure want to delete ?')">  
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
                                            $no_tagging++;
                                        }
                                    }
                                    ?>    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <!--</div>    
         End Tables -->
    <?php
    }
    else
    {
        if(isset($_POST['submit_tagging']))
        {
            $tagging_data           = $_POST['tagging'];
            $numbers_data           = $_POST['numbers'];
            $visible_data           = $_POST['visible']; 
            if(empty($visible_data))
            {
                $error              = 1;
                $msg_visible        = "This field is required.";
            }  
            if(empty($error))
            {
                if($action=='2')
                {    
                    $input          = mysqli_query($con,"INSERT into home_mng (title,description,code,visible,create_by,create_date,update_by,update_date) VALUES ('$tagging_data','$numbers_data','3','$visible_data','$username','$now','$username','$now')");
                }
                elseif($action=='3') 
                {
                    $update         = mysqli_query($con,"UPDATE home_mng SET title='$tagging_data',description='$numbers_data',visible='$visible_data',update_by='$username',update_date='$now' WHERE id='$id' AND code='3'");
                }    
                if($input==1 || $update==1)
                {
                    echo "<script type='text/javascript'> alert('submitted successfully!');</script>";
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=home_mng&t=tagging">';
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
            $query_select   = mysqli_query($con,"SELECT * from home_mng WHERE id='$id' AND visible!='D' AND code='3'");
            $data_select    = mysqli_fetch_array($query_select);
            $id_data        = $data_select['id'];
            $tagging_data   = $data_select['title'];
            $numbers_data   = $data_select['description'];
            $visible_data   = $data_select['visible'];
        } 
        elseif ($action=='4') 
        {
            $delete         = mysqli_query($con,"UPDATE home_mng SET visible='D',update_by='$username',update_date='$now' WHERE id='$id' AND code='3'");
            if($delete==1)
            {
                echo "<script type='text/javascript'> alert('deleted successfully!');</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=home_mng&t=tagging">';
            }
            else
            {
                echo "<script type='text/javascript'> alert('deleted failed!');</script>";
                echo("Error description: " . $con -> error);
            }
        }
        else
        {
            $tagging_data   = "";
            $numbers_data   = "";
            $visible_data   = "";
        }    
        ?>       
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <form id="form_validation" method="POST" action="" enctype="multipart/form-data">
                        <div class="form-group form-float">
                            <label class="form-label"><b>Tagging</b></label>
                            <input type="text" class="form-control" name="tagging" value="<?php echo $tagging_data ?>" required>
                        </div>
                        <div class="form-group form-float">
                            <label class="form-label"><b>Numbers</b></label>
                            <input type="text" class="form-control" name="numbers" value="<?php echo $numbers_data ?>" required>
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
                        <button class="btn btn-primary waves-effect" type="submit" name="submit_tagging" value="submit_tagging">SUBMIT</button>
                        <a href="?p=home_mng&t=tagging" onclick="return confirm('Are you sure want to cancel ?')" style="background: #ff0000;color: white;border: white 3px solid;border-radius: 5px;padding: 8px 8px;margin-top: 10px;font-color:#fff">
                            Cancel
                        </a>
                    </form>
                </div>
            </div>
        </div>
<?php
    }
}
?>