$( document ).ready(function() {
    

	$('#search').click(function(){
        var str = $("#search-input").val();
		if(str == ""){
			alert("Enter value in search filed");
			$("#search-input").focus();
		} else {
			window.location.href= "search.php?str="+str;
		}
    });
    
	

	$('#advance_search').click(function(){
        var str = $("#keyword").val();
		var diff = $("#diff").val();
		var slv = $("#slv").val();
		window.location.href= "search.php?str="+str+"&diff="+diff+"&slv="+slv
    });
    
    
	function hideFlash(a) {
    a || (a = "0"), _.delay(function() { $(".alert-box-fixed" + a).addClass("fadeOutUp"), _.delay(function() { $(".alert-box-fixed" + a).remove() }, 600) }, 6e3)

	}
	hideFlash();
	
	
	$('#note').keypress(function(e) {
		var tval = $('#note').val(),
			tlength = tval.length,
			set = 500,
			remain = parseInt(set - tlength);
		$('#remain').text("Char left: "+remain);
		if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
			$('#note').val((tval).substring(0, tlength - 1));
			return false;
		}
	})
    
    
    // Waves
    //Waves.displayEffect();
    
    
    // Panel Control
    $('.panel-collapse').click(function(){
        $(this).closest(".panel").children('.panel-body').slideToggle('fast');
    });
    
    $('.panel-reload').click(function() { 
        var el = $(this).closest(".panel").children('.panel-body');
        blockUI(el);
        window.setTimeout(function () {
            unblockUI(el);
        }, 1000);
    
    }); 
    
    $('.panel-remove').click(function(){
        $(this).closest(".panel").hide();
    });
    
    
    // Sidebar Menu
    var parent, ink, d, x, y;
    $('.sidebar .accordion-menu li .sub-menu').slideUp(0);
    $('.sidebar .accordion-menu li.open .sub-menu').slideDown(0);
    $('.small-sidebar .sidebar .accordion-menu li.open .sub-menu').hide(0);
    $('.sidebar .accordion-menu > li.droplink > a').click(function(){
        
        if(!($('body').hasClass('small-sidebar'))&&(!$('body').hasClass('page-horizontal-bar'))&&(!$('body').hasClass('hover-menu'))) {
        
        var menu = $('.sidebar .menu'),
            sidebar = $('.page-sidebar-inner'),
            page = $('.page-content'),
            sub = $(this).next(),
            el = $(this);
        
        menu.find('li').removeClass('open');
        $('.sub-menu').slideUp(200, function() {
            sidebarAndContentHeight();
        });
        sidebarAndContentHeight();
        
        if (!sub.is(':visible')) {
            $(this).parent('li').addClass('open');
            $(this).next('.sub-menu').slideDown(200, function() {
                sidebarAndContentHeight();
            });
        } else {
            sub.slideUp(200, function() {
                sidebarAndContentHeight();
            });
        }
        return false;
        };
    });
    
    $('.sidebar .accordion-menu .sub-menu li.droplink > a').click(function(){
        
        var menu = $(this).parent().parent(),
            sidebar = $('.page-sidebar-inner'),
            page = $('.page-content'),
            sub = $(this).next(),
            el = $(this);
        
        menu.find('li').removeClass('open');
        sidebarAndContentHeight();
        
        if (!sub.is(':visible')) {
            $(this).parent('li').addClass('open');
            $(this).next('.sub-menu').slideDown(200, function() {
                sidebarAndContentHeight();
            });
        } else {
            sub.slideUp(200, function() {
                sidebarAndContentHeight();
            });
        }
        return false;
    });
    
    // Makes .page-inner height same as .page-sidebar height
    var sidebarAndContentHeight = function () {
        var content = $('.page-inner'),
            sidebar = $('.page-sidebar'),
            body = $('body'),
            height,
            footerHeight = $('.page-footer').outerHeight(),
            pageContentHeight = $('.page-content').height();
        
        content.attr('style', 'min-height:' + sidebar.height() + 'px !important');
        
        if (body.hasClass('page-sidebar-fixed')) {
            height = sidebar.height() + footerHeight;
        } else {
            height = sidebar.height() + footerHeight;
            if (height  < $(window).height()) {
                height = $(window).height();
            }
        }
        
        if (height >= content.height()) {
            content.attr('style', 'min-height:' + height + 'px !important');
        }
    };
    
    sidebarAndContentHeight();
    
    window.onresize = sidebarAndContentHeight;
    
    

    // Layout Settings
    var fixedHeaderCheck = document.querySelector('.fixed-header-check'),
        fixedSidebarCheck = document.querySelector('.fixed-sidebar-check'),
        toggleSidebarCheck = document.querySelector('.toggle-sidebar-check'),
        compactMenuCheck = document.querySelector('.compact-menu-check'),
        defaultOptions = function() {
            
            if(($('body').hasClass('small-sidebar'))&&(toggleSidebarCheck.checked == 1)){
                toggleSidebarCheck.click();
            }
        
            if(!($('body').hasClass('page-header-fixed'))&&(fixedHeaderCheck.checked == 0)){
                fixedHeaderCheck.click();
            }
        
            if(($('body').hasClass('page-sidebar-fixed'))&&(fixedSidebarCheck.checked == 1)){
                fixedSidebarCheck.click();
            }
        
            if(!($('body').hasClass('compact-menu'))&&(compactMenuCheck.checked == 0)){
                compactMenuCheck.click();
            }
        
            $(".theme-color").attr("href", 'assets/css/themes/white.css');
           
            sidebarAndContentHeight();
        },
        str = $('.navbar .logo-box a span').text(),
        smTxt = (str.slice(0,1)),
        collapseSidebar = function() {
            $('body').toggleClass("small-sidebar");
            $('.navbar .logo-box a span').html($('.navbar .logo-box a span').text() == smTxt ? str : smTxt);
            sidebarAndContentHeight();
        },
        fixedHeader = function() {
            if(($('body').hasClass('page-horizontal-bar'))&&($('body').hasClass('page-sidebar-fixed'))&&($('body').hasClass('page-header-fixed'))){
                fixedSidebarCheck.click();
                alert("Static header isn't compatible with fixed horizontal nav mode. Modern will set static mode on horizontal nav.");
            };
            $('body').toggleClass('page-header-fixed');
            sidebarAndContentHeight();
        },
        fixedSidebar = function() {
            if(($('body').hasClass('page-horizontal-bar'))&&(!$('body').hasClass('page-sidebar-fixed'))&&(!$('body').hasClass('page-header-fixed'))){
                fixedHeaderCheck.click();
                alert("Fixed horizontal nav isn't compatible with static header mode. Modern will set fixed mode on header.");
            };
            if(($('body').hasClass('hover-menu'))&&(!$('body').hasClass('page-sidebar-fixed'))){
                hoverMenuCheck.click();
                alert("Fixed sidebar isn't compatible with hover menu mode. Modern will set accordion mode on menu.");
            };
            $('body').toggleClass('page-sidebar-fixed');
            if ($('body').hasClass('.page-sidebar-fixed')) {
                $('.page-sidebar-inner').slimScroll({
                    destroy:true
                });
            };
            $('.page-sidebar-inner').slimScroll();
            sidebarAndContentHeight();
        },
        compactMenu = function() {
            $('body').toggleClass('compact-menu');
            sidebarAndContentHeight();
        };
    
    
    
    // Logo text on Collapsed Sidebar
    $('.small-sidebar .navbar .logo-box a span').html($('.navbar .logo-box a span').text() == smTxt ? str : smTxt);
    
    
    if( !$('.theme-settings').length ) {
        $('.sidebar-toggle').click(function() {
            collapseSidebar();
        });
    };
    
    if( $('.theme-settings').length ) {
    fixedHeaderCheck.onchange = function() {
        fixedHeader();
    };
    
    fixedSidebarCheck.onchange = function() {
        fixedSidebar();
    };
    
    toggleSidebarCheck.onchange = function() {
        collapseSidebar();
    };
        
    compactMenuCheck.onchange = function() {
        compactMenu();
    };
    
    
    // Sidebar Toggle
    $('.sidebar-toggle').click(function() {
        toggleSidebarCheck.click();
    });
    
    // Reset options
    $('.reset-options').click(function() {
        defaultOptions();
    });
    
    // Color changer
    $(".colorbox").click(function(){
        var color =  $(this).attr('data-css');
        $(".theme-color").attr('href', 'assets/css/themes/' + color + '.css');
        return false;
    });
    
    // Fixed Sidebar Bug
    if(!($('body').hasClass('page-sidebar-fixed'))&&(fixedSidebarCheck.checked == 1)){
        $('body').addClass('page-sidebar-fixed');
    }
    
    if(($('body').hasClass('page-sidebar-fixed'))&&(fixedSidebarCheck.checked == 0)){
        $('.fixed-sidebar-check').prop('checked', true);
    }
    
    // Fixed Header Bug
    if(!($('body').hasClass('page-header-fixed'))&&(fixedHeaderCheck.checked == 1)){
        $('body').addClass('page-header-fixed');
    }
    
    if(($('body').hasClass('page-header-fixed'))&&(fixedHeaderCheck.checked == 0)){
        $('.fixed-header-check').prop('checked', true);
    }
    
    // Toggle Sidebar Bug
    if(!($('body').hasClass('small-sidebar'))&&(toggleSidebarCheck.checked == 1)){
        $('body').addClass('small-sidebar');
    }
    
    if(($('body').hasClass('small-sidebar'))&&(toggleSidebarCheck.checked == 0)){
        $('.horizontal-bar-check').prop('checked', true);
    }
    }
    
   
});