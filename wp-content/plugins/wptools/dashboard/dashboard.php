<?php
/**
 * @author William Sergio Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
$site = WPTOOLSADMURL . "admin.php?page=wp-tools";
$site = WPTOOLSADMURL . "admin.php?page=wp-tools&tab=memory_usage";
$site = WPTOOLSADMURL . "admin.php?page=settings-wptools&tab=";


// https://wptoolsplugin.com/wp-admin/admin.php?page=settings-wptools&tab=uso_della_memoria
?>
<style>
#bkg_cpu_history {
    width: 45px;
    min-width: 45px;
    background-image: url("<?php echo esc_url(WPTOOLSURL) . 'images/pct.png'; ?>");
    height: 200px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    border: 0px;
}
</style>
<div id="wptools-steps3">
    <div class="wptools-block-title">
        <?php esc_attr_e("WP Tools Dashboard","wptools");?>
    </div>
    <div class="wptools-help-container1">
        <div style="max-width: 25% !important;" class="wptools-help-column wptools-help-column-1">
            <div class="bill-dashboard-titles2"><?php esc_attr_e("Memory Usage","wptools");?></div>
            <br /> <br />
            <?php
            /*
            $ds = 256;
            $du = 60;
            */
            $wptools_memory = wptools_check_memory();
            if ($wptools_memory['msg_type'] == 'notok') {
                esc_attr_e("Unable to get your Memory Info","wptools"); 
            } else {
                $ds = $wptools_memory['wp_limit'];
                $du = $wptools_memory['usage'];
                if ($ds > 0)
                    $perc = number_format(100 * $du / $ds, 0);
                else
                    $perc = 0;
                if ($perc > 100)
                    $perc = 100;
                //die($perc);
                $color = '#e87d7d';
                $color = '#029E26';
                if ($perc > 50)
                    $color = '#e8cf7d';
                if ($perc > 70)
                    $color = '#ace97c';
                if ($perc > 50)
                    $color = '#F7D301';
                if ($perc > 70)
                    $color = '#ff0000';
                $initValue = $perc;
                require_once "circle_memory.php";

                $wptools_tab = trim(str_replace(' ','_',remove_accents(__('Memory Usage','wptools'))));

            ?>
            <br /> <br />
            <?php esc_attr_e("For details,","wptools");?>
            <a href="<?php echo strtolower(esc_url($site.$wptools_tab)); ?>">
                <?php esc_attr_e("click","wptools");?>
            </a>
            <?php esc_attr_e("the Settings => Memory Usage Tab.","wptools");?>
            <?php } ?>
        </div>
        <!-- "Column1">  -->
        <div style="max-width: 45% !important; text-align:center; margin-right: 30px;"
            class="wptools-help-column wptools-help-column-2">
            <div class="bill-dashboard-titles2"><?php esc_attr_e("CPU Usage","wptools");?></div>
            <?php esc_attr_e("Load average:","wptools");?> <span id="load_1"></span> &nbsp;<span id="load_5"></span>&nbsp; <span id="load_15"></span><br>
            <?php esc_attr_e("Number Cores:","wptools");?> <span id="cores"></span><br><br>
            <table border="1" width="100%" style="text-align:left; border: 1px solid gray; border-collapse: collapse;">
                <tr>
                    <td colspan="2" style="padding-right: 2px; border:0px;">
                        <img src="<?php echo plugins_url('../images/pixel.png', __FILE__); ?>" width="5px">
                        <canvas id="chart_cpuhistory" width="330" height="150"
                            style="height:150px;width:100%;"></canvas><br>
                    </td>
                    <td id="bkg_cpu_history">
                    </td>
                </tr>
                <tr>
                </tr>
            </table>
        </div>
        <!-- "Column 3">  -->
        <div style="max-width: 25% !important;" class="wptools-help-column wptools-help-column-2">
            <div class="bill-dashboard-titles2"><?php esc_attr_e("Disk Usage","wptools");?></div>
            <br /> <br />
            <?php 
           try{
            if (function_exists("disk_free_space") and function_exists("disk_total_space") ) 
                require_once "circle_disc.php"; 
           }
           catch (Exception $e) {
           }
           $wptools_tab = strtolower(trim(str_replace(' ','_',remove_accents(__('Disk Usage','wptools')))));

            ?>
            <br /> <br />
            <?php esc_attr_e("For details,","wptools");?>
            <?php $site = WPTOOLSADMURL . "admin.php?page=settings-wptools&tab=".$wptools_tab; ?>
            <a href="<?php echo esc_url($site); ?>">
                <?php esc_attr_e("click","wptools");?>
            </a>
            <?php esc_attr_e("the Settings =>Disk Usage Tab.","wptools");?>
        </div> <!-- "Column 3 end " -->
    </div> <!-- "Container 1 " -->
</div> <!-- "wptools-steps3"> -->
<!-- raw 2 -->
<div id="wptools-services3">
    <!--
     <div class="wptools-block-title">
      Help, Demo, Support, Troubleshooting:
    </div>
    -->
    <div class="wptools-help-container1">
        <div class="wptools-help-column wptools-help-column-1">
            <div class="wptools-dash-server">
                <b><?php esc_attr_e("OS type & version","wptools");?></b>
                <br /><br />
                <?php
                $os = wptools_OSName();
                if ($os) {
                    echo trim(esc_attr($os));
                } else {
                    esc_attr_e('Check tab "Server Check & Requirements"',"wptools");
                }
            ?>
            </div>
        </div> <!-- "Column1">  -->
        <div class="wptools-help-column wptools-help-column-2">
            <div class="wptools-dash-server">
                <b><?php esc_attr_e("Server Uptime (since reboot)","wptools");?></b>
                <br /><br />
                <?php
            try{
                if (function_exists("shell_exec"))
                    $result = shell_exec('uptime -p');
                else
                    $result = false;
            }
            catch (Exception $e) {
                $result = false;
            }
            if ($result) {
                echo esc_attr($result);
            } else {
                esc_attr_e('Check tab "Server Check & Requirements"',"wptools");
            }
            ?>
            </div>
        </div> <!-- "columns 2">  -->
        <div class="wptools-help-column wptools-help-column-3">
            <div class="wptools-dash-server">
                <b><?php esc_attr_e("Server CPU cores and architecture","wptools");?></b>
                <br />
                <br />
                <?php
            try{
                if (@is_readable('/proc/cpuinfo')) {
                    $cpuinfo = @file_get_contents('/proc/cpuinfo');
                    if(gettype($cpuinfo) === 'boolean'){
                       echo "-";
                    }
                    else {
                        preg_match_all('/^processor/m', $cpuinfo, $matches);
                        $file = file('/proc/cpuinfo');
                        $proc_details = $file[4];
                        echo count($matches[0]) . ' x ' . esc_attr(substr($proc_details, 13));
                    }
                } else {
                    echo "-";
                }
            }
            catch (Exception $e) {
                echo "-";
            }
            ?>
            </div>
        </div> <!-- "Column 3">  -->
    </div> <!-- "Container1 ">  -->
    <!--
     <div class="wptools-block-title">
      Help, Demo, Support, Troubleshooting:
    </div>
    -->
    <div class="wptools-help-container1">
        <div class="wptools-help-column wptools-help-column-1">
            <div class="wptools-dash-server">
                <b><?php esc_attr_e("Hostname","wptools");?></b>
                <br />
                <br />
                <?php
            echo gethostname()
            ?>
                <br />
                <br />
            </div>
        </div> <!-- "Column1">  -->
        <div class="wptools-help-column wptools-help-column-2">
            <div class="wptools-dash-server">
                <b><?php esc_attr_e("Server IP","wptools");?></b>
                <br />
                <?php
            $ip_server = $_SERVER['SERVER_ADDR'];
            if (filter_var($ip_server, FILTER_VALIDATE_IP)) {
                if($ip_server == '127.0.0.1' )
                   echo __('Unable to get your server Ip. Probably blocked by your hosting company.');
                else 
                   echo $ip_server;
            } else {
                echo __('Unable to get your server Ip. Probably blocked by your hosting company.');
            }
            ?>
            </div>
        </div> <!-- "columns 2">  -->
        <div class="wptools-help-column wptools-help-column-3">
            <div class="wptools-dash-server">
                <b><?php esc_attr_e("Web Server Soft","wptools");?></b>
                <br />
                <?php
            echo esc_attr($_SERVER['SERVER_SOFTWARE']);
            ?>
            </div>
        </div> <!-- "Column 3">  -->
    </div> <!-- "Container1 ">  -->
</div> <!-- "services"> -->
<!-- raw 4 -->
<div id="wptools-services3">
    <div class="wptools-help-container1">
        <div class="wptools-help-column wptools-help-column-1">
            <img alt="aux" src="<?php echo esc_url(WPTOOLSURL) ?>images/service_configuration.png" />
            <div class="bill-dashboard-titles">
            <br>
            <?php esc_attr_e("Start Up Guide and Settings","wptools");?></div>
            <br>
            <?php esc_attr_e("Just click Settings in the left menu (WP Tools).","wptools");?>
            <br />
            <?php esc_attr_e("Dashboard => WP Tools => Settings","wptools");?>
            <br />
            <?php $site = esc_url(WPTOOLSADMURL) . "admin.php?page=settings-wptools";?>
            <a href="<?php echo esc_url($site); ?>" class="button button-primary"><?php esc_attr_e("Go","wptools");?></a>
            <br /><br />
        </div> <!-- "Column1">  -->
        <div class="wptools-help-column wptools-help-column-2">
            <img alt="aux" src="<?php echo esc_url(WPTOOLSURL); ?>images/support.png" />
            <div class="bill-dashboard-titles"> 
            <br>
            <?php esc_attr_e("Blog, Support...","wptools");?></div>
            <br />
            <?php esc_attr_e("You will find our Blog with tips about this tool, link to support and more in our site.","wptools");?>
            <br />
            <?php $site = 'http://wptoolsplugin.com'; ?>
            <a href="<?php echo esc_url($site); ?>" class="button button-primary"><?php esc_attr_e("Go","wptools");?></a>
        </div> <!-- "columns 2">  -->
        <div class="wptools-help-column wptools-help-column-3">
            <img alt="aux" src="<?php echo esc_url(WPTOOLSURL); ?>images/system_health.png" />
            <div class="bill-dashboard-titles">
            <br>
            <?php esc_attr_e("Troubleshooting Guide","wptools");?></div>
            <br>
            <?php esc_attr_e("Use old WP version, Low memory, some plugin with Javascript error are some possible problems.","wptools");?>
            <br />
            <a href="http://siterightaway.net/troubleshooting/" class="button button-primary"><?php esc_attr_e("Troubleshooting Page","wptools");?></a>
        </div> <!-- "Column 3">  -->
    </div> <!-- "Container1 ">  -->
</div> <!-- "services"> -->
