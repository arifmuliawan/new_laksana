<?php
require('connection.php');
$username           = $_SESSION['username'];
$page               = $_GET['p'];
?>    
    <div>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="sidebar-user-panel active">
                        <div class="user-panel">
                            <div class="image">
                                <img src="assets/images/laksana/logo-laksana.png" alt="Logo Designata"/>
                            </div>
                        </div>
                        <div class="profile-usertitle">
                            <div class="sidebar-userpic-name"> <?php echo $username ?> </div>
                        </div>
                    </li>
                    <li>
                        <a href="?p=admin">
                            <?php
                            if($page=='admin')
                            {
                                echo '<font color="#fff"><i class="fas fa-check-circle"></i></font>';
                            }
                            else 
                            {
                                echo '<font color="#666"><i class="far fa-circle"></i>';        # code...
                            }        
                            ?>
                            <span>Admin Management</span>
                        </a>
                    </li>
                    <?php
                    if($username=='developer')
                    {
                    ?>    
                    <li>
                        <a href="?p=menu_mng">
                            <?php
                            if($page=='menu_mng')
                            {
                                echo '<font color="#fff"><i class="fas fa-check-circle"></i></font>';
                            }
                            else 
                            {
                                echo '<font color="#666"><i class="far fa-circle"></i>';        # code...
                            }        
                            ?>
                            <span>Menu Management</span>
                        </a>
                    </li>
                    <?php
                    }
                    ?>
                    <li>
                        <a href="?p=home_mng">
                            <?php
                            if($page=='home_mng')
                            {
                                echo '<font color="#fff"><i class="fas fa-check-circle"></i></font>';
                            }
                            else 
                            {
                                echo '<font color="#666"><i class="far fa-circle"></i>';        # code...
                            }        
                            ?>
                            <span>Home Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="?p=contact">
                            <?php
                            if($page=='contact')
                            {
                                echo '<font color="#fff"><i class="fas fa-check-circle"></i></font>';
                            }
                            else 
                            {
                                echo '<font color="#666"><i class="far fa-circle"></i>';        # code...
                            }        
                            ?>
                            <span>Contact Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="?p=logout">
                            <?php
                            if($page=='logout')
                            {
                                echo '<font color="#666"><i class="fas fa-check-circle"></i></font>';
                            }
                            else 
                            {
                                echo '<font color="#666"><i class="far fa-circle"></i>';        # code...
                            }        
                            ?>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
        </aside>
        <!-- #END# Left Sidebar -->
    </div>