<?php
class Site_setting {

    function setSetting(){ 

        define('APPLICATION_MODE', 'demo'); 

        if (APPLICATION_MODE == 'demo') {
            # Load the URI core class
            $uri =& load_class('URI', 'core'); 

            # Get the third segment
            $get_second_uri = $uri->segment(2); // returns the id

            $first_six_letter = substr($get_second_uri, 0, 6); 
            if ($first_six_letter == "delete") { 
                echo "<h2 style='color: red; margin-top: 15%; text-align: center;'>Deleting is not allowed in demo mode!</h2>";
                echo "<p style='color: red; text-align: center;'><a href='".base_url()."Authentication/userProfile'</a>Click to Return</p>"; 
                exit;
            }

            if ($get_second_uri == 'setting' || $get_second_uri == 'changeProfile' || $get_second_uri == 'changePassword' ) {
                if (!empty($_POST['submit'])) {
                    echo "<h2 style='color: red; margin-top: 15%; text-align: center;'>Not allowed in demo mode!</h2>";
                    echo "<p style='color: red; text-align: center;'><a href='".base_url()."Authentication/userProfile'</a>Click to Return</p>"; 
                    exit;
                }
            }
        }

    }
}
?>