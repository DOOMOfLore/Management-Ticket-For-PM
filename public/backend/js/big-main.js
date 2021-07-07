//------------------------- REMOVE BODY CLASS
$('body').click(function() {
   $('.big-user .big-profile, #notif, #inbox').removeClass('show');
});
$('.big-user .big-profile, #notif, #inbox, a[href^="#notif"], a[href^="#inbox"]').click(function(event){
   event.stopPropagation();
});
//------------------------- REMOVE BODY CLASS END

//------------------------- PROFILE MENU
$('.big-user .big-profile .pic').click(function(e) {    
    $(this).parent().toggleClass('show');   
    $('#notif, #inbox').removeClass('show');          
}); 
$('a[href^="#inbox"]').click(function(e) {    
    $('#inbox').addClass('show');        
    $('#notif, .big-user .big-profile').removeClass('show');     
});
$('a[href^="#notif"]').click(function(e) {    
    $('#notif').addClass('show');        
    $('#inbox, .big-user .big-profile').removeClass('show');    
});
//------------------------- PROFILE MENU END

//------------------------- SLIDE MENU
$('.big-right header .big-hide-menu').click(function(e) {    
    $('body').toggleClass('slide-menu');     
});
//------------------------- SLIDE MENU END

//------------------------- POPUP 
$(".big-popup").each(function(){
    if($(this).attr('id') == 'main') {
        $(this).addClass('show');
    }
});
$('a.popup').off('click').on( "click", function(e) {
    e.preventDefault();
    var id = $(this).attr('data-popup');
    var title = $(this).attr('title');
    var href = $(this).attr('value');
    $(".big-popup").each(function() {
        if($(this).attr('id') == id) {
            console.log('tuh')
            $(this).addClass('show');
            $('.popup-content').load(href);
            $('.popup-title').html(title);
        }
    });
}); 
$('.big-popup .popup-wrap .popup-header .popup-close').click(function(e) {    
    $(this).closest('.big-popup').removeClass('show');     
});
//------------------------- POPUP END

//------------------------- REMOVE SUCCEES MSG START
$('a[href^="#msg_success"]').click(function(e) {    
    $('#msg_success').addClass('success');        
});
//setTimeout(function(){
//    $(".big-warning.success").removeClass('success');
//}, 2500);
$('.big-warning .warning-container .closed').click(function(e) {    
    $(this).closest('.big-warning').removeClass('error');     
    $(this).closest('.big-warning').removeClass('warning');     
    $(this).closest('.big-warning').removeClass('success');     
});
$('a[href^="#msg_warning"]').click(function(e) {    
    $('#msg_warning').addClass('warning');        
});
$('a[href^="#msg_error"]').click(function(e) {    
    $('#msg_error').addClass('error');        
});
//------------------------- REMOVE SUCCEES MSG END

//============================== Delete Function start
(function() {
    var laravel = {
      initialize: function() {
        this.methodLinks = $('a[data-method]');
    
        this.registerEvents();
      },
    
      registerEvents: function() {
        this.methodLinks.on('click', this.handleMethod);
      },
    
      handleMethod: function(e) {
        var link = $(this);
        var httpMethod = link.data('method').toUpperCase();
        var form;
    
        // If the data-method attribute is not PUT or DELETE,
        // then we don't know what to do. Just ignore.
        if ( $.inArray(httpMethod, ['PUT', 'DELETE']) === - 1 ) {
          return;
        }
    
        // Allow user to optionally provide data-confirm="Are you sure?"
        if ( link.data('confirm') ) {
          if ( ! laravel.verifyConfirm(link) ) {
            return false;
          }
        }
    
        form = laravel.createForm(link);
        form.submit();
    
        e.preventDefault();
      },
    
      verifyConfirm: function(link) {
        return confirm(link.data('confirm'));
      },
    
      createForm: function(link) {
        var form = 
        $('<form>', {
          'method': 'POST',
          'action': link.attr('href')
        });
    
        var token = 
        $('<input>', {
          'type': 'hidden',
          'name': '_token',
            'value': link.data('token') // hmmmm...
          });
    
        var hiddenInput =
        $('<input>', {
          'name': '_method',
          'type': 'hidden',
          'value': link.data('method')
        });
    
        return form.append(token, hiddenInput).appendTo('body');
      }
    };
    
    laravel.initialize();
})();
//============================== Delete Function end