(function($){

    window.RTMegaMenuAdmin = {

    init: function() {
         $( document )
             .on( 'click.RTMegaMenuAdmin', '.save-rtmega-menu', this.saveMenuOptions )
             .on( 'click.RTMegaMenuAdmin', '.rtmega-menu-opener', this.openMegaMenuModal )
             .on( 'click.RTMegaMenuAdmin', '.rtmega-menu-modal-closer', this.closeMegaMenuModal )
             .on( 'click.RTMegaMenuAdmin', '.save-rt-menu-item-options', this.updateRtmegaMenuItemSettings )
             .on( 'click.RTMegaMenuAdmin', '.delete-rt-menu-item-options', this.deleteRtmegaMenuItemSettings )
             .on( 'click.RTMegaMenuAdmin', '.rtmega_pro_warning_img', this.alertForLicenseActive )
             .on( 'click.RTMegaMenuAdmin', '.rtmega_set_icon_toggle_in_nav_item_free', this.alertForLicenseActive )
             .on( 'click.RTMegaMenuAdmin', '.rtmega-notice .notice-dismiss', this.ignorePluginNotice )
             ;
    },
    alertForLicenseActive: function () { 
        alert(rtmegamenu_ajax.rtmega_pro_warning_msg);
    },
    ignorePluginNotice: function (that) { 

        let notice_id = $(this).parent().data('notice_id');

        $.ajax({
            type: 'POST',
            url: rtmegamenu_ajax.ajaxurl,
            data: {
                action    : "rtmega_ignore_plugin_notice",
                notice_id : notice_id,
                nonce : rtmegamenu_ajax.nonce,
            },
            cache: false,
        });
    },
    openMegaMenuModal: function (that) { 
        $('#rtmega-menu-setting-modal').css('display', 'flex');
        $('div#rtmega-menu-setting-modal #tabs-nav li').removeClass('active');
        $('div#rtmega-menu-setting-modal #tabs-nav li:first-child').addClass('active');
        let menuItemId = $(this).attr('data-menu_item_id');
        $('.save-rt-menu-item-options').attr('data-menu_item_id', menuItemId);
        $('.delete-rt-menu-item-options').attr('data-menu_item_id', menuItemId);
        RTMegaMenuAdmin.showMegaMenuModalAjaxLoader($(this));
        RTMegaMenuAdmin.getMenuItemOptions(menuItemId);
    },
    closeMegaMenuModal: function () {
        $('#rtmega-menu-setting-modal').css('display', 'none');
    },
    showMegaMenuModalAjaxLoader: function () { 
        $('#rtmega-menu-setting-modal .ajax-loader').css('display', 'flex');
    },
    hideMegaMenuModalAjaxLoader: function () {
        $('#rtmega-menu-setting-modal .ajax-loader').css('display', 'none');
    },
    deleteRtmegaMenuItemSettings: function( that ){
        RTMegaMenuAdmin.showMegaMenuModalAjaxLoader($(this));
        let menu_id = $("#nav-menu-meta-object-id").val();
        let menu_item_id = $(this).attr('data-menu_item_id');
        let status_form = $('#rtmega-menu-setting-modal .form-status');

        $.ajax({
            type: 'POST',
            url: rtmegamenu_ajax.ajaxurl,
            data: {
                action          : "rtmega_delete_menu_options",
                menu_id         : menu_id,
                menu_item_id    : menu_item_id,
                nonce : rtmegamenu_ajax.nonce,
            },
            cache: false,
            success: function(response) {
                if(response.success == true){
                    $(status_form).html('<span class="rtmega-text-success">Settings Deleted!</span>');
                    setTimeout(() => {
                        $(status_form).html('');
                        location.reload();
                    }, 2000);
                    RTMegaMenuAdmin.hideMegaMenuModalAjaxLoader($(this));
                }
                
            }
        });
    },
    getMenuItemOptions: function (menu_item_id) { 
        $.ajax({
            type: 'POST',
            url: rtmegamenu_ajax.ajaxurl,
            data: {
                action          : "rtmega_get_menu_options",
                menu_item_id    : menu_item_id,
                nonce : rtmegamenu_ajax.nonce,
            },
            cache: false,
            success: function(response) {
                $('#rtmega-menu-setting-modal .tab-contents-wrapper').html(response);
                RTMegaMenuAdmin.hideMegaMenuModalAjaxLoader($(this));
            }
        });
    },

    saveMenuOptions: function( that ){
        var spinner = $(this).parent().parent().find('.ajax-loader');
        spinner.addClass('show');
        

        let menu_id = $("#nav-menu-meta-object-id").val();

        var settings = {
                'enable_menu': $(".rt_mega_menu_switch").is(':checked') === true  ? 'on' : 'off'
            };
        
        $.ajax({
            type: 'POST',
            url: rtmegamenu_ajax.ajaxurl,
            data: {
                action          : "rtmega_update_menu_options",
                actualAction    : 'saveMenuOptions',
                settings        : settings,
                menu_id         : menu_id,
                nonce : rtmegamenu_ajax.nonce,
            },
            cache: false,
            success: function(response) {
                // $('.rtmega-menu-switch-wrapper .ajax-loader').removeClass('show');
                location.reload();
            }
        });

    },

    updateRtmegaMenuItemSettings: function( that ){

        let footerAction = $(this).attr('data-action');
        RTMegaMenuAdmin.showMegaMenuModalAjaxLoader($(this));
        let menu_id = $("#nav-menu-meta-object-id").val();
        let menu_item_id = $(this).attr('data-menu_item_id');

        // let settings = $('#rtmega_menu_items_settings').serialize();
        // let css = $('#rtmega_menu_items_css').serialize();
        let status_form = $('#rtmega-menu-setting-modal .form-status');

        let css = {};
        let settings = {};


        // Iterate over each input in the form
        $('#rtmega_menu_items_settings').find('input, select').each(function() {
            // Exclude the submit button from the values
            if ($(this).attr('type') !== 'submit' && $(this).attr('name') !== 'search_rt_icon') {
                settings[$(this).attr('name')] = $(this).val();
            }
        });

        // Iterate over each input in the form
        $('#rtmega_menu_items_css').find('input, select').each(function() {
            // Exclude the submit button from the values
            if ($(this).attr('type') !== 'submit') {
                css[$(this).attr('name')] = $(this).val();
            }
        });


        $.ajax({
            type: 'POST',
            url: rtmegamenu_ajax.ajaxurl,
            data: {
                action          : "rtmega_update_menu_options",
                actualAction    : 'saveMenuItemSettings',
                settings        : settings,
                css             : css,
                menu_id         : menu_id,
                menu_item_id    : menu_item_id,
                nonce : rtmegamenu_ajax.nonce,
            },
            cache: false,
            success: function(response) {

                if(response.success == true){
                    $(status_form).html('<span class="rtmega-text-success">Settings Saved!</span>');
                    setTimeout(() => {
                        $(status_form).html('');
                    }, 2000);
                    RTMegaMenuAdmin.hideMegaMenuModalAjaxLoader($(this));
                    if(footerAction == 'save-close') {
                        RTMegaMenuAdmin.closeMegaMenuModal();
                    }
                }
                
            }
        });

    },

   }

   RTMegaMenuAdmin.init();

    

})(jQuery);