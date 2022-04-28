<?php
/**
 * @ Author: Bill Minozzi
 * @ Copyright: 2020 www.BillMinozzi.com
 * @ Modified time: 2021-03-19 10:20:31
 */
// http://codylindley.com/thickbox/
if (!defined('ABSPATH'))
  exit; // Exit if accessed directly
add_thickbox();
$is_modal = "&modal=true";
$is_modal = "&modal=false";
$is_modal = "";
if (empty($is_modal))
  $wheight = "400";
else
  $wheight = "300";
?>
<div style="display:none; max-width:530px !important;">
    <a href="#TB_inline?&width=530&height=290&inlineId=wptools-scan-id<?php echo $is_modal; ?>" id="wptools-scan-ok"
        class="thickbox" title="WP Tools Plugin"  style="display:none;">xx---xxx</a>
</div>
<div id="wptools-scan-id" style="display:none;">
    <div class="bill-parent">
        <div class="bill-child-cols" style="margin-top:5px;">
            <video id="bill-banner-wpt" style="margin: 0px; padding:0px;" width="400" height="240" muted>
                <source src="<?php echo WPTOOLSURL; ?>assets/videos/tools3.mp4" type="video/mp4">
            </video>
        </div>
        <div class="bill-child-cols" style="margin-left:20px;">
            <a href="#" id="bill-vendor-button-ok-wpt" style="margin-top: 0px !important; margin-right:0px;"
                class="button button-primary"><?php esc_attr_e("Learn More","wptools");?></a>
            <br>
            <br>
            <a href="#" id="bill-vendor-button-again-wpt" style="margin-top: 0px !important;" class="button"
                style="margin-left: 20px;"><?php esc_attr_e("Watch Again","wptools");?></a>
            <br>
            <br>
            <a href="#" id="bill-vendor-button-dismiss-wpt" class="button" style="margin-left:0px;"><?php esc_attr_e("Dismiss","wptools");?></a>
        </div>
    </div>
</div>
<?php
return;