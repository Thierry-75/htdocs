/**
 * @ Author: Bill Minozzi
 * */
 jQuery(document).ready(function ($) {
     // console.log('ok-22');
     var cpuTotalArray = ['0'];
     var cpuUsedArray = ['0'];
    function wptools_processor_run() {
      // console.log('ok-23');
            jQuery.ajax({
                url: ajaxurl,
                type: "POST",
                data: {
                    'action': 'wptools_get_ajax_data'
                },
                success: function (data) {
                    // console.log(data);
                     try {
                        var myjson = JSON.parse(data);
                      } catch (error) {
                         // console.error(error);
                        return;
                      }
                    //  console.log(myjson);


                  // console.log(typeof myjson['proc_stat_cpu_total']);
                  // console.log(typeof myjson['proc_stat_cpu_usage']);

                  if(typeof myjson['proc_stat_cpu_total'] == 'number' && typeof myjson['proc_stat_cpu_usage'] == 'number' ) {
                
                    cpuTotalArray.unshift(myjson['proc_stat_cpu_total']); //calculate and update the cpu usage
                    cpuUsedArray.unshift(myjson['proc_stat_cpu_usage']);
                    var cpuTotalDiff = (cpuTotalArray[0] - cpuTotalArray[1]);
                    var cpuUsedDiff = (cpuUsedArray[0] - cpuUsedArray[1]);
                    var load = ((cpuUsedDiff/cpuTotalDiff) * 100).toFixed(0);
                    if(load != 'NaN'){
                        $("#wptools_proc_load").html(load+'%');
                    }

                    // console.log(typeof lineCPU );
                    if(typeof lineCPU !== "undefined"){
                      lineCPU.append(new Date().getTime(), ((cpuUsedDiff/cpuTotalDiff) * 100).toFixed(1) );
                    }


                  }


                if(typeof myjson['load_1'] != 'undefined' && typeof myjson['load_1'] != null ){
                  //console.log(typeof myjson['load_1']);
                  // if(typeof document.getElementById("load_1") != null ) {
                  if (typeof document.getElementById("load_1") !== 'undefined' && document.getElementById("load_1")) {
                    document.getElementById("load_1").innerHTML = myjson['load_1'];
                    document.getElementById("load_5").innerHTML = myjson['load_5'];
                    document.getElementById("load_15").innerHTML = myjson['load_15'];
                    document.getElementById("cores").innerHTML = myjson['cores'];
                  }
                }

                },
                error: function (xhr, status, error) {
                    console.log('Ajax Error Get Processor: '+error);
                    console.log('Status: '+status);
                    console.log('Error Status Code: '+xhr.status);
                },
                timeout: 5000
            });
    }
        setInterval(wptools_processor_run, '5000');
if (    !(typeof(SmoothieChart)=='undefined')   ) {
    var smoothieCPU = new SmoothieChart({grid:{fillStyle:'#ffffff', strokeStyle:'white', sharpLines:true}, labels:{disabled:true}, maxValue:100, minValue:0, millisPerPixel:200});
    if(typeof document.getElementById("chart_cpuhistory") !== 'object') {
        return;
    }
    smoothieCPU.streamTo(document.getElementById("chart_cpuhistory"));
    var lineCPU = new TimeSeries();
    smoothieCPU.addTimeSeries(lineCPU, {strokeStyle:'red', lineWidth:3 });
}
wptools_processor_run();
});
