/*
* LMPixels templates demo panel
* Author: LMPixels (Linar Miftakhov)
* Author URL: http://themeforest.net/user/lmpixels
* Version: 1.0
*/

function styleSwitcher(){
    var demoPanel = $("#lm_demo_panel"),
        demoPanelSwitcher = $("#lm_demo_panel_switcher");

    $(window).on("click", function () {
        $("#lm_demo_panel.active").removeClass("active");
    });

    demoPanelSwitcher.on("click", function (event) {
        event.stopPropagation();
        demoPanel.toggleClass("active");
    });

    demoPanel.on("click", function (event) {
        event.stopPropagation();
    });
};
