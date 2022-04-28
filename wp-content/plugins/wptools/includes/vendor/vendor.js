/*
 * @ Author: Bill Minozzi
 * @ Copyright: 2021 www.BillMinozzi.com
 * @ Modified time: 2021-29-11 09:17:42
 * */
jQuery(document).ready(function ($) {
    // console.log('vendor-wpt');

    $("#wptools-scan-ok").click();
    $("#TB_title").hide();
    if (!$("#TB_window").is(':visible')) {
        $("#wptools-scan-ok").click();
        // console.log('auto click');
    }

    $("*").on('keydown', function(event) {
        if (event.key == "Escape") {
            jQuery.ajax({
                method: 'post',
                url: ajaxurl,
                data: {
                    action: "wptools_bill_go_pro_hide"
                },
                success: function (data) {
                     console.log('OK-dismissed!!!');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('error' + errorThrown + ' ' + textStatus);
                }
            });
            self.parent.tb_remove();
            $('#TB_window').fadeOut();
            $("#TB_closeWindowButton").click();
        }
    });

    $("*").click(function (ev) {


      //  ev.preventDefault();

        //  alert('2');
        // console.log('click');
        // console.log(ev.target.id);
         //$(this).attr("class");
        // console.log($(this).attr("class"));



        if (ev.target.id == "bill-vendor-button-ok-wpt") {
         //    console.log("Learn More");
            window.location.replace("http://wptoolsplugin.com/premium//");
        }


        if (ev.target.id == "bill-vendor-button-again-wpt") {
           //  console.log("watch again");
           // $("#bill-banner-wpt").get(0).play();
            $("#bill-banner-wpt").get(0).play().catch(function () {
                // console.log("Fail to Play.");
                self.parent.tb_remove();
                $('#TB_window').fadeOut();
                $("#TB_closeWindowButton").click();
            });

        }

        if ( ev.target.id == "bill-vendor-button-dismiss-wpt" || $(this).attr("class") == "tb-close-icon"  ) {
            // event.preventDefault()
            // console.log('clicked !!!!!!');
            jQuery.ajax({
                method: 'post',
                url: ajaxurl,
                data: {
                    action: "wptools_bill_go_pro_hide"
                },
                success: function (data) {
                   // console.log('OK-dismissed!!!');
                    // return data;
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('error' + errorThrown + ' ' + textStatus);
                }
            });
            //console.log("fechar");
            self.parent.tb_remove();
            // $("#TB_window").hide();
            // TB_closeWindowButton
            $('#TB_window').fadeOut();
            $("#TB_closeWindowButton").click();

        }

    }); // click


    if ($('#bill-banner-wpt').length) {
        //  $("#bill-banner-wpt").get(0).play();
        $("#bill-banner-wpt").get(0).play().catch(function () {
            // console.log("Fail to Play.");
            self.parent.tb_remove();
            $('#TB_window').fadeOut();
            $("#TB_closeWindowButton").click();
        });
    }


    $("#TB_window").height(260);
    $("#TB_window").width(550);
    $("#TB_window").addClass("bill_TB_window");
});